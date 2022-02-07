<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class ViewsellerController extends Controller
{
    public function index(){
        $users = User::get();
        return view('admin.viewseller',compact('users'));
    }
    public function ChangeStatus(Request $req){
        $user = User::find($req->status_id);
        $user->status = $req->status;
        $user->save();
        return response()->json(['success'=>'Status Change Successfully!']); 
    }
}
