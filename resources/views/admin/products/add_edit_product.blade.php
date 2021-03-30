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
        @if ($errors->any())
        <div class="alert alert-danger" style="margin-top:10px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
          <form name="productForm" id="productForm"
           @if(empty($productdata['id']))
              action="{{ url ('admin/add_edit_product') }}"
            @else
              action="{{ url ('admin/add_edit_product/'.$productdata['id']) }}" 
            @endif  
                method="post" enctyp="multipart/form-data">@csrf
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Select Category</label>
                        <select  id="category_id" name="category_id" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach($categories as $section)
                        <optgroup label="{{$section['name']}}"></optgroup>
                          @foreach($section['categories'] as $category)
                            <option value="{{$category['id']}}"
                              @if(!empty(@old('category_id'))&& $category['id']==@old('category_id'))
                                selected=""
                                @endif
                                >&nbsp;&nbsp;--&nbsp;&nbsp;{{$category['category_name']}}</option>
                             @foreach($category['subcategories'] as $subcategory)
                             <option value="{{$subcategry['id']}}"
                                @if(!empty(@old('category_id'))&& $subcategory['id']==@old('category_id'))
                                selected=""
                                @endif>
                                &nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{$subcategory['category_name']}}</option>
                             @endforeach
                          @endforeach
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_name">product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product Name"
                        @if(!empty($productdata['product_name']))
                          value="{{$productdata['product_name'] }}"
                              
                          @else
                          value="{{old('product_name') }}"  
                          @endif>
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group">
                        <label for="product_code">product Code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product Code"
                        @if(!empty($productdata['product_code']))
                          value="{{$productdata['product_code'] }}"
                              
                          @else
                          value="{{old('product_code') }}"  
                          @endif>
                    </div>

                    <div class="form-group">
                        <label for="product_color">product Color</label>
                        <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter product Colors"
                        @if(!empty($productdata['product_color']))
                          value="{{$productdata['product_color'] }}"
                              
                          @else
                          value="{{old('product_color') }}"  
                          @endif>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_price">product Price</label>
                        <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product Price"
                        @if(!empty($productdata['product_price']))
                          value="{{$productdata['product_price'] }}"
                              
                          @else
                          value="{{old('product_price') }}"  
                          @endif>
                    </div>

                    <div class="form-group">
                        <label for="product_discount">product Discount (%)</label>
                        <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter product Discount"
                        @if(!empty($productdata['product_discount']))
                          value="{{$productdata['product_discount'] }}"
                              
                          @else
                          value="{{old('product_discount') }}"  
                          @endif>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_weight">product Weight</label>
                        <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter product Weight"
                        @if(!empty($productdata['product_weight']))
                          value="{{$productdata['product_weight'] }}"
                              
                          @else
                          value="{{old('product_weight') }}"  
                          @endif>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">product Main Image</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="main_image" name="main_image" >
                            <label class="custom-file-label" for="main_image">Choose file</label>
                               
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                        </div>
                        <div>Recommend Image Size:(width:1040px ,height:1200px)</div>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                
                <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputFile">product Video</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="product_video" name="product_video" >
                            <label class="custom-file-label" for="product_video">Choose file</label>
                               
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label for="description">product Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ...">
                        @if(!empty($productdata['description']))
                          {{$productdata['description'] }}
                              
                          @else
                          {{old('description') }}  
                          @endif</textarea>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6">
                
                    <div class="form-group">
                        <label for="wash_care">Wash Care</label>
                        <textarea id="wash_care" name="wash_care" class="form-control" rows="3" placeholder="Enter ...">
                        @if(!empty($productdata['wash_care']))
                        {{$productdata['wash_care'] }}
                            
                        @else
                        {{old('wash_care') }} 
                        @endif  </textarea>                 
                    </div>
                    <div class="form-group">
                        <label>Select Fabric</label>
                        <select  id="fabric" name="fabric" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach($fabricArray as $fabric)
                         <option value="{{$fabric}}">{{$fabric}}</option>
                         @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Select Sleeve</label>
                        <select  id="sleeve" name="sleeve" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach($sleeveArray as $sleeve)
                         <option value="{{$sleeve}}">{{$sleeve}}</option>
                         @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Pattern</label>
                        <select  id="pattern" name="pattern" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach($patternArray as $pattern)
                         <option value="{{$pattern}}">{{$pattern}}</option>
                         @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Select Fit</label>
                        <select  id="fit" name="fit" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach($fitArray as $fit)
                         <option value="{{$fit}}">{{$fit}}</option>
                         @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Occasion</label>
                        <select  id="occasion" name="occasion" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach($occasionArray as $occasion)
                         <option value="{{$occasion}}">{{$occasion}}</option>
                         @endforeach
                        </select>
                    </div>
                   
                </div>
              
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea  id="meta_title" name="meta_title" class="form-control" rows="3" placeholder="Enter ...">
                        @if(!empty($productdata['meta_title']))
                       {{$productdata['meta_title'] }}
                            @else
                       {{old('meta_title') }}
                        @endif</textarea>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Enter ...">
                        @if(!empty($productdata['meta_description']))
                            {{$productdata['meta_description'] }}
                        @else
                            {{old('meta_description') }}
                        @endif</textarea>                 
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea id="meta_keywords" name="meta_keywords"  class="form-control" rows="3" placeholder="Enter ...">
                          @if(!empty($productdata['meta_keywords'])) {{
                            $productdata['meta_keywords'] }} @else  {{old('meta_keywords') }}  @endif
                         </textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">Featured Items</label>
                       <input type="checkbox" id="is_featured" name="is_featured" value="yes">
                    </div>
                </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
            <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection