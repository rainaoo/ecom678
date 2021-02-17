@extends('layouts.admin_layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Settings</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active"> admin setting</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body" method="post" action="{{ url ('/admin/update-pwd') }}" name="updatepasswordform"
              id="updatepasswordform" >@csrf
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin name</label>
                    <input type="text" class="form-control" readonly="" value="{{ $admindetails->name }}"  placeholder="enter admin name"
                    id="admin_name" name="admin_name">
                  </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input  class="form-control" readonly="" value="{{ Auth::guard('admin')->user()->email }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin type</label>
                    <input  class="form-control" readonly="" value="{{ Auth::guard('admin')->user()->type }}">
                  </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Current Password</label>
                  <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="enter Current Password">
                  <span id="chkCurrentpwd"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="enter new Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="enter confirm Password">
                  </div>
               
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        

        </div>
        <!--/.col (left) -->
        <!-- right column -->
       
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
 </div>
<!-- /.content-wrapper -->
@endsection