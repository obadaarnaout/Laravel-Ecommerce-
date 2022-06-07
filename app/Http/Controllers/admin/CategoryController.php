<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;
use File;

class CategoryController extends Controller
{
    public function all_categories()
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }
        $categories = Categories::latest()->get();
        return view('admin.categories.all_categories',compact('categories'));
    }

    public function add_category(Request $request)
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
        Image::make($image)->resize(300,300)->save(public_path('upload/categories/').$name);
        Categories::insert(['name' => $request->name,
                        'slug' => strtolower(str_replace(' ', '-', $request->name)),
                        'image' => 'upload/categories/'.$name]);
        return response()->json(['status' => 200,
                                 'message' => 'Category added']);

    }

    public function edit_category($id)
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }

        $category = DB::table('categories')->find($id);
        if (!empty($category)) {
            return view('admin.categories.edit_category',compact('category'));
        }
        return view('admin.dashboard');
    }

    public function update_category($id,Request $request)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }

        if (empty($id) || !is_numeric($id)) {
            return response()->json(['status' => 400,
                                     'message' => 'id can not be empty']);
        }
        $category = DB::table('categories')->find($id);

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
            Image::make($image)->resize(300,300)->save(public_path('upload/categories/').$name);
            $update_data['image'] = 'upload/categories/'.$name;
            if(File::exists($category->image)) {
                File::delete($category->image);
            }
        }
        Categories::whereId($id)->update($update_data);
        return response()->json(['status' => 200,
                                 'message' => 'Category updated']);

    }

    public function delete_category($id)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }

        if (empty($id) || !is_numeric($id)) {
            return response()->json(['status' => 400,
                                     'message' => 'id can not be empty']);
        }

        $category = Categories::find($id);
        if(File::exists($category->image)) {
            File::delete($category->image);
        }
        Categories::destroy($id);
        return redirect('admin/all_categories');
    }
}
