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
              <h3 class="card-title">Update Admin Details</h3>
            </div>
            <!-- /.card-header -->
            @if(Session::has('error_message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top:10px;">
               {{Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if(Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
             {{Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
            @if ($errors->any())
            <div class="alert alert-danger" style="margin-top:10px">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
           @endif
            <!-- form start -->
            <form  method="post" action="{{ url ('/admin/update_admin_details') }}" 
               name="updateAdminDetails" id="updateAdminDetails " enctype="multipart/form-data">@csrf
              <div class="card-body" >
                
              <?php  /*<div class="form-group">
                    <label for="exampleInputEmail1">Admin name</label>
                    <input type="text" class="form-control" readonly="" value="{{ $admindetails->name }}"  placeholder="enter admin name"
                    id="admin_name" name="admin_name">
                  </div>*/?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input  class="form-control" readonly="" value="{{ Auth::guard('admin')->user()->email }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin type</label>
                    <input  class="form-control" readonly="" value="{{ Auth::guard('admin')->user()->type }}">
                  </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Name</label>
                  <input type="text" class="form-control" id="admin_name" value="{{ Auth::guard('admin')->user()->name }}"
                         name="admin_name" placeholder="enter admin name" required="">
                  
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input type="text" class="form-control" id="admin_mobil" value="{{ Auth::guard('admin')->user()->mobile }}"
                           name="admin_mobile" placeholder="enter admin mobile" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Image</label>
                    <input type="file" class="form-control" id="admin_image"  name="admin_image" accept="image/*" >
                    @if(!empty(Auth::guard('admin')->user()->image))
                    <a target="_blank" href="{{ url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image)}}">View Image</a>
                    <input type="hidden" name="current_admin_image" vlaue="{{Auth::guard('admin')->user()->image}}">
                    @endif
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