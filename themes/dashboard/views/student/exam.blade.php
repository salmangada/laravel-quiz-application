@extends('layouts.student')
@section('title','Exams')
@section('content')

    <!-- /.content-header -->
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Exams</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Exam</li>
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
                
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Exam title</th>
                                <th>Exam date</th>
                                <th>Status</th>
                                <th>Result</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($student_info as $std_info)
                              
                          
                            <tr>
                              <td>1</td>
                              <td>{{ $std_info['title']}}</td>
                              <td>{{ $std_info['exam_date']}}</td>
                              <td><?php 
                                if(strtotime($std_info['exam_date']) < strtotime(date('Y-m-d'))){
                                  echo "Date expired";
                                }elseif (strtotime($std_info['exam_date']) == strtotime(date('Y-m-d'))) {
                                      if($std_info['exam_joined']==1){
                                        echo "Finished";
                                      }else{
                                        echo "Running";
                                      }
                                  
                                }else{
                                  echo "Pending";
                                }
                              ?></td>
                              <td>
                                <?php
                                    if($std_info['exam_joined']==1){
                                ?>      
                                      <a href="{{ url('student/view_result/'.$std_info['exam_id'])}}" class="btn btn-info btn-sm">View Result</a>
                                <?php      
                                    }
                                ?>
                              </td>

                             
                              <td>
                                  <?php 
                                  if(strtotime($std_info['exam_date']) == strtotime(date('Y-m-d'))){
                                    if($std_info['exam_joined']==0){

                                  ?>
                                    <a href="{{ url('student/join_exam/'.$std_info['exam_id'])}}" class="btn btn-primary btn-sm">Join Exam</a>
                                  
                                  <?php
                                      } else{
                                  ?>      
                                        <a href="{{ url('student/view_answer/'.$std_info['exam_id'])}}" class="btn btn-primary btn-sm">View Answers</a>

                                  
                                  <?php     
                                      }
                                    
                                    
                                    
                                    }
                                  ?>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            
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


 
@endsection
