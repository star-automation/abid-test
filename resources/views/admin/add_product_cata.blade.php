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
                    <th>Parent ID</th>
                    <th>Section ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($catagories as $catagory)
                     <tr>
                      @if(!isset($catagory->parentcatagory['name']))
                      <td>Main Catgory</td>
                      @else
                      <?php 
                      $parent_name = $catagory->parentcatagory['name']; ?>
                          <td>{{$parent_name}}</td>
                       @endif
                          @foreach($sections as $section)
                          @if($section->id == $catagory->section_id)
                            <td>{{$section->name}}</td>
                          @endif
                          @endforeach
                          <td>{{$catagory->name}}</td>
                          <td>{{$catagory->cata_desc}}</td>
                          <td>
                            <input type="checkbox" class="toggle-class admin-change-status-cata"  data-id="{{$catagory->id}}" data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-warning" {{$catagory->status == 1? 'checked':''}}>
                          </td>
                          <td>
                            <a href="{{url('admineditcatagory/'.$catagory->id)}}"><input type="submit"class="btn btn-primary" value="Edit" name=""></a> | 
                            <input type="submit" onclick="reply_click({{$catagory->id}})" value="Del" class="btn btn-danger" name="">
                          </td>
                        </tr>
                      
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
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
            <form enctype="multipart/form-data" action="/add-catagory" method="post">
              @csrf
              <div class="row">
                <div class="col-md-12 m-auto">
                  <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Sub Catagory</label>
                         <input type="checkbox" id="check_subcatagory">
                         
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Catagory Name</label>
                      <input type="text" name="cat_name" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Parent Catagory</label>
                      <select name="cat_parent" id="cat_parent_id" class="form-control">
                        <option value="0">Main Catagory</option>

                      </select>
                    </div>
                   
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="message-text" class="col-form-label">Sections</label>
                       <select name="cat_section" id="add_cata_section_id" class="form-control" required>
                          <option>Select Section</option>
                          @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                          @endforeach
                       </select>
                    </div>
                  
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Catagory Image</label>
                    <div class="custom-file">
                        <input type="file" name="cat_image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                  </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Catagory Discount</label>
                      <input type="text" name="cat_discount" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Catagory URL</label>
                       <input type="text" name="cat_url" class="form-control" id="recipient-name" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Title</label>
                    <input type="text" name="cat_meta_title" class="form-control" id="recipient-name" required>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Keywords</label>
                    <input type="text" name="cat_meta_keyword" class="form-control" id="recipient-name" required>
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Catagory Description</label>
                   <textarea class="form-control" name="cat_desc" id="message-text"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Description</label>
                    <textarea class="form-control" name="cat_meta_desc" id="message-text"></textarea>
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