<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Auth;
use Image;

class UserController extends Controller
{
    public function index(){
        return view('user.home');
    }
    public function ProfileChanges(Request $req){
            if($req->hasFile('avatar')){
                $avatar = $req->file('avatar');
                $filename = time().'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatar/'.$filename));
                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();
            }
            return view('user.home');
    }
}
