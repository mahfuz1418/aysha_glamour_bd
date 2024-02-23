<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductColor;
use App\Models\ProductDescription;
use App\Models\Size;
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
        $data['products'] = Product::paginate(10);
        $data['trashProducts'] = Product::onlyTrashed()->get();
        $data['categories'] = Category::get();
        $data['sizes'] = Size::get();
        $data['colors'] = Color::get();
        return view('backend.product.product', $data);
    }

    //ADD PRODUCT
    public function addProduct()
    {
        $data['categories'] = Category::get();
        $data['sizes'] = Size::get();
        $data['colors'] = Color::get();
        return view('backend.product.addproduct', $data);
    }

    //STORE PRODUCT
    public function storeProduct(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'slug' => "required|string|max:255|unique:products,slug",
                'description' => 'required',
                'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'image5' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'image6' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'category_id' => 'required|numeric',
                'sub_category_id' => 'required|numeric',
                'colors' => 'max:255',
                'sizes' => 'max:255',
                'active_status' => 'required|in:0,1',
            ],
            [
                'name.required' => 'Product Name Is Required',
                'description.required' => 'Product Description Is Required',
                'image1.required' => 'Product Thumbnail is required',
                'image2.required' => 'Product Hover Image is required',
                'category_id.required' => 'Product Category Is Required',
                'sub_category_id.required' => 'Product Subcategory Is Required',
                'active_status.required' => 'Product Active Status Is Required',
            ],
        );
        $image1 = '';
        if ($request->file('image1')) {
            $image1 = uploadPlease($request->file('image1'));
        }
        $image2 = '';
        if ($request->file('image2')) {
            $image2 = uploadPlease($request->file('image2'));
        }
        $image3 = '';
        if ($request->file('image3')) {
            $image3 = uploadPlease($request->file('image3'));
        }
        $image4 = '';
        if ($request->file('image4')) {
            $image4 = uploadPlease($request->file('image4'));
        }
        $image5 = '';
        if ($request->file('image5')) {
            $image5 = uploadPlease($request->file('image5'));
        }
        $image6 = '';
        if ($request->file('image6')) {
            $image6 = uploadPlease($request->file('image6'));
        }

        $category_name = Category::where('id', $request->category_id)->value('name');
        $sub_category_name = SubCategory::where('id', $request->sub_category_id)->value('name');

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->thumbnail = $image1;
        $product->hover_image = $image2;
        $product->image3 = $image3;
        $product->image4 = $image4;
        $product->image5 = $image5;
        $product->image6 = $image6;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->category_name = $category_name;
        $product->sub_category_id = $request->sub_category_id;
        $product->sub_category_name = $sub_category_name;
        $product->active_status = $request->active_status;
        $product->created_by = Auth::id();
        $product->save();

        //Product Color Option
        foreach ($request->colors as $color) {
            ProductColor::create([
                'product_id' => $product->id,
                'product_color' => $color,
                'created_by' => Auth::id(),
            ]);
        }

        //Product Attribute Option
        if ($request->checkdata == "on") {
            $request->validate([
                'price' => 'required|max:255',
                'sizes' => "required|max:255",
                'stockbysize' => 'required|max:255',
            ]);
            foreach (array_map(null, $request->sizes, $request->stockbysize, $request->price) as [$sizes, $stock, $price]) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'size' => $sizes,
                    'price' => $price,
                    'stock' => $stock,
                    'created_by' => Auth::id(),
                ]);
            }
        } else {
            $request->validate([
                'selling_price' => 'required|max:255',
                'stock' => 'required|max:255',
            ]);
            ProductAttribute::create([
                'product_id' => $product->id,
                'price' => $request->selling_price,
                'stock' => $request->stock,
                'created_by' => Auth::id(),
            ]);
        }


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

    public function getSizesAjax(Request $request)
    {
        if (empty($request->selectedSizes)) {
            return response()->json(['processedData' => 0]);
        } else {
            foreach ($request->selectedSizes as $value) {
                $result = Size::where('id', $value)->first();
                $processedData[] = $result;
            }
            return response()->json(['processedData' => $processedData]);
        }


    }




}
