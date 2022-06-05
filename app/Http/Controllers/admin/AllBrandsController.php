<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;
use File;

class AllBrandsController extends Controller
{
    public function all_brands()
    {
        $brands = Brands::latest()->get();
        return view('admin.brands.all_brands',compact('brands'));
    }

    public function add_brand(Request $request)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }

        $validate = $request->validate(
            [
                'name' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif'
            ]
        );

        $image = $request->file('image');
        $name = bin2hex(random_bytes(18)).$image->getClientOriginalName();
        Image::make($image)->resize(300,300)->save(public_path('upload/brands/').$name);
        Brands::insert(['name' => $request->name,
                        'slug' => strtolower(str_replace(' ', '-', $request->name)),
                        'image' => 'upload/brands/'.$name]);
        return response()->json(['status' => 200,
                                 'message' => 'Brand added']);

    }

    public function edit_brand($id)
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }

        $brand = DB::table('brands')->find($id);
        if (!empty($brand)) {
            return view('admin.brands.edit_brand',compact('brand'));
        }
        return view('admin.dashboard');
    }

    public function update_brand($id,Request $request)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }

        if (empty($id) || !is_numeric($id)) {
            return response()->json(['status' => 400,
                                     'message' => 'id can not be empty']);
        }
        $brand = DB::table('brands')->find($id);

        $validate = $request->validate(
            [
                'name' => 'required',
                'image' => 'sometimes|nullable|mimes:jpeg,jpg,png,gif'
            ]
        );

        $update_data = array('name' => $request->name,
                             'slug' => strtolower(str_replace(' ', '-', $request->name)));
        $image = $request->file('image');

        if (!empty($image)) {
            $name = bin2hex(random_bytes(18)).$image->getClientOriginalName();
            Image::make($image)->resize(300,300)->save(public_path('upload/brands/').$name);
            $update_data['image'] = 'upload/brands/'.$name;
            if(File::exists($brand->image)) {
                File::delete($brand->image);
            }
        }
        Brands::whereId($id)->update($update_data);
        return response()->json(['status' => 200,
                                 'message' => 'Brand updated']);

    }

    public function delete_brand($id)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }

        if (empty($id) || !is_numeric($id)) {
            return response()->json(['status' => 400,
                                     'message' => 'id can not be empty']);
        }

        $brand = Brands::find($id);
        if(File::exists($brand->image)) {
            File::delete($brand->image);
        }
        Brands::destroy($id);
        return redirect('admin/all_brands');
    }
}
