@extends('layouts.app')
@section('title','Add Questions')
@section('content')

    <!-- /.content-header -->
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add questions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add questions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Title</h3>
  
                  <div class="card-tools">
                        <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal" data-target="#myModal">Add new</a>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>ans</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($questions as $key=>$question)
                              <tr>
                                  <td>{{ $key+1}}</td>
                                  <td>{{ $question['questions']}}</td>
                                  <td>{{ $question['ans']}}</td>
                                  <td><input class="question_status" data-id="{{ $question['id']}}" <?php if($question['status']==1){ echo "checked";} ?> type="checkbox" name="status"></td>
                                  <td>
                                      <a href="{{ url('admin/update_question/'. $question['id'])}}" class="btn btn-primary btn-sm">Update</a>
                                      <a href="{{ url('admin/delete_question/'. $question['id'])}}" class="btn btn-danger btn-sm">Delete</a>
                                  </td>
                              </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>ans</th>
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
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-header -->

    <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add new Question</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/admin/add_new_question')}}" class="database_operation">  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter Question</label>
                            {{ csrf_field()}}
                            <input type="hidden" name="exam_id" value="{{ Request::segment(3)}}">
                            <input type="text" required="required" name="question" placeholder="Enter Question" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option 1</label>
                            <input type="text" required="required" name="option_1" placeholder="Enter Question" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option 2</label>
                            <input type="text" required="required" name="option_2" placeholder="Enter Option 2" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option 3</label>
                            <input type="text" required="required" name="option_3" placeholder="Enter  Option 3" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option 4</label>
                            <input type="text" required="required" name="option_4" placeholder="Enter  Option 4" class="form-control">
                        </div>
                    </div>
                    {{-- <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter correct ans</label>
                            <input type="text" required="required" name="ans" placeholder="Enter  correct ans" class="form-control">
                        </div>
                    </div> --}}
                    <div class="form-group">
                      <label for="">Select correct option</label>
                      <select class="form-control" required="required" name="ans">
                          <option value="">Select</option>
                        
                          <option value="option_1">option 1</option>
                          <option value="option_2">option 2</option>
                          <option value="option_3">option 3</option>
                          <option value="option_4">option 4</option>
          
                      </select>
                  </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </form>
      </div>
      
    </div>
    </div>	


 
@endsection
