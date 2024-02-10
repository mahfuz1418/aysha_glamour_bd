<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    //------------------------------------------PRODUCT  START-------------------------------------
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
                'hover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'category_id' => 'required|numeric',
                'sub_category_id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'slug' => "required|string|max:255|unique:products,slug",
                'selling_price' => 'required|numeric',
                'stock' => 'required|numeric',
                'active_status' => 'required|in:0,1',
            ],
            [
                'thumbnail.required' => 'Please Choose a Thumbnail',
                'hover_image.required' => 'Please Choose a Hover Image',
                'category_id.required' => 'Product Category Is Required',
                'sub_category_id.required' => 'Product Subcategory Is Required',
                'name.required' => 'Product Name Is Required',
                'slug.required' => 'Product Slug Is Required',
                'selling_price.required' => 'Product Selling Price Is Required',
                'stock.required' => 'Stock Is Required',
                'active_status.required' => 'Product Active Status Is Required',
            ],
        );

        $image = '';
        if ($request->file('thumbnail')) {
            $image = uploadPlease($request->file('thumbnail'));
        }
        $image1 = '';
        if ($request->file('hover_image')) {
            $image1 = uploadPlease($request->file('hover_image'));
        }

        $category_name = Category::where('id', $request->category_id)->value('name');
        $sub_category_name = SubCategory::where('id', $request->sub_category_id)->value('name');

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->category_name = $category_name;
        $product->sub_category_id = $request->sub_category_id;
        $product->sub_category_name = $sub_category_name;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->selling_price = $request->selling_price;
        $product->stock = $request->stock;
        $product->active_status = $request->active_status;
        $product->thumbnail = $image;
        $product->hover_image = $image1;
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
                'category_id_e' => 'required|numeric',
                'sub_category_id_e' => 'required|numeric',
                'selling_price_e' => 'required|numeric',
                'stock_e' => 'required|numeric',
                'active_status_e' => 'required|in:0,1',
            ],
            [
                'category_id_e.required' => 'Product Category Is Required',
                'sub_category_id_e.required' => 'Product Subcategory Is Required',
                'selling_price_e.required' => 'Product Selling Price Is Required',
                'stock_e.required' => 'Stock Is Required',
                'active_status_e.required' => 'Product Active Status Is Required',
            ],
        );

        $product = Product::findOrFail($request->id);
        $image = $product->thumbnail;
        $image1 = $product->hover_image;

        if ($product->name != $request->name_e) {
            $request->validate([
                    'name_e' => 'required|string|max:255',
                    'slug_e' => "required|string|max:255|unique:products,slug",
            ]);
        }

        if ($request->file('thumbnail_e')) {
            $request->validate(
                [
                    'thumbnail_e' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                ],
                [
                    'thumbnail_e.required' => 'Please Choose a Thumbnail',
                ],
            );

            if (isset($product) && is_object($product) && isset($product->thumbnail)) {
                File::delete($product->thumbnail);
                $image = uploadPlease($request->file('thumbnail_e'));
            }
        }

        if ($request->file('hover_image_e')) {
            $request->validate(
                [
                    'hover_image_e' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                ],
                [
                    'hover_image_e.required' => 'Please Choose a Hover Image',
                ],
            );

            if (isset($product) && is_object($product) && isset($product->hover_image)) {
                File::delete($product->hover_image);
                $image1 = uploadPlease($request->file('hover_image_e'));
            }
        }

        $category_name = Category::where('id', $request->category_id_e)->value('name');
        $sub_category_name = SubCategory::where('id', $request->sub_category_id_e)->value('name');

        $product->category_id =$request->category_id_e;
        $product->category_name = $category_name;
        $product->sub_category_id = $request->sub_category_id_e;
        $product->sub_category_name = $sub_category_name;
        $product->name = $request->name_e;
        $product->slug = $request->slug_e;
        $product->selling_price = $request->selling_price_e;
        $product->stock = $request->stock_e;
        $product->active_status = $request->active_status_e;
        $product->thumbnail = $image;
        $product->hover_image = $image1;
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

    //  update pin status
    public function updatePinStatus($id, $status)
    {
        $pin_count = Product::where('pinned', 1)->count();

        if ($pin_count >= 6 && $status == 0) {
            $notification = [
                'error' => "You can't pin more then 6 products",
            ];
            return back()->with($notification);
        }

        if ($status == 0) {
            $pinn = Product::findOrFail($id)->update([
                'pinned' => '1',
                'updated_by' => Auth::id(),
            ]);

            if ($pinn == true) {
                $notification = [
                    'success' => 'Product Pinned Successfully.',
                ];
            } else {
                $notification = [
                    'error' => 'Opps! There Is A Problem!',
                ];
            }
            return back()->with($notification);
        } elseif ($status == 1) {
            $pinn = Product::findOrFail($id)->update([
                'pinned' => '0',
                'updated_by' => Auth::id(),
            ]);

            if ($pinn == true) {
                $notification = [
                    'success' => 'Product Unpinned Successfully.',
                ];
            } else {
                $notification = [
                    'error' => 'Opps! There Is A Problem!',
                ];
            }
            return back()->with($notification);
        }
    }

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

    // FORCE DELETE PRODUCT
     public function forceDeleteProduct($id)
     {

        $product = Product::onlyTrashed()->find($id);
        unlink(public_path($product->thumbnail));
        unlink(public_path($product->hover_image));
        $product->forceDelete();
        return back()->with('message', 'Product Deleted Permanently');
     }

    // FORCE DELETE PRODUCT
     public function forceDeleteAllProduct()
     {
         $trushProduct = Product::onlyTrashed()->where('deleted_at', '!=' , null)->get();
         foreach ($trushProduct as $trash) {
             unlink(public_path($trash->thumbnail));
             unlink(public_path($trash->hover_image));
             $trash->forceDelete();
         }
         return back()->with('message', 'All Product Permanently Deleted');
     }

    //--------------------------------GET SUBCATEGORY VIA AJAX POST---------------------------------
    public function getSubcategoryAjax(Request $request)
    {
        $data['subcategory'] = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json($data);
    }

    //--------------------------------PRODUCT DESCRIPTION START---------------------------------
    public function productDescriptionIndex($id)
    {
       $data['product'] = Product::findOrFail($id);
       $data['productDescriptions'] = ProductDescription::where('product_id', $id)->paginate(10);
       return view('backend.product.productDescription.product_description', $data);
    }

    public function storeProductDescription(Request $request)
    {
       $request->validate(
           [
               'product_id' => 'required|integer',
               'active_status' => 'required|integer',
               'content' => 'required|string',
           ],
           [
               'product_id.required' => 'Required',
               'active_status.required' => 'Active Status Is Required',
               'content.required' => 'Please Write Or Past The Content',
           ],
       );

       $productDes = new ProductDescription();
       $productDes->product_id = $request->product_id;
       $productDes->active_status = $request->active_status;
       $productDes->content = $request->content;
       $productDes->created_by = Auth::id();
       $productDes->save();

       if ($productDes) {
           return response()->json([
               'success' => 'Product Description Added Successfully',
           ]);
       } else {
           return response()->json([
               'success' => 'Something Failed',
           ]);
       }
    }


}
