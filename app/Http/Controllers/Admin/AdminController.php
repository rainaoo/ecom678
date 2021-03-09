<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
//use Illuminate\Support\Facades\Auth;
//use Symfony\Component\HttpFoundation\Session\Session;
use Session;
use App\Admin;
use Image;
//use Illuminate\Contracts\Session;
//use Illuminate\Support\Facades\Auth as FacadesAuth;
//use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }

    public function settings(){
        Session::put('page','settings');
      // echo "<pre>";print_r(Auth::guard('admin')->user()) ;
      $admindetails=Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('admindetails'));
    }

    public function login(Request $request){
       // echo $password=Hash::make(123);
       if ($request->isMethod('post')){
           //$data=$request->only('email', 'password');
           $data=$request->all();

          echo "<pre>";print_r($data);
          if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect('admin/dashboard');
           
        }else{
           Session::flash('error_message','invalid Email or Password');
            return redirect()->back();
           // echo "<pre>";print_r($data[Hash::make('password')]);
            }

         /* $validatedData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);*/

        $rules=[
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
        $customMassage=[
            'email.required'=>'Email is requerd',
            'email.email'=>'Email is valid',
            'password.required'=>'password is requerd',
        ];
        $this->validate($request,$rules,$customMassage);

       

          }

        
      
        return view('admin.admin_login');
    
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function chCurrentPassword(Request $request){
      $data=$request->all();
      // echo "pre";print_r($data);die;
      // echo Auth::guard('admin')->user()->password;die;
       if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
           echo "true";
       }else{
           echo "false";
       }
    }

    public function updateCurrentPassword(Request $request){
        Session::put('page','update_current_password');
        if ($request->isMethod('post')){
            $data=$request->all();
            //echo "<pre>";print_r($data);die;
            //check if current password is correct
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                //check if new and confirm pwd is match
                if($data['new_pwd']==$data['confirm_pwd']){
                  Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                  Session::flash('success_message','password has been updated successfully');
                }else{
                    Session::flash('error_message','new and confirm pwd is no match');
                    
                }
            }else{
                Session::flash('error_message','your current password is in correct');
               // return redirect()->back();
            }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request){
        Session::put('page','update_admin_details');
        if($request->isMethod('post')){
            $data=$request->all();
          //  echo "<pre>"; print_r($data); die;
            $rules=[
                'admin_name'=>'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile'=>'required|numeric',
                'admin_image'=>'image',


            ];
            $customMessage=[
                'admin_name.required'=>'name is requerd',
                'admin_name.alpha'=>'valid name is required',
                'admin_mobile.required'=>'mobile is requerd',
                'admin_mobile.numeric'=>'valid mobile is required',
                'admin_image.image'=>'valid mobile is required'

            ];
            $this->validate($request,$rules,$customMessage);

            //upload image
            if($request->hasFile('admin_image')){
                $image_tmp=$request->file('admin_image');
                if ($image_tmp->isValid()){
                    //get image extention
                    $extension=$image_tmp->getClientOriginalExtension();
                    //generate new image name
                    $imagName=rand(111,9999).'.'.$extension;
                    $imagePath='images/admin_images/admin_photos/'.$imagName;
                    //upload the image
                    Image::make($image_tmp)->resize('300,300')->save($imagePath);

                }else if(!empty($data['current_admin_image'])){
                    $imagName=$data['current_admin_image'];
                }else{
                    $imagName="";
                }
            }

            //update admin details
            Admin::where('email',Auth::guard('admin')->user()->email)
            ->update(['name'=> $data['admin_name'],'mobile'=> $data['admin_mobile'],'image'=>$imagName]);
            Session::flash('success_message','admin details updated successfully');
            return redirect()->back();

        }
        return view('admin.update_admin_details');
    }
}
