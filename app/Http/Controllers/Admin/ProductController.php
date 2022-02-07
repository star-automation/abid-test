<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product_category;
use App\Product;
use App\Catagories;
use App\Section;
use Image;
class ProductController extends Controller
{
    public function index(Request $req){
        if($req->isMethod('post')){
            $savecatagory = Catagories::find($req->pro_catagory_id);

            $product = new Product();
            $product->name = $req->pro_name;
            $product->catagory_id = $req->pro_catagory_id;
            $product->section_id = $savecatagory->section_id;
            $product->code = $req->pro_code;
            $product->color = $req->pro_color;
            $product->price = $req->pro_price;
            $product->discount = $req->pro_discount;
            $product->weight = $req->pro_weight;
            $product->description = $req->pro_desc;
            $product->wash_care = $req->pro_washcare;
            $product->fabric = $req->pro_fabric;
            $product->pattren = $req->pro_pattern;
            $product->sleeve = $req->pro_sleeve;
            $product->fit = $req->pro_fit;
            $product->occassion = $req->pro_occasion;
            $product->meta_title = $req->pro_meta_title;
            $product->meta_desc = $req->pro_meta_desc;
            $product->meta_keyword = $req->pro_meta_keyword;
            $product->save();
            if($req->hasFile('pro_image')){
                $image = $req->file('pro_image');
                $filename = time().'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save(public_path('/uploads/products/'.$filename));
                
                $product->image = $filename;
                $product->save();
            }
            // 
            
            $products = Product::with('catagories','section')->get();
             $catagories = Section::with('catagories')->get();
            return view('admin.add_product',compact('products','catagories'));
        }
        $products = Product::get();
        $catagories = Section::with('catagories')->get();

        return view('admin.add_product',compact('products','catagories'));
    }
    public function Delete(Request $req){
          $id =$req->id;
        $product = Product::find($id);
        $product->delete();
        return response()->json(['success'=>'Catagory Deleted Successfully!']);
    }
   
}
