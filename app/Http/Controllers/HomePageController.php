<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::get();
        $data['sub_categories'] = SubCategory::get();
        $data['feature_products'] = Product::where('pinned', 1)->get();
        $data['sliders'] = HomeSlider::where('active_status', 1)->get();
        return view('frontend.index', $data);
    }

    //SHORT DESCRIPTION
    public function productDetails($id)
    {
        $data['product'] = Product::findOrFail($id);
        return view('frontend.product_details.product_details', $data);
    }
}
