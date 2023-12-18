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
    //VIEW INDEX
    public function index()
    {
        $data['categories'] = Category::get();
        $data['products'] = Product::paginate(10);
        $data['trashProducts'] = Product::onlyTrashed()->get();
        return view('backend.product.product', $data);
    }

    //STORE PRODUCT
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

    //EDIT PRODUCT
    public function editProduct(Request $request)
    {
        $request->validate(
            [
                'category_id' => 'required|numeric',
                'sub_category_id' => 'required|numeric',
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

        if ($product->name != $request->name) {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'slug' => "required|string|max:255|unique:products,slug",
                ]
            );
        }

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


        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->selling_price = $request->selling_price;
        $product->active_status = $request->active_status;
        $product->thumbnail = $image;
        $product->updated_by = Auth::id();
        $product->save();

        if ($product) {
            return response()->json([
                'success' => "Product Updated successfully",
            ]);
        } else {
            return response()->json([
                'success' => "Something went wrong",
            ]);
        }
    }

    //DELETE PRODUCT
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id)->delete();
        return redirect()->back();
    }

    //GET SUBCATEGORY VIA AJAX POST
    public function getSubcategoryAjax(Request $request)
    {
        $data['subcategory'] = SubCategory::where('parent_id', $request->category_id)->get();
        return response()->json($data);
    }
    //  update pin status
    // public function updatePinStatus($id, $status)
    // {
    //     $pin_count = Product::where('pinned', 1)->count();

    //     if ($pin_count >= 6 && $status == 0) {
    //         $notification = [
    //             'error' => 'You have reached the maximum product count',
    //         ];
    //         return back()->with($notification);
    //     }

    //     if ($status == 0) {
    //         $pinn = Product::findOrFail($id)->update([
    //             'pinned' => '1',
    //             'updated_by' => Auth::id(),
    //         ]);

    //         if ($pinn == true) {
    //             $notification = [
    //                 'success' => 'Product Pinned Successfully.',
    //             ];
    //         } else {
    //             $notification = [
    //                 'error' => 'Opps! There Is A Problem!',
    //             ];
    //         }
    //         return back()->with($notification);
    //     } elseif ($status == 1) {
    //         $pinn = Product::findOrFail($id)->update([
    //             'pinned' => '0',
    //             'updated_by' => Auth::id(),
    //         ]);

    //         if ($pinn == true) {
    //             $notification = [
    //                 'success' => 'Product Unpinned Successfully.',
    //             ];
    //         } else {
    //             $notification = [
    //                 'error' => 'Opps! There Is A Problem!',
    //             ];
    //         }
    //         return back()->with($notification);
    //     }
    // }

     //RESTORE Product
     public function resotoreProduct($id)
     {
         $restoreProduct = Product::onlyTrashed()->find($id)->restore();
         return back()->with('message', 'Product Restored Successfully');
     }

     //RESTORE ALL PRODUCT
     public function resotoreAllProduct()
     {
         $restoreAllProduct = Product::onlyTrashed()->where('deleted_at', '!=' , null)->restore();
         return back()->with('message', 'All Product Restored Successfully');
     }

     //FORCE DELETE PRODUCT
    //  public function forceDeleteProduct($id)
    //  {
    //     $product = Product::onlyTrashed()->find($id);
    //     $id = $product->id;
    //     $image_name = $product->category_image;
    //     foreach ($subcategories as $subcategory) {
    //         unlink(base_path('public/upload/subcategory_image/'.$subcategory->subcategory_image));
    //         $subcategory->forceDelete();
    //     }
    //     unlink(base_path('public/upload/category_image/'.$image_name));
    //     Category::onlyTrashed()->find($id)->forceDelete();
    //     return back();
    //  }

    // FORCE DELETE PRODUCT
     public function forceDeleteAllProduct()
     {
         $restoreAllProduct = Product::onlyTrashed()->where('deleted_at', '!=' , null)->restore();
         return back()->with('message', 'All Product Permanently Deleted');
     }




}
