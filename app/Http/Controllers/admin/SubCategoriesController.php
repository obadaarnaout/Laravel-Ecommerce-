<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;
use File;

class SubCategoriesController extends Controller
{
    public function all_categories()
    {
        $categories = Categories::latest()->get();
        $sub_categories = SubCategory::latest()->get();
        return view('admin.sub_categories.all_sub_categories',compact('categories','sub_categories'));
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
                'category' => 'required'
            ]
        );

        SubCategory::insert(['name' => $request->name,
                             'slug' => strtolower(str_replace(' ', '-', $request->name)),
                             'category_id' => $request->category]);
        return response()->json(['status' => 200,
                                 'message' => 'Category added']);

    }

    public function edit_category($id)
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }
        $categories = Categories::latest()->get();

        $category = DB::table('sub_categories')->find($id);
        if (!empty($category)) {
            return view('admin.sub_categories.edit_sub_category',compact('category','categories'));
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
        $category = DB::table('sub_categories')->find($id);

        $validate = $request->validate(
            [
                'name' => 'required',
                'category' => 'required'
            ]
        );

        $update_data = array('name' => $request->name,
                             'slug' => strtolower(str_replace(' ', '-', $request->name)),
                             'category_id' => $request->category);
        SubCategory::whereId($id)->update($update_data);
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

        $category = SubCategory::find($id);
        SubCategory::destroy($id);
        return redirect('admin/sub/all_categories');
    }
}
