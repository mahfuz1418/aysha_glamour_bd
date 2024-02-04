<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::get();
        // $data['products'] = Product::latest()->take(5)->get();
        return view('frontend.index', $data);
    }
}
