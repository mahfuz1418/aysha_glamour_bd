<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeSliderController extends Controller
{
    public function index()
    {
        $data['sliders'] = HomeSlider::paginate(10);
        $data['trashSlider'] = HomeSlider::onlyTrashed()->get();
        return view('backend.home_page.home_slider.index', $data);
    }

    public function storeSlider(Request $request)
    {
        $request->validate(
            [
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'slider_heading' => 'required|string|max:255',
                'slider_paragraph' => 'required|string',
                'active_status' => 'required|in:0,1',
            ],
            [
                'thumbnail.required' => 'Please Choose a Thumbnail',
                'slider_heading.required' => 'Please Write Slider Heading',
                'slider_paragraph.required' => 'Please Write Slider Paragraph',
                'active_status.required' => 'Active Status Is Required',
            ],
        );

        $image = '';
        if ($request->file('thumbnail')) {
            $image = uploadPlease($request->file('thumbnail'));
        }

        $slider = new HomeSlider();
        $slider->thumbnail = $image;
        $slider->slider_heading = $request->slider_heading;
        $slider->slider_paragraph = $request->slider_paragraph;
        $slider->active_status = $request->active_status;
        $slider->created_by = Auth::id();
        $slider->save();

        if ($slider) {
            return response()->json([
                'success' => "Slider Added successfully",
            ]);
        } else {
            return response()->json([
                'success' => "Something went wrong",
            ]);
        }
    }

    public function editSlider(Request $request)
    {
        $request->validate(
            [
                'slider_heading_e' => 'required|string|max:255',
                'slider_paragraph_e' => 'required|string',
                'active_status_e' => 'required|in:0,1',
            ],
            [
                'slider_heading_e.required' => 'Please Write Slider Heading',
                'slider_paragraph_e.required' => 'Please Write Slider Paragraph',
                'active_status_e.required' => 'Active Status Is Required',
            ],
        );

        $slider = HomeSlider::findOrFail($request->id);
        if ($request->file('thumbnail_e')) {
            $request->validate(
                [
                    'thumbnail_e' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                ],
                [
                    'thumbnail_e.required' => 'Please Choose a subcategory image',
                ],
            );

            if (isset($slider) && is_object($slider) && isset($slider->thumbnail)) {
                $image = '';
                File::delete($slider->thumbnail);
                $image = uploadPlease($request->file('thumbnail_e'));
                $slider->thumbnail = $image;
            }
        }
        $slider->slider_heading = $request->slider_heading_e;
        $slider->slider_paragraph = $request->slider_paragraph_e;
        $slider->active_status = $request->active_status_e;
        $slider->created_by = Auth::id();
        $slider->save();

        if ($slider) {
            return response()->json([
                'success' => "Slider Updated successfully",
            ]);
        } else {
            return response()->json([
                'success' => "Something went wrong",
            ]);
        }
    }

    //DELETE SLIDER
    public function deleteSlider($id)
    {
        $slider = HomeSlider::findOrFail($id)->delete();
        return redirect()->back();
    }

    //RESTORE SLIDER
    public function resotoreSlider($id)
    {
        HomeSlider::onlyTrashed()->find($id)->restore();
        return back()->with('message', 'Slider Restored Successfully');
    }

    //RESTORE ALL SLIDER
    public function resotoreAllSlider()
    {
        HomeSlider::onlyTrashed()->where('deleted_at', '!=' , null)->restore();
        return back()->with('message', 'All Slider Restored Successfully');
    }

    // FORCE DELETE SLIDER
    public function forceDeleteSlider($id)
    {
        $slider = HomeSlider::onlyTrashed()->find($id);
        unlink(public_path($slider->thumbnail));
        $slider->forceDelete();
        return back()->with('message', 'Slider Deleted Permanently');
    }

    // FORCE DELETE PRODUCT
    public function forceDeleteAllSlider()
    {
        $trushSlider = HomeSlider::onlyTrashed()->where('deleted_at', '!=' , null)->get();
        foreach ($trushSlider as $trash) {
            unlink(public_path($trash->thumbnail));
            $trash->forceDelete();
        }
        return back()->with('message', 'All Slider Permanently Deleted');
    }

}
