<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Image;
use Session;

class CategoryController extends Controller
{
    //
    public function categories(){
        Session::put('page','categories');
      $categories=Category::with(['section','parentcategory'])->get();
    /* $categories=json_decode(json_encode($categories));
      echo "<pre>";print_r($categories); die;  */
      return view('admin.categories.categories')->with(compact('categories'));
    }


    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
           // echo"<pre>"; print_r($data); die;
           if($data['status']=="Active"){
               $status=0;
           }else{
               $status=1;
           }
           Category::where('id',$data['category_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
     }



     public function addEditCategory(Request $request,$id=null){
            if($id==""){
                $title="Add Category";
                //add category functionality
                $category= new Category;
                $categorydata=array();
                $getCategories=array();
                $message="Category added successfully";
            }else{
                $title="Edit Category";
                //edit category functionality
                $categorydata=Category::where('id',$id)->first();
                $categorydata=json_decode(json_encode($categorydata),true);
                $getCategories=Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$categorydata['section_id']])->get();
                $getCategories=json_decode(json_encode($getCategories),true);
            /*   echo"<pre>";print_r($getCategories);die;  */

            /*  echo"<pre>";print_r($categorydata);die;  */
            //update submit
            $category=Category::find($id);
            $message="Category updated successfully";
            }
            if($request->isMethod('post')){
                $data=$request->all();
              // echo "<pre>"; print_r($data); die;

            //category validation
              $rules=[
                'category_name'=>'required|regex:/^[\pL\s\-]+$/u',
                'section_id'=>'required|numeric',
                'url'=>'required',
              'category_image'=>'image'


            ];
            $customMessage=[
                'category_name.required'=>'name is requerd',
                'category_name.alpha'=>'valid name is required',
                'section_id.required'=>'sections is requerd',
                'section_id.numeric'=>'sections  is required',
                'url.required'=>'category url  is requerd',
                'category_image.image'=>'valid image is required'

            ];
            $this->validate($request,$rules,$customMessage);
 
               //upload image
            if($request->hasFile('category_image')){
                $image_tmp=$request->file('category_image');
                 var_dump($image_tmp);
                if ($image_tmp->isValid()){
                    //get image extention
                    $extension=$image_tmp->getClientOriginalExtension();
                    //generate new image name
                    $imagName=rand(111,9999).'.'.$extension;
                    $imagePath='images/category_images/'.$imagName;
                    //upload the image
                    Image::make($image_tmp)->resize('300,300')->save($imagePath);

                    //save category image
                    $category->category_image=$imagName;
                }
               
            }
               
                if(empty($data['category_dicount'])){
                    $data['category_dicount']="";
                }
                if(empty($data['descrition'])){
                    $data['descrition']="";
                }
                if(empty($data['meta_title'])){
                    $data['cmeta_title']="";
                }
                if(empty($data['meta_descrition'])){
                    $data['meta_descrition']="";
                }
                if(empty($data['meta_keywords'])){
                    $data['meta_keywords']="";
                }
                $category->parent_id=$data['parent_id'];
                $category->section_id=$data['section_id'];
                $category->category_name=$data['category_name'];
               // $category->category_image=$imagName;
                $category->category_discount=$data['category_discount'];
                $category->description=$data['description'];
                $category->url=$data['url'];
                $category->meta_title=$data['meta_title'];
                $category->meta_description=$data['meta_description'];
                $category->meta_keywords=$data['meta_keywords'];
                $category->status=1;
                $category->save();

                Session::flash('success_message',$message);
               return redirect('admin/categories');
            }
            //get all sections
            $getSections=Section::get();
            return view('admin.categories.add_edit_category')->with(compact('title','getSections','categorydata','getCategories'));
        }

        public function AppendCategoriesLevel(Request $request){
            if($request->ajax()){
                $data=$request->all();
               // echo "<pre>";print_r($data);die;
                $getCategories=Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
                $getCategories=json_decode(json_encode($getCategories),true);
              // echo "<pre>";print_r($getCategories);die;
              return view('admin.categories.append_categories_level')->with(compact('getCategories'));

            }
        }
        public function deletCategoryImage($id){
            //get category image
         $categoryImage=Category::select('category_image')->where('id',$id)->first();
         //get category image path
         $category_image_path='images/category_images/';
         //delete category image form categoy_images folder if exists
         if(file_exists($category_image_path.$categoryImage->category_image)){
             unlink($category_image_path.$categoryImage->category_image);
         }
         //delete category image form categoies table
         Category::where('id',$id)->update(['category_image'=>'']);

         $message='category image has been deleted successfully!';
         Session::flash('success_message',$message);
         return redirect()->back();
        }

        public function deletCategory($id){
          Category::where('id',$id)->delete();

          $message='category  has been deleted successfully!';
         Session::flash('success_message',$message);
         return redirect()->back();

          
        }
    }
