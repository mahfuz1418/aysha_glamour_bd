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
        // $data['trashCategories'] = Category::onlyTrashed()->get();
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
}
