<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Products;
use Carbon\Carbon;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        if (Products::where('id',$request->id)->count() > 0) {
            Cart::insert(array('user_id' => Auth::user()->id,
                              'product_id' => $request->id,
                              'created_at' => Carbon::now(),
                              'updated_at' => Carbon::now()));
            $total_price = 0;
            $cart = Cart::where('user_id',Auth::user()->id)->latest()->get();
            $cart_count = Cart::where('user_id',Auth::user()->id)->count();
            foreach ($cart as $key => $value) {
                $total_price += $value->product->price;
            }
           return response()->json(['status' => 200,
                                     'message' => 'Product added to cart',
                                     'total_price' => $total_price,
                                     'cart' => $cart,
                                     'cart_count' => $cart_count]);
        }
        else{
            return response()->json(['status' => 400,
                                     'message' => 'Product not found']);
        }
    }

    public function remove_from_cart($id)
    {
        if (Cart::where('id',$id)->where('user_id',Auth::user()->id)->count() > 0) {
            Cart::destroy($id);
            $total_price = 0;
            $cart = Cart::where('user_id',Auth::user()->id)->latest()->get();
            $cart_count = Cart::where('user_id',Auth::user()->id)->count();
            foreach ($cart as $key => $value) {
                $total_price += $value->product->price;
            }
           return response()->json(['status' => 200,
                                     'message' => 'Product removed from cart',
                                     'total_price' => $total_price,
                                     'cart' => $cart,
                                     'cart_count' => $cart_count]);
        }
        else{
            return response()->json(['status' => 400,
                                     'message' => 'Product not found']);
        }
    }

    public function get_cart()
    {
        
        $total_price = 0;
        $cart = Cart::where('user_id',Auth::user()->id)->latest()->get();
        $cart_count = Cart::where('user_id',Auth::user()->id)->count();
        foreach ($cart as $key => $value) {
            $total_price += $value->product->price;
        }
       return response()->json(['status' => 200,
                                 'total_price' => $total_price,
                                 'cart' => $cart,
                                 'cart_count' => $cart_count]);
    }
}
