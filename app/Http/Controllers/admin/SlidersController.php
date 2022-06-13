<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sliders;
use Image;
use DB;
use File;
use Carbon\Carbon;

class SlidersController extends Controller
{
    public function sliders()
    {
        $sliders = Sliders::latest()->get();
        return view('admin.sliders.all_sliders',compact('sliders'));
    }

    public function add_slider(Request $request)
    {
        $validate = $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
            ]
        );

        $image = $request->file('image');
        $name = bin2hex(random_bytes(18)).$image->getClientOriginalName();
        Image::make($image)->save(public_path('upload/sliders/').$name);

        $insert_data = array('title' => $request->title,
                             'description' => $request->description,
                             'created_at' => Carbon::now(),
                             'image' => 'upload/sliders/'.$name);

        Sliders::insert($insert_data);
        return response()->json(['status' => 200,
                                 'message' => 'Slider added']);
    }

    public function edit_slider($id)
    {
        if (empty($id) || !is_numeric($id)) {
            return redirect('dashboard');
        }
        
        $slider = Sliders::find($id);

        return view('admin.sliders.edit_slider',compact('slider'));
    }

    public function update_slider($id,Request $request)
    {
        $validate = $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'sometimes|nullable|mimes:jpeg,jpg,png,gif',
            ]
        );

        $slider = Sliders::find($id);
        if (empty($slider)) {
            return response()->json(['status' => 400,
                                     'message' => 'Slider not found']);
        }

        $update_data = array('title' => $request->title,
                             'description' => $request->description);

        $image = $request->file('image');
        if (!empty($image)) {
            if(File::exists($slider->image)) {
                File::delete($slider->image);
            }
            $name = bin2hex(random_bytes(18)).$image->getClientOriginalName();
            Image::make($image)->save(public_path('upload/sliders/').$name);
            $update_data['image'] = 'upload/sliders/'.$name;
        }

        Sliders::whereId($id)->update($update_data);
        return response()->json(['status' => 200,
                                 'message' => 'Slider updated']);
    }

    public function delete_slider($id)
    {
        $slider = Sliders::find($id);
        if (empty($slider)) {
            return redirect('dashboard');
        }

        if(File::exists($slider->image)) {
            File::delete($slider->image);
        }
        Sliders::destroy($id);
        return redirect('admin/sliders');
    }
}
