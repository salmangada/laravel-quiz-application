@extends('layouts.student')
@section('title','Exams')
@section('content')
<style type="text/css">
    .question_options>li{
        list-style: none;
        height: 40px;
        line-height: 40px;
    }
</style>
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
                   
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card mt-4">
                
                <div class="card-body">

                  <form action="#" class="container">
                    
                   <div class="row container">

                        @foreach ($question as $key=>$q)
                            <div class="col-sm-12 mt-4">
                              <p>{{$key+1}}. {{ $q['questions']}}</p>
                              <?php 
                                    $options = json_decode(json_decode(json_encode($q['options'])),true);
                              ?>
                              <input type="hidden" name="question{{$key+1}}" value="{{$q['id']}}">
                              <ul class="question_options">
                                  <li><input type="radio" <?php if($options['option1']==$q['ans']){echo 'checked';} else{echo 'disabled';}?> >  {{ $options['option1']}}</li>
                                  <li><input type="radio" <?php if($options['option2']==$q['ans']){echo 'checked';} else{echo 'disabled';}?> >  {{ $options['option2']}}</li>
                                  <li><input type="radio" <?php if($options['option3']==$q['ans']){echo 'checked';} else{echo 'disabled';}?> >  {{ $options['option3']}}</li>
                                  <li><input type="radio" <?php if($options['option4']==$q['ans']){echo 'checked';} else{echo 'disabled';}?> >  {{ $options['option4']}}</li>

                                  
                              </ul>
                            </div>
                        @endforeach
                        
                   </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-header -->

    <!-- Modal -->


 
@endsection
