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

class HomeController extends Controller
{
    public function Home()
    {
        $sliders = Sliders::latest()->get();
        $products = Products::latest()->get();
        return view('frontend/home',compact('sliders','products'));
    }
}
