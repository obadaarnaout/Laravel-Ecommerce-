<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use File;
use DB;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function dashboard(Request $request)
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }
        if(request()->ajax()) {
            $view = View::make('admin.dashboard');
            $sections = $view->renderSections();
            return response()->json(['status' => 200,
                                     'html' => $sections['admin'],
                                     'url' => $request->url(),
                                     'page' => 'admin_dashboard']);
        }
        return view('admin.dashboard');
    }

    public function AdminProfile($id,Request $request)
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }
        $AdminData = User::find($id);

        if(request()->ajax()) {
            $view = View::make('admin.admin_profile',compact('AdminData'));
            $sections = $view->renderSections();
            return response()->json(['status' => 200,
                                     'html' => $sections['admin'],
                                     'url' => $request->url(),
                                     'page' => 'admin_profile']);
        }

        return view('admin.admin_profile',compact('AdminData'));
    }

    public function EditAdminProfile($id,Request $request)
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }
        $AdminData = User::find($id);

        if(request()->ajax()) {
            $view = View::make('admin.edit_admin_profile',compact('AdminData'));
            $sections = $view->renderSections();
            return response()->json(['status' => 200,
                                     'html' => $sections['admin'],
                                     'url' => $request->url(),
                                     'page' => 'admin_edit_profile']);
        }

        return view('admin.edit_admin_profile',compact('AdminData'));
    }

    public function UpdateAdminProfile($id,Request $request)
    {
        if (Auth::user()->admin != 1 || Auth::user()->id != $id) {
            return response()->json(['status' => 400,
                                     'message' => 'You are not admin']);
        }
        $AdminData = User::find($id);
        $AdminData->name = $request->name;
        $AdminData->email = $request->email;

        $avatar = $request->file('avatar');
        if (!empty($avatar)) {
            $name = bin2hex(random_bytes(18)).$avatar->getClientOriginalName();
            $avatar->move(public_path('upload/admin_images'),$name);
            if(File::exists($AdminData->avatar)) {
                File::delete($AdminData->avatar);
            }
            $AdminData->avatar = 'upload/admin_images/'.$name;
        }
        $AdminData->save();
        return response()->json(['status' => 200,
                                 'message' => 'Profile updated']);
    }

    public function ChangeAdminPassword($id,Request $request)
    {
        if (Auth::user()->admin != 1) {
            return view('dashboard');
        }
        if(request()->ajax()) {
            $view = View::make('admin.change_password');
            $sections = $view->renderSections();
            return response()->json(['status' => 200,
                                     'html' => $sections['admin'],
                                     'url' => $request->url(),
                                     'page' => 'change_password']);
        }
        return view('admin.change_password');
    }

    public function UpdateAdminPassword(Request $request)
    {
        $validate = $request->validate(
            [
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => ['same:new_password'],
            ]
        );

        if (Hash::check($request->current_password, Auth::user()->password)) {
            DB::table('users')->where('id',Auth::user()->id)->update(array('password' => Hash::make($request->new_password)));
            Auth::logout();
            return response()->json(['status' => 200,
                                     'message' => 'Password changed',
                                     'url' => url('logout')]);
        }
        else{
            return response()->json(['status' => 400,
                                     'message' => 'Password not match']);
        }
    }
}
