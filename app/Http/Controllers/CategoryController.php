<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('backend.product.category', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validatorData = Validator::make($request->all(), [
            'categoryName' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255',
            'active_status' =>  'required|in:0,1',
        ],[
            'categoryName.required' => 'Please Enter The Category Name',
            'slug.required' => 'Slug Name Can Not Be Empty',
            'active_status.required' =>  'Please Select The Status',
        ])->validate();

        $category = new Category();
        $category->name = $request->categoryName;
        $category->slug = $request->slug;
        $category->active_status = $request->active_status;
        $category->created_by = Auth::id();
        $category->save();

        if ($category) {
            return response()->json([
                'success' => 'Category Added Successfully',
            ]);
        }

    }

    public function editCategory(Request $request)
    {
        $validatorData = Validator::make($request->all(), [
            'categoryName' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255',
            'active_status' =>  'required|in:0,1',
        ],[
            'categoryName.required' => 'Please Enter The Category Name',
            'slug.required' => 'Slug Name Can Not Be Empty',
            'active_status.required' =>  'Please Select The Status',
        ])->validate();

        $category = Category::findOrFail($request->id_e);
        $category->name = $request->categoryName;
        $category->slug = $request->slug;
        $category->active_status = $request->active_status;
        $category->updated_by = Auth::id();
        $category->save();

        if ($category) {
            return response()->json([
                'success' => 'Category Updated Successfully',
            ]);
        }

    }
}
