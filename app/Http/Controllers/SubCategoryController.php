<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::where('active_status', '1')->get();
        $data['subcategories'] = SubCategory::paginate(10);
        $data['trashsubcategories'] = SubCategory::onlyTrashed()->get();
        return view('backend.product.subcategory', $data);
    }

    public function storeSubcategory(Request $request)
    {
        $validatorData = Validator::make($request->all(), [
            'subcategoryName' => 'required|string|max:255|unique:categories,name',
            'subcategory_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'slug' => 'required|string|max:255',
            'active_status' =>  'required|in:0,1',
            'category_id' =>  'required|integer',
        ],[
            'subcategoryName.required' => 'Please Enter The Subcategory Name',
            'subcategory_image.required' => 'Please Select Subcategory Image',
            'slug.required' => 'Slug Name Can Not Be Empty',
            'active_status.required' =>  'Please Select The Status',
            'category_id.required' =>  'Please Select Category',
        ])->validate();

        $image = '';
        if ($request->file('subcategory_image')) {
            $image = uploadPlease($request->file('subcategory_image'));
        }
        $subcategory = new SubCategory();
        $subcategory->name = $request->subcategoryName;
        $subcategory->subcategory_image = $image;
        $subcategory->slug = $request->slug;
        $subcategory->category_id = $request->category_id;
        $subcategory->active_status = $request->active_status;
        $subcategory->created_by = Auth::id();
        $subcategory->save();
        if ($subcategory) {
            return response()->json([
                'success' => 'Subcategory Added Successfully',
            ]);
        }

    }

    public function editSubcategory(Request $request)
    {
        $subcategory = SubCategory::findOrFail($request->id_e);

        if ($subcategory->name != $request->categoryName) {
            $check_cat = array(
                'subcategoryName_e' => 'required|string|max:255|unique:categories,name',
            );
        } else {
            $check_cat = array();
        }
        $check_all = array(
            'slug_e' => 'required|string|max:255',
            'active_status_e' =>  'required|in:0,1',
            'category_id_e' =>  'required|integer'
        );
        $marge = array_merge($check_cat, $check_all);
        $validatorData = Validator::make($request->all(), $marge)->validate();

        if ($request->file('subcategory_image_e')) {
            $request->validate(
                [
                    'subcategory_image_e' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                ],
                [
                    'subcategory_image_e.required' => 'Please Choose a subcategory image',
                ],
            );

            if (isset($subcategory) && is_object($subcategory) && isset($subcategory->subcategory_image)) {
                $image = '';
                File::delete($subcategory->subcategory_image);
                $image = uploadPlease($request->file('subcategory_image_e'));
                $subcategory->subcategory_image = $image;
            }
        }

        $subcategory->name = $request->subcategoryName_e;
        $subcategory->slug = $request->slug_e;
        $subcategory->category_id = $request->category_id_e;
        $subcategory->active_status = $request->active_status_e;
        $subcategory->created_by = Auth::id();
        $subcategory->save();
        if ($subcategory) {
            return response()->json([
                'success' => 'Subcategory Updated Successfully',
            ]);
        }

    }

    public function deleteSubcategory($sub_id)
    {
        $subcategory = SubCategory::findOrFail($sub_id)->delete();
        return redirect()->back();
    }

    public function resotoreSubcategory($id)
    {
        $restoreCategory = SubCategory::onlyTrashed()->find($id)->restore();
        return back()->with('message', 'Subcategory Restored Successfully');
    }

    public function resotoreAllSubcategory()
    {
        $restoreCategory = SubCategory::onlyTrashed()->where('deleted_at', '!=' , null)->restore();
        return back()->with('message', 'All Subcategory Restored Successfully');
    }
}
