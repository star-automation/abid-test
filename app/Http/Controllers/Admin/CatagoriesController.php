<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Catagories;
use App\Section;
use Image;

class CatagoriesController extends Controller
{
      public function VCatagory(Request $req){
        $catagories = Catagories::with(['parentcatagory'])->get();
        $sections = Section::get();
        if($req->isMethod('post')){
            $catagory = new Catagories();
            $catagory->name = $req->cat_name;
            $catagory->parent_id = $req->cat_parent;
            $catagory->section_id = $req->cat_section;
            $catagory->cata_discount = $req->cat_discount;
            $catagory->cata_desc = $req->cat_desc;
            $catagory->url = $req->cat_url;
            $catagory->meta_title = $req->cat_meta_title;
            $catagory->meta_desc = $req->cat_meta_desc;
            $catagory->meta_keywords = $req->cat_meta_keyword;
            $catagory->save();
            // For Image
            if($req->hasFile('cat_image')){
                $image = $req->file('cat_image');
                $filename = time().'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save(public_path('/uploads/catagory/'.$filename));
                
                $catagory->image = $filename;
                $catagory->save();
            }
            // 
            $catagories = Catagories::get();
            $sections = Section::get();
            return view('admin.add_product_cata',compact('catagories','sections'));
        }
        return view('admin.add_product_cata',compact('catagories','sections'));
    }
    public function DeleteCatagory(Request $req){
        $id =$req->id;
        $cata = Catagories::find($id);
        $cata->delete();
        return response()->json(['success'=>'Catagory Deleted Successfully!']);
        
    }
    public function Getsectionforcata(Request $req){
        if($req->ajax()){
           
            $id = $req->cata_section_id;
            $getsectionforcata = Catagories::with('subcatagories')->where(['section_id'=> $id, 'parent_id'=>0, 'status'=>1])->get();
           
            return response()->json(['getsectionforcata'=>$getsectionforcata]);
        }
    }
    public function AdminChangeCatagoryStatus(Request $req){
        if($req->ajax()){
           $db_cata = Catagories::find($req->status_id);
           $db_cata->status = $req->status;
           $db_cata->save();
           return response()->json(['success'=>'Status Changed Successfully!']);
        }
    }
    public function EditCatagory($id){
        $edit_catagory = Catagories::find($id);
        $sections = Section::get();
        $filter_catagory = Catagories::find($edit_catagory->parent_id);
        $catagory = Catagories::get();
        return view('admin.edit_catagory',compact('edit_catagory','sections','catagory','filter_catagory'));
    }
    public function UpdateEditCatagory(Request $req){
        $catagory = Catagories::find($req->cat_id);
        $catagory->name = $req->cat_name;
        $catagory->parent_id = $req->cat_parent;
        $catagory->section_id = $req->cat_section;
        $catagory->cata_discount = $req->cat_discount;
        $catagory->cata_desc = $req->cat_desc;
        $catagory->url = $req->cat_url;
        $catagory->meta_title = $req->cat_meta_title;
        $catagory->meta_desc = $req->cat_meta_desc;
        $catagory->meta_keywords = $req->cat_meta_keyword;
        $catagory->save();
        return redirect()->back();
    }
}
