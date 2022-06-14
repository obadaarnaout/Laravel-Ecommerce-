<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TranslateController extends Controller
{
    public function update_current_lang($lang='english')
    {
        if (Auth::check()) {
            $UserData = User::find(Auth::user()->id);
            $UserData->lang = $lang;
            $UserData->save();
        }
        setcookie('default_lang',$lang,time()+(60 * 60 * 24 * 7),'/');
        return redirect('/');
    }
}
