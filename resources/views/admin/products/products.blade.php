@extends('layouts.admin_layout.admin_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->
            
            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
               {{Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products</h3>
                <a href="{{ url('admin/add_edit_product') }}" class="btn  btn-success" style="max-width:150px;float:right;display-inline-block">Add Product</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="products" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Product Code</th>
                      <th>Product Color</th>
                      <th>Category</th>
                      <th>Section </th>
                      <th>Status</th>
                      <th>Actions</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($products as $product)
                       
                      <tr>
                        <td>{{$product->id }}</td>
                        <td>{{$product->product_name }}</td>
                        <td>{{$product->product_code }}</td>
                        <td>{{$product->product_code}}</td>
                        <td>{{$product->category->category_name}}</td>
                        <td>{{$product->section->name}}</td>
                        <td>
                      @if($product->status==1)
                        <a class="updateProductStatus"  id="product-{{$product->id }}" 
                            product_id="{{$product->id }}" href="javascript:void(0)"> Active </a>
                      @else
                      <a class="updateProductStatus"  id="product-{{$product->id }}" 
                        product_id="{{$product->id }}" href="javascript:void(0)"> Inactive </a>
                      @endif
                      </td>
                      <td>
                        <a href="{{ url('admin/add_edit_product',$product->id)}}">Edit</a>
                        &nbsp;&nbsp;
                        <a class="confirmDelete" name="product" record="product" recordid="{{$product->id }}" 
                          <?php /*  href="{{ url('admin/delete-product',$product->id)}}" */?>>Delete</a>
                      </td> 
                      </tr>
                   @endforeach
                  </table>
                 
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
