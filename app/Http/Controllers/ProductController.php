<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::get();
        $data['products'] = Product::paginate(10);
        // $data['trashCategories'] = Category::onlyTrashed()->get();
        return view('backend.product.product', $data);
    }

    public function storeProduct(Request $request)
    {
        $request->validate(
            [
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'category_id' => 'required|numeric',
                'sub_category_id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'slug' => "required|string|max:255|unique:products,slug",
                'selling_price' => 'required|numeric',
                'active_status' => 'required|in:0,1',
            ],
            [
                'thumbnail.required' => 'Please Choose a Thumbnail',
                'category_id.required' => 'Product Category Is Required',
                'sub_category_id.required' => 'Product Subcategory Is Required',
                'name.required' => 'Product Name Is Required',
                'slug.required' => 'Product Slug Is Required',
                'selling_price.required' => 'Product Selling Price Is Required',
                'active_status.required' => 'Product Active Status Is Required',
            ],
        );

        $image = '';
        if ($request->file('thumbnail')) {
            $image = uploadPlease($request->file('thumbnail'));
        }

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->selling_price = $request->selling_price;
        $product->active_status = $request->active_status;
        $product->thumbnail = $image;
        $product->created_by = Auth::id();
        $product->save();

        if ($product) {
            return response()->json([
                'success' => "Product Added successfully",
            ]);
        } else {
            return response()->json([
                'success' => "Something went wrong",
            ]);
        }
    }

    public function editProduct(Request $request)
    {
        $request->validate(
            [
                'category_id' => 'required|numeric',
                'sub_category_id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'slug' => "required|string|max:255|unique:products,slug",
                'selling_price' => 'required|numeric',
                'active_status' => 'required|in:0,1',
            ],
            [
                'category_id.required' => 'Product Category Is Required',
                'sub_category_id.required' => 'Product Subcategory Is Required',
                'name.required' => 'Product Name Is Required',
                'slug.required' => 'Product Slug Is Required',
                'selling_price.required' => 'Product Selling Price Is Required',
                'active_status.required' => 'Product Active Status Is Required',
            ],
        );

        $product = Product::findOrFail($request->id);
        $image = $product->thumbnail;

        if ($request->file('thumbnail')) {
            $request->validate(
                [
                    'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                ],
                [
                    'thumbnail.required' => 'Please Choose a Thumbnail',
                ],
            );

            if (isset($product) && is_object($product) && isset($product->thumbnail)) {
                File::delete($product->thumbnail);
            }

            $image = uploadPlease($request->file('thumbnail'));
        }

        $product->update([
            'thumbnail' => $image,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'selling_price' => $request->selling_price,
            'active_status' => $request->active_status,
            'updated_by' => Auth::id(),
        ]);

        if ($product) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function getSubcategoryAjax(Request $request)
    {
        $data['subcategory'] = SubCategory::where('parent_id', $request->category_id)->get();
        return response()->json($data);
    }

}
