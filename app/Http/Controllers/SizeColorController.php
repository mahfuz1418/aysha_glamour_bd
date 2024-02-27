<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SizeColorController extends Controller
{
    //VIEW INDEX
    public function index()
    {
        $data['sizes'] = Size::paginate(10);
        $data['colors'] = Color::paginate(10);
        return view('backend.product.sizes_colors.sizes_colors', $data);

    }

    //STORE SIZES
    public function addSizes(Request $request)
    {

        $request->validate(
            [
                'size' => 'required',
            ],
            [
                'size.required' => 'Size Field Is Required',
            ],
        );

        $size = new Size();
        $size->size = strtoupper($request->size);
        $size->created_by = Auth::id();
        $size->save();

        if ($size) {
            return response()->json([
                'success' => "Size Added successfully",
            ]);
        } else {
            return response()->json([
                'success' => "Something went wrong",
            ]);
        }
    }


    //EDIT SIZE
    public function editSize(Request $request)
    {
        $request->validate(
            [
                'size_e' => 'required',
            ],
            [
                'size_e.required' => 'Size Field Is Required',
            ],
        );
        $id = $request->id_e;
        $size = Size::findOrFail($id);
        $size->size = strtoupper($request->size_e);
        $size->created_by = Auth::id();
        $size->save();

        if ($size) {
            return response()->json([
                'success' => "Size Updated successfully",
            ]);
        } else {
            return response()->json([
                'success' => "Something went wrong",
            ]);
        }
    }


    //STORE COLORS
    public function addColors(Request $request)
    {
        $request->validate(
            [
                'color' => 'required|unique:colors,color',
                'color_code' => 'required|unique:colors,color_code',
            ],
            [
                'color.required' => 'Color Field Is Required',
                'color_code.required' => 'Color Code Field Is Required',
            ],
        );

        $color = new Color();
        $color->color = $request->color;
        $color->color_code = $request->color_code;
        $color->created_by = Auth::id();
        $color->save();

        if ($color) {
            return response()->json([
                'success' => "Color Added successfully",
            ]);
        } else {
            return response()->json([
                'success' => "Something went wrong",
            ]);
        }
    }

    //EDIT COLORS
    public function editColor(Request $request)
    {
        return $request;
        die();
        $request->validate(
            [
                'color_e' => 'required|unique:colors,color',
                'color_code_e' => 'required|unique:colors,color_code',
            ],
            [
                'color_e.required' => 'Color Field Is Required',
                'color_code_e.required' => 'Color Code Field Is Required',
            ],
        );
        $id = $request->id_e;
        $color = Color::findOrFail($id);
        $color->color = $request->color_e;
        $color->color_code = $request->color_code_e;
        $color->created_by = Auth::id();
        $color->save();

        if ($color) {
            return response()->json([
                'success' => "Color Edited successfully",
            ]);
        } else {
            return response()->json([
                'success' => "Something went wrong",
            ]);
        }
    }

}
