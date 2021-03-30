<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Category;
use App\Product;
use Session;
use Image;
class ProductsController extends Controller
{
    //
    public function products(){
        Session::put('page','products');
        $products=Product::with(['category'=>function($query){
            $query->select('id','category_name');
        },'section'=>function($query){
            $query->select('id','name');
        }])->get();
       /* $products=json_decode(json_encode($products));
        echo "<pre>"; print_r($products); die; */
       return view('admin.products.products')->with(compact('products'));
    }


    
    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
        //  echo"<pre>"; print_r($data); die;
           if($data['status']=="Active"){
               $status=0;
           }else{
               $status=1;
           }
           Product::where('id',$data['product_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
     }

     public function deletProduct($id){
        Product::where('id',$id)->delete();

        $message='Product has been deleted successfully!';
       Session::flash('success_message',$message);
       return redirect()->back();

      }

      public function addEditProduct(Request $request,$id=null){
        if($id==""){
            $title="Add Product";
            $product= new Product;
        }else{
            $title="Edit Product";
        }
        
        if($request->isMethod('post')){
            $data=$request->all();
           //echo "<pre>"; print_r($data); die;

              //product validation
              $rules=[
                'category_id'=>'required',
                'product_name'=>'required|regex:/^[\pL\s\-]+$/u',
                'product_code'=>'required|regex:/^[\w-]*$/',
                'product_color'=>'required|regex:/^[\pL\s\-]+$/u',
                'product_price'=>'required|numeric'


            ];
            $customMessage=[
                'category_id.required'=>'category is requerd',
                'product_name.required'=>'product name is required',
                'product_name.regex'=>'valid product name is requerd',
                'product_code.required'=>'product code is required',
                'section_code.regex'=>'valid product code is requerd',
                'product_color.required'=>'product color is required',
                'product_color.regex'=>'valid product color is requerd',
                'product_price.required'=>'product price is required',
                'product_price.numeric'=>'valid product price is requerd',

            ];
            $this->validate($request,$rules,$customMessage);

            if(empty($data['is_featured'])){
                $is_featured="no";
            }else{
                $is_featured="yes"; 
            }

            
            if(empty($data['fabric'])){
                $data['fabric']="";
            }
            if(empty($data['sleeve'])){
                $data['sleeve']="";
            }
            if(empty($data['pattern'])){
                $data['pattern']="";
            }
            if(empty($data['fit'])){
                $data['fit']="";
            }
            if(empty($data['occasion'])){
                $data['occasion']="";
            }
            if(empty($data['meta_title'])){
                $data['meta_title']="";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords']="";
            }
            if(empty($data['meta_description'])){
                $data['meta_description']="";
            }
            if(empty($data['description'])){
                $data['description']="";
            }
            if(empty($data['product_weight'])){
                $data['product_weight']="";
            }
            if(empty($data['wash_care'])){
                $data['wash_care']="";
            }

            //upload product image
            if($request->hasFile('main_image')){
              echo $image_tmp=$request->file('main_image'); die;
              /*  if($image_tmp->isValid()){
                   //upload image after resize
                   $image_name=$image_tmp->getClientOriginalName();
                   $extension=$image_tmp->getClientOriginalExtension();
                   $imageName=$image_name.'_'.rand(111,99999).'.'.$extension;
                   $large_image_path='images/product_images/large/'.$imageName;
                   $medium_image_path='images/product_images/medium/'.$imageName;
                   $small_image_path='images/product_images/small/'.$imageName;
                   Image::make($image_tmp)->save($large_image_path);
                   Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(250,300)->save($small_image_path);
                   $product->main_image=$imageName;

               } */
            }

            //upload product video
            if($request->hasFile('product_video')){
              $video_tmp=$request->file('product_video');
              if($video_tmp->isValid()){
              $video_name=$video_tmp->getClientOriginalName();
              $extension=$video_tmp->getClientOriginalExtension();
              $videoName=$video_name.'_'.rand(111,99999).'.'.$extension;
              $video_path='videos/product_videos/large/';
              $video_tmp->move($video_path,$videoName);

              $product->product_video=$videoName;

              }
            }
            //save product data in table
            $categorydetails=Category::find($data['category_id']);
            $product->section_id=$categorydetails['section_id'];
            $product->category_id=$data['category_id'];
            $product->product_name=$data['product_name'];
            $product->product_code=$data['product_code'];
            $product->product_color=$data['product_color'];
            $product->product_price=$data['product_price'];
            $product->product_discount=$data['product_discount'];
            $product->product_weight=$data['product_weight'];
            $product->wash_care=$data['wash_care'];
            $product->fabric=$data['fabric'];
            $product->sleeve=$data['sleeve'];
            $product->pattern=$data['pattern'];
            $product->fit=$data['fit'];
            $product->occasion=$data['occasion'];
            $product->meta_title=$data['meta_title'];
            $product->meta_keywords=$data['meta_keywords'];
            $product->meta_description=$data['meta_description'];
            $product->is_featured=$is_featured;
            $product->status=1;
            $product->save();

            Session::flash('sucess_message','product added successfully');
            return redirect('admin/products');

        }
        //fillter arrays
        $fabricArray=array('Cotton','Palyester','Wool');
        $sleeveArray=array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless');
        $patternArray=array('Checked','Pain','Printed','Self','Solid');
        $fitArray=array('Regular','Slim');
        $occasionArray=array('Casual','Formal');
       //sections with category
       $categories=Section::with('categories')->get();
       $categories=json_decode(json_encode($categories),true);
     //  echo "<pre>"; print_r($categories);die;

       return view('admin.products.add_edit_product')->with(compact('title','fabricArray','sleeveArray','patternArray','fitArray','occasionArray','categories'));
        }

}
