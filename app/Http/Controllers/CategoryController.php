<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //VIEW INDEX CATEGORY
    public function index()
    {
        $data['categories'] = Category::paginate(10);
        $data['trashCategories'] = Category::onlyTrashed()->get();
        return view('backend.product.category', $data);
    }

    //STORE CATEGORY
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

    //EDIT CATEGORY
    public function editCategory(Request $request)
    {
        $category = Category::findOrFail($request->id_e);

        if ($category->name != $request->categoryName) {
            $check_cat = array(
                'categoryName' => 'required|string|max:255|unique:categories,name',
            );
        } else {
            $check_cat = array();
        }

        $check_all = array(
            'slug' => 'required|string|max:255',
            'active_status' =>  'required|in:0,1',
        );
        $marge = array_merge($check_cat, $check_all);
        $validatorData = Validator::make($request->all(), $marge)->validate();


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

    //DELETE CATEGORY
    public function deleteCategory($cat_id)
    {
        $category = Category::findOrFail($cat_id)->delete();
        return redirect()->back();
    }

    //RESTORE CATEGORY
    public function resotoreCategory($id)
    {
        $restoreCategory = Category::onlyTrashed()->find($id)->restore();
        return back()->with('message', 'Category Restored Successfully');
    }

    //RESTORE ALL CATEGORY
    public function resotoreAllCategory()
    {
        $restoreCategory = Category::onlyTrashed()->where('deleted_at', '!=' , null)->restore();
        return back()->with('message', 'All Category Restored Successfully');
    }
}
