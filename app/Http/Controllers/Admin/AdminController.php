<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Auth;
use Image;
use App\User;

class AdminController extends Controller
{
    public function index(){
        $users = User::get();
        return view('admin.index',compact('users'));
    }
    public function Profile(){
        return view('admin.profile');
    }
    public function ProfileEdit(Request $request){
       if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time().'.'.$avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatar/'.$filename));
        $user = Auth::user();
        $user->avatar = $filename;
        $user->name = $request->name;
        $user->save();
       }
    $user = Auth::user();
    $user->name = $request->name;
    return view('admin.profile');

    }
}
