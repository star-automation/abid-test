@extends('layouts.admin.app')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Here Products Catagories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"></li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Catagory</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg">Add Catagory</button>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="catagory_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Product Code</th>
                    <th>Section</th>
                    <th>Catagory</th>
                    <th>Meta Title</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                      <tr id="{{$product->id}}">
                          <td>{{$product->name}}</td>
                          <td><img src="{{url('/uploads/products/'.$product->image)}}" width="100"></td>
                          <td>{{$product->code}}</td> 
                          <td>{{$product->catagories['name']}}</td>
                          <td>{{$product->section['name']}}</td>
                          <td>{{$product->meta_title}}</td>
                          <td>{{$product->is_featured}}</td>
                          <td>
                            <input type="checkbox" class="toggle-class admin-change-status-cata"  data-id="{{$product->id}}" data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-warning" {{$product->status == 1? 'checked':''}}>
                          </td>
                          <td>
                            <a href="{{url('admineditproduct/'.$product->id)}}"><input type="submit"class="btn btn-primary" value="Edit" name=""></a> | 
                            <input type="submit" onclick="admin_del_product({{$product->id}})" value="Del" class="btn btn-danger" name="">
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Product Code</th>
                    <th>Section</th>
                    <th>Catagory</th>
                    <th>Meta Title</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
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
  <!-- Add catagory form -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Add Product </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data" action="/add-product" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Prdocut Name</label>
                      <input type="text" name="pro_name" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Select Catagory</label>
                      <select name="pro_catagory_id" id="pro_catagory_id" class="form-control">
                        <option>select</option>
                        @foreach($catagories as $section)
                          <optgroup label="{{$section->name}}"></optgroup>
                          @foreach($section['catagories'] as $catagory)
                              <option value="{{$catagory->id}}">-- {{$catagory->name}}</option>
                              @foreach($catagory['subcatagories'] as $subcatagory)
                                <option value="{{$subcatagory->id}}">---- {{$subcatagory->name}}</option>
                              @endforeach
                          @endforeach
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Product Code</label>
                    <input type="text" name="pro_code" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Product Image</label>
                    <div class="custom-file">
                        <input type="file" name="pro_image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Product Price</label>
                      <input type="text" name="pro_price" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Product Discount (%)</label>
                       <input type="text" name="pro_discount" class="form-control" id="recipient-name" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Product Color</label>
                    <input type="text" name="pro_color" class="form-control" id="recipient-name" required>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Product Weight</label>
                    <input type="text" name="pro_weight" class="form-control" id="recipient-name" required>
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Product Video</label>
                   <div class="custom-file">
                        <input type="file" name="pro_video" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Wash Care</label>
                    <input type="text" name="pro_washcare" class="form-control" id="recipient-name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Product Description</label>
                    <textarea class="form-control" name="pro_desc" id="message-text"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Select Fabric</label>
                    <select name="pro_fabric" class="form-control">
                      <option value="yes">select</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Select Sleeve</label>
                   <select name="pro_sleeve" class="form-control">
                      <option value="yes">select</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Select Fit</label>
                    <select name="pro_fit" class="form-control">
                      <option value="yes">select</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Select Pattern</label>
                    <select name="pro_pattern" class="form-control">
                      <option value="yes">select</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Select Occasion</label>
                    <select name="pro_occasion" class="form-control">
                      <option value="yes">select</option>
                    </select>
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Title</label>
                    <textarea class="form-control" name="pro_meta_title" id="message-text"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Description</label>
                    <input type="text" name="pro_meta_desc" class="form-control" id="recipient-name">
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Keywords</label>
                    <textarea class="form-control" name="pro_meta_keyword" id="message-text"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Featured Item</label>
                    <input type="checkbox" name="pro_feature" class="form-control" id="recipient-name">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success">
          </div>
        </form>
        </div>
      </div>
    </div>
@endsection