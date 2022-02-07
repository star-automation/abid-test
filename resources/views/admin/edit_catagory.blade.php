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
                <h3 class="card-title">Edit Catagory</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
            <form enctype="multipart/form-data" action="/update-edit-catagory" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Catagory Name</label>
                      <input type="hidden" name="cat_id" value="{{$edit_catagory->id}}" class="form-control" id="recipient-name" required>
                      <input type="text" name="cat_name" value="{{$edit_catagory->name}}" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Parent Catagory</label>
                      <select name="cat_parent" id="cat_parent_id" class="form-control">
                        
                          @if(isset($filter_catagory))
                            <option value="{{$filter_catagory->id}}">{{$filter_catagory->name}}</option>
                          @else
                            <option value="0">Main Catagory</option>
                          @endif
                       
                        @foreach($catagory as $cata)
                          @if($cata->parent_id == 0)
                            <option value="{{$cata->id}}">{{$cata->name}}</option>
                          @endif
                        @endforeach
                        
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="message-text" class="col-form-label">Sections</label>
                       <select name="cat_section" id="add_cata_section_id" class="form-control" required>
                          <option value="{{$sections[$edit_catagory->section_id-1]->id}}">{{$sections[$edit_catagory->section_id-1]->name}}</option>
                          @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                          @endforeach
                       </select>
                    </div>
                  
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Catagory Image</label>
                    <div class="custom-file">
                        <input type="file" name="cat_image" value="{{$edit_catagory->image}}" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                  </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Catagory Discount</label>
                      <input type="text" name="cat_discount" value="{{$edit_catagory->cata_discount}}" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Catagory URL</label>
                       <input type="text" name="cat_url" value="{{$edit_catagory->url}}" class="form-control" id="recipient-name" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Title</label>
                    <input type="text" name="cat_meta_title" value="{{$edit_catagory->meta_title}}" class="form-control" id="recipient-name" required>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Keywords</label>
                    <input type="text" name="cat_meta_keyword" value="{{$edit_catagory->meta_keywords}}" class="form-control" id="recipient-name" required>
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Catagory Description</label>
                   <textarea class="form-control" name="cat_desc" id="message-text">{{$edit_catagory->cata_desc}}</textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Meta Description</label>
                    <textarea class="form-control" name="cat_meta_desc" id="message-text">{{$edit_catagory->meta_desc}}</textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="submit" class="col-md-2 btn btn-primary m-auto float-right" value="Update Record">
                  </div>
                </div>
              </div>
         
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