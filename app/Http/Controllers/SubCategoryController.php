<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'slug' => 'required|string|max:255',
            'active_status' =>  'required|in:0,1',
            'parent_id' =>  'required|integer',
        ],[
            'subcategoryName.required' => 'Please Enter The Subcategory Name',
            'slug.required' => 'Slug Name Can Not Be Empty',
            'active_status.required' =>  'Please Select The Status',
            'parent_id.required' =>  'Please Select Category',
        ])->validate();

        $subcategory = new SubCategory();
        $subcategory->name = $request->subcategoryName;
        $subcategory->slug = $request->slug;
        $subcategory->parent_id = $request->parent_id;
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
                'subcategoryName' => 'required|string|max:255|unique:categories,name',
            );
        } else {
            $check_cat = array();
        }
        $check_all = array(
            'slug' => 'required|string|max:255',
            'active_status' =>  'required|in:0,1',
            'parent_id' =>  'required|integer'
        );
        $marge = array_merge($check_cat, $check_all);
        $validatorData = Validator::make($request->all(), $marge)->validate();

        $subcategory->name = $request->subcategoryName;
        $subcategory->slug = $request->slug;
        $subcategory->parent_id = $request->parent_id;
        $subcategory->active_status = $request->active_status;
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
