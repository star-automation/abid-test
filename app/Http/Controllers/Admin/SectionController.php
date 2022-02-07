<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
class SectionController extends Controller
{
    public function index(){
        $sections = Section::get();
        return view('admin.admin_section',compact('sections'));
    }
    public function AdminSectionStatus(Request $req){
        if($req->ajax()){
            
           $db_section = Section::find($req->status_id);
           $db_section->status = $req->status;
           $db_section->save();
           return response()->json(['success'=>'Status Changed Successfully!']);
        }
    }
}
