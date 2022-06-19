<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;

class StripeController extends Controller
{
    public function stripe_pay()
    {
        $CartSum = 0;
        if (Auth::check()) {
            $Cart = Cart::where('user_id',Auth::user()->id)->get();
            foreach ($Cart as $key => $value) {
                $CartSum += $value->product->price;
            }
        }
        if ($CartSum == 0) {
            return redirect('/');
        }
        
        $stripe = array(
          "secret_key"      =>  'sk_test_uCdSAxdCAoQksqIjfMoXFOmt',
          "publishable_key" =>  'pk_test_1ujWeV5SjafkpuEK7NMpURNz'
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'USD',
                'product_data' => [
                  'name' => 'Buy Products',
                ],
                'unit_amount' => $CartSum * 100,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('stripe_success'),
            'cancel_url' =>  url('stripe_cancel'),
        ]);

        $UserData = User::find(Auth::user()->id);
        $UserData->stripe_key = $checkout_session->id;
        $UserData->save();
        return redirect($checkout_session->url);
    }

    public function stripe_success(Request $request)
    {
        if (empty(Auth::user()->stripe_key)) {
            return redirect('/')->with('error', 'Something went wrong'); 
        }
        $stripe = array(
          "secret_key"      =>  'sk_test_uCdSAxdCAoQksqIjfMoXFOmt',
          "publishable_key" =>  'pk_test_1ujWeV5SjafkpuEK7NMpURNz'
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $checkout_session = \Stripe\Checkout\Session::retrieve(Auth::user()->stripe_key);
        if ($checkout_session->payment_status == 'paid') {
            $UserData = User::find(Auth::user()->id);
            $UserData->stripe_key = '';
            $UserData->save();
            Cart::where('user_id',Auth::user()->id)->delete();
            return redirect('/')->with('success', 'Payment successfully done');  
        }
        else{
            return redirect('/')->with('error', 'Something went wrong'); 
        }
    }
    public function stripe_cancel(Request $request)
    {
        $UserData = User::find(Auth::user()->id);
        $UserData->stripe_key = '';
        $UserData->save();
        Cart::where('user_id',Auth::user()->id)->delete();
        return redirect('/')->with('error', 'Payment successfully canceled'); 
    }
}
