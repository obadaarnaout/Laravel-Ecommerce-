<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;
use File;
use Carbon\Carbon;
use App\Models\Sliders;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Cart;

class HomeController extends Controller
{
    public function Home()
    {
        $sliders = Sliders::latest()->get();
        $products = Products::latest()->get();
        $categories = Categories::latest()->get();
        $brands = Brands::latest()->get();
        $CartCount = 0;
        $CartSum = 0;
        $Cart = null;
        if (Auth::check()) {
            $CartCount = Cart::where('user_id',Auth::user()->id)->count();
            $Cart = Cart::where('user_id',Auth::user()->id)->latest()->get();
            foreach ($Cart as $key => $value) {
                $CartSum += $value->product->price;
            }
        }
        
        return view('frontend/home',compact('sliders','products','categories','brands','Cart','CartCount','CartSum'));
    }
}
