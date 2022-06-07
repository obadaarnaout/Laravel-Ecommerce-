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

class ProductController extends Controller
{
    public function add_product()
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }
        return view('admin.products.add_product');
    }

    public function add_new_product(Request $request)
    {
        if (Auth::user()->admin != 1) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }
    }
}
