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

class ProductController extends Controller
{
    public function add_product()
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }
        $brands = Brands::latest()->get();
        $categories = Categories::latest()->get();
        $subCategories = SubCategory::latest()->get();
        return view('admin.products.add_product',compact('brands','categories','subCategories'));
    }

    public function add_new_product(Request $request)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }
    }
}
