@extends('layouts.admin.app')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add and View Sections</h1>
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
                      <!-- //////// -->

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Add Section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Status</label>
                        <select name="status" class="form-control">
                          <option value="1">On</option>
                          <option value="0">Off</option>
                        </select>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- //////// -->
        
         <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Catagory</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg" data-whatever="@mdo">Add New Product</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>Name</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($sections as $section)
                      <tr>
                        <td>{{$section->id}}</td>
                        <td>{{$section->name}}</td>
                        <td>
                          <input type="checkbox" class="admin-section-status"  data-id="{{$section->id}}" data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-warning" {{$section->status == 1? 'checked':''}}>
                        </td>
                      </tr>
                    @endforeach        
                  </tbody>
                </table>
              </div>
            
            </div>
            <!-- /.card -->

           
          </div>
          <!-- /.col -->
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection