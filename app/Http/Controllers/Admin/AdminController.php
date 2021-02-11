<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use App\Admin;
//use Illuminate\Contracts\Session;
//use Illuminate\Support\Facades\Auth as FacadesAuth;
//use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.admin_dashboard');
    }

    public function settings(){
      // echo "<pre>";print_r(Auth::guard('admin')->user()) ;
      $admindetails=Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('admindetails'));
    }

    public function login(Request $request){
       // echo $password=Hash::make(123);
       if ($request->isMethod('post')){
           $data=$request->only('email', 'password');
          /* echo "<pre>";print_r($data);*/

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

         if(Auth::guard('admin')->attempt($data)){
             return redirect('admin/dashboard');
            
         }else{
            Session::flash('error_message','invalid Email or Password');
             return redirect()->back();
             
             }

          }

        
      
        return view('admin.admin_login');
    
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
