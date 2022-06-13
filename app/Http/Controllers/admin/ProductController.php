<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;
use File;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\SubCategory;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function add_product()
    {
        if (Auth::user()->admin != 1) {
            return redirect('dashboard');
        }
        $brands = Brands::latest()->get();
        $categories = Categories::latest()->with('sub_category')->get();
        $subCategories = SubCategory::latest()->get();
        return view('admin.products.add_product',compact('brands','categories','subCategories'));
    }

    public function add_new_product(Request $request)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }

        $validate = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'sub_category' => 'required',
                'category' => 'required',
                'brand' => 'required',
                'thumb' => 'required|mimes:jpeg,jpg,png,gif',
                'images.*' => 'required|mimes:jpeg,jpg,png,gif',
            ]
        );

        $image = $request->file('thumb');
        $name = bin2hex(random_bytes(18)).$image->getClientOriginalName();
        Image::make($image)->resize(300,300)->save(public_path('upload/products/').$name);

        $insert_data = array('name' => $request->name,
                             'description' => $request->description,
                             'price' => $request->price,
                             'sub_category_id' => $request->sub_category,
                             'category_id' => $request->category,
                             'brand_id' => $request->brand,
                             'created_at' => Carbon::now(),
                             'slug' => strtolower(str_replace(' ', '-', $request->name)),
                             'thumb' => 'upload/products/'.$name);

        $product_id = Products::insertGetId($insert_data);
        $images = $request->file('images');
        foreach ($images as $key => $image) {

            $name = bin2hex(random_bytes(18)).$image->getClientOriginalName();
            Image::make($image)->save(public_path('upload/products/').$name);
            Media::insert(array('image' => 'upload/products/'.$name,
                                'created_at' => Carbon::now(),
                                'product_id' => $product_id));
        }
        return response()->json(['status' => 200,
                                 'message' => 'Product added']);
    }

    public function all_products()
    {
        if (Auth::user()->admin != 1) {
            return redirect('dashboard');
        }
        $products = Products::latest()->get();
        return view('admin.products.all_products',compact('products'));
    }

    public function delete_product($id)
    {
        if (Auth::user()->admin != 1) {
            return redirect('dashboard');
        }
        if (empty($id) || !is_numeric($id)) {
            return redirect('dashboard');
        }
        $product = Products::find($id);
        if (empty($product)) {
            return redirect('dashboard');
        }

        if(File::exists($product->thumb)) {
            File::delete($product->thumb);
        }
        foreach ($product->media as $key => $image) {
            if(File::exists($image->image)) {
                File::delete($image->image);
            }
            Media::destroy($image->id);
        }
        Products::destroy($id);
        return redirect('admin/products');
    }

    public function edit_product($id)
    {
        if (Auth::user()->admin != 1) {
            return redirect('dashboard');
        }
        if (empty($id) || !is_numeric($id)) {
            return redirect('dashboard');
        }
        $brands = Brands::latest()->get();
        $categories = Categories::latest()->with('sub_category')->get();
        $subCategories = SubCategory::latest()->get();
        $product = Products::find($id);

        return view('admin.products.edit_product',compact('product','brands','categories','subCategories'));
    }

    public function update_product($id,Request $request)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }

        $validate = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'sub_category' => 'required',
                'category' => 'required',
                'brand' => 'required',
                'thumb' => 'sometimes|nullable|mimes:jpeg,jpg,png,gif',
                'images.*' => 'sometimes|nullable|mimes:jpeg,jpg,png,gif',
            ]
        );
        $product = Products::find($id);

        $update_data = array('name' => $request->name,
                             'description' => $request->description,
                             'price' => $request->price,
                             'sub_category_id' => $request->sub_category,
                             'category_id' => $request->category,
                             'brand_id' => $request->brand,
                             'slug' => strtolower(str_replace(' ', '-', $request->name)));

        $image = $request->file('thumb');
        if (!empty($image)) {
            if(File::exists($product->thumb)) {
                File::delete($product->thumb);
            }
            
            $name = bin2hex(random_bytes(18)).$image->getClientOriginalName();
            Image::make($image)->resize(300,300)->save(public_path('upload/products/').$name);
            $update_data['thumb'] = 'upload/products/'.$name;
        }

        $images = $request->file('images');
        if (!empty($images)) {
            foreach ($images as $key => $image) {

                $name = bin2hex(random_bytes(18)).$image->getClientOriginalName();
                Image::make($image)->save(public_path('upload/products/').$name);
                Media::insert(array('image' => 'upload/products/'.$name,
                                    'created_at' => Carbon::now(),
                                    'product_id' => $id));
            }
            foreach ($product->media as $key => $image) {
                if(File::exists($image->image)) {
                    File::delete($image->image);
                }
                Media::destroy($image->id);
            }
        }

        Products::whereId($id)->update($update_data);
        
        return response()->json(['status' => 200,
                                 'message' => 'Product edited']);
    }
}
