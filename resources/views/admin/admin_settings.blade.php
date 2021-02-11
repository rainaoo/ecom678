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
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin name</label>
                    <input type="text" class="form-control" readonly="" value="{{ $admindetails->name }}"  placeholder="enter admin name">
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
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="enter Current Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="enter new Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="enter confirm Password">
                  </div>
               
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Different Styles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <h4>Input</h4>
              <div class="form-group">
                <label for="exampleInputBorder">Bottom Border only <code>.form-control-border</code></label>
                <input type="text" class="form-control form-control-border" id="exampleInputBorder" placeholder=".form-control-border">
              </div>
              <div class="form-group">
                <label for="exampleInputBorderWidth2">Bottom Border only 2px Border <code>.form-control-border.border-width-2</code></label>
                <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder=".form-control-border.border-width-2">
              </div>
              <div class="form-group">
                <label for="exampleInputRounded0">Flat <code>.rounded-0</code></label>
                <input type="text" class="form-control rounded-0" id="exampleInputRounded0" placeholder=".rounded-0">
              </div>
              <h4>Custom Select</h4>
              <div class="form-group">
                <label for="exampleSelectBorder">Bottom Border only <code>.form-control-border</code></label>
                <select class="custom-select form-control-border" id="exampleSelectBorder">
                  <option>Value 1</option>
                  <option>Value 2</option>
                  <option>Value 3</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleSelectBorderWidth2">Bottom Border only <code>.form-control-border.border-width-2</code></label>
                <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                  <option>Value 1</option>
                  <option>Value 2</option>
                  <option>Value 3</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleSelectRounded0">Flat <code>.rounded-0</code></label>
                <select class="custom-select rounded-0" id="exampleSelectRounded0">
                  <option>Value 1</option>
                  <option>Value 2</option>
                  <option>Value 3</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
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