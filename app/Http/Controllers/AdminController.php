<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oex_category;
use App\Models\Oex_exam_master;
use App\Models\Oex_student;
use App\Models\Oex_portal;
use App\Models\User;
use App\Models\Oex_question_master;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\user_exam;
use App\Models\Admin;
use App\Models\Oex_result;

class AdminController extends Controller
{
    // admin dashboard
    public function index(){

        $user_count = User::get()->count();
        $exam_count = Oex_exam_master::get()->count();
        $admin_count = Admin::get()->count();
        return view('admin.dashboard',['student'=>$user_count,'exam'=>$exam_count,'admin'=>$admin_count]);
    }


    //Exam categories
    public function exam_category(){

        $data['category']=Oex_category::get()->toArray();
        return view('admin.exam_category',$data);
    }


    //Adding new exam categories
    public function add_new_category(Request $request){
            
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
        ]);

        if($validator->fails()){
            $arr=array('status'=>'false','message'=>$validator->errors()->all());
        }
        else{
            
            $cat = new Oex_category();
            $cat->name = $request->name;
            $cat->status = 1;
            $cat->save();
            $arr=array('status'=>'true','message'=>'Success','reload'=>url('admin/exam_category'));
        }
        echo json_encode($arr);
    }





    //Deleting the categories
    public function delete_category($id){

        $cat = Oex_category::where('id',$id)->get()->first();
        $cat->delete();
        return redirect(url('admin/exam_category'));
    }


    //Editing the categories
    public function edit_category($id){
        $category = Oex_category::where('id',$id)->get()->first();
        return view('admin.edit_category',['category'=>$category]);
    }


    //Editing the categories
    public function edit_new_category(Request $request){
        $cat = Oex_category::where('id',$request->id)->get()->first();
        $cat->name = $request->name;
        $cat->update();
        echo json_encode(array('status'=>'true','message'=>'updated successfully','reload'=>url('admin/exam_category')));
    }



    //Editing categories status
    public function category_status($id){
        $cat = Oex_category::where('id',$id)->get()->first();

        if($cat->status==1)
            $status=0;
        else
            $status=1;
        
        $cat1 = Oex_category::where('id',$id)->get()->first();
        $cat1->status=$status;
        $cat1->update();
    }




    //Manage exam page
    public function manage_exam(){
        $data['category']=Oex_category::where('status','1')->get()->toArray();
        $data['exams']=Oex_exam_master::select(['oex_exam_masters.*','oex_categories.name as cat_name'])->join('oex_categories','oex_exam_masters.category','=','oex_categories.id')->get()->toArray();
        return view('admin.manage_exam',$data);
    }



    //Adding new exam page
    public function add_new_exam(Request $request){
            $validator = Validator::make($request->all(),['title'=>'required','exam_date'=>'required','exam_category'=>'required',
            'exam_duration'=>'required']);

            if($validator->fails()){
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            else{
                
                $exam = new Oex_exam_master();
                $exam->title = $request->title;
                $exam->exam_date = $request->exam_date;
                $exam->exam_duration = $request->exam_duration;
                $exam->category = $request->exam_category;
                $exam->status = 1;
                $exam->save();

                $arr = array('status'=>'true','message'=>'exam added successfully','reload'=>url('admin/manage_exam'));

            }

            echo json_encode($arr);
    }



    //editing exam status
    public function exam_status($id){

        $exam = Oex_exam_master::where('id',$id)->get()->first();

        if($exam->status==1)
            $status=0;
        else
            $status=1;
        
        $exam1 = Oex_exam_master::where('id',$id)->get()->first();
        $exam1->status=$status;
        $exam1->update();
    }



    //Deleting exam status
    public function delete_exam($id){
        $exam1 = Oex_exam_master::where('id',$id)->get()->first();
        $exam1->delete();
        return redirect(url('admin/manage_exam'));
    }



    //Edit Exam
    public function edit_exam($id){
        $data['category']=Oex_category::where('status','1')->get()->toArray();
        $data['exam'] = Oex_exam_master::where('id',$id)->get()->first();

        return view('admin.edit_exam',$data);
    }


    //Editing Exam
    public function edit_exam_sub(Request $request){

        $exam = Oex_exam_master::where('id',$request->id)->get()->first();
        $exam->title = $request->title;
        $exam->exam_date = $request->exam_date;
        $exam->category = $request->exam_category;
        $exam->exam_duration = $request->exam_duration;

        $exam->update();

        echo json_encode(array('status'=>'true','message'=>'Successfully updated','reload'=>url('admin/manage_exam')));

    }



    //Manage students
    public function manage_students(){

        $data['exams']=Oex_exam_master::where('status','1')->get()->toArray();
        $data['students'] = user_exam::select(['user_exams.*','users.name','oex_exam_masters.title as ex_name','oex_exam_masters.exam_date'])
            ->join('users','users.id','=','user_exams.user_id')
            ->join('oex_exam_masters','user_exams.exam_id','=','oex_exam_masters.id')->orderBy('user_exams.exam_id','desc')
            ->get()->toArray();
        return view('admin.manage_students',$data);
    }



    //Add new students
    public function add_new_students(Request $request){

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'mobile_no'=>'required',
            'exam'=>'required',
            'password'=>'required'

        ]);

        if($validator->fails()){
            $arr=array('status'=>'false','message'=>$validator->errors()->all());
        }
        else{
            $std = new User();
            $std->name = $request->name;
            $std->email = $request->email;
            $std->mobile_no = $request->mobile_no;
            $std->exam = $request->exam;
            $std->password = Hash::make($request->password);

            $std->status=1;

            $std->save();

            $arr = array('status'=>'true','message'=>'student added successfully','reload'=>url('admin/manage_students'));
        }

        echo json_encode($arr);
    }



    //Editing student status
    public function student_status($id){
        $std = user_exam::where('id',$id)->get()->first();

        if($std->std_status==1)
            $status=0;
        else
            $status=1;
        
        $std1 = user_exam::where('id',$id)->get()->first();
        $std1->std_status=$status;
        $std1->update();
    }


    //Deleting students
    public function delete_students($id){

        $std = user_exam::where('id',$id)->get()->first();
        $std->delete();
        return redirect('admin/manage_students');
    }



    //Editing students
    public function edit_students_final(Request $request){

        $std = User::where('id',$request->id)->get()->first();
        $std->name = $request->name;
        $std->email = $request->email;
        $std->mobile_no = $request->mobile_no;
        $std->exam = $request->exam;
        if($request->password!='')
            $std->password = $request->password;

        $std->update();
        echo json_encode(array('status'=>'true','message'=>'Successfully updated','reload'=>url('admin/manage_students')));
    }




    //Registered student page
    public function registered_students(){

        $data['users'] = User::get()->all();


        return view('admin.registered_students',$data);
    }


    //Deleting students egistered
    public function delete_registered_students($id){

        $std = User::where('id',$id)->get()->first();
        $std->delete();
        return redirect('admin/registered_students');
        
    }

    


    //addning questions
    public function add_questions($id){

        $data['questions']=Oex_question_master::where('exam_id',$id)->get()->toArray();
        return view('admin.add_questions',$data);
    }


    //adding new questions
    public function add_new_question(Request $request){

        $validator = Validator::make($request->all(),[
            'question'=>'required',
            'option_1'=>'required',
            'option_2'=>'required',
            'option_3'=>'required',
            'option_4'=>'required',
            'ans'=>'required'
        ]);

        if($validator->fails()){
            $arr = array('status'=>'flase','message'=>$validator->errors()->all());

        }else{
           
            $q = new Oex_question_master();
            $q->exam_id=$request->exam_id;
            $q->questions=$request->question;

            if($request->ans=='option_1'){
                $q->ans=$request->option_1;
            }elseif($request->ans=='option_2'){
                $q->ans=$request->option_2;
            }elseif($request->ans=='option_3'){
                $q->ans=$request->option_3;
            }else{
                $q->ans=$request->option_4;
            }
            


            $q->status=1;
            $q->options=json_encode(array('option1'=>$request->option_1,'option2'=>$request->option_2,'option3'=>$request->option_3,'option4'=>$request->option_4));

            $q->save();

            $arr = array('status'=>'true','message'=>'successfully added','reload'=>url('admin/add_questions/'.$request->exam_id));
        }

        echo json_encode($arr);
    }



    //Edit question status
    public function question_status($id){
        $p = Oex_question_master::where('id',$id)->get()->first();

        if($p->status==1)
            $status=0;
        else
            $status=1;
        
        $p1 = Oex_question_master::where('id',$id)->get()->first();
        $p1->status=$status;
        $p1->update();
    }


    //Delete questions
    public function delete_question($id){

        $q=Oex_question_master::where('id',$id)->get()->first();
        $exam_id = $q->exam_id;
        $q->delete();

        return redirect(url('admin/add_questions/'.$exam_id));
    }



    //update questions
    public function update_question($id){

        $data['q']=Oex_question_master::where('id',$id)->get()->toArray();

        return view('admin.update_question',$data);
    }


    //Edit question
    public function edit_question_inner(Request $request){

        $q=Oex_question_master::where('id',$request->id)->get()->first();

        $q->questions = $request->question;

        if($request->ans=='option_1'){
            $q->ans=$request->option_1;
        }elseif($request->ans=='option_2'){
            $q->ans=$request->option_2;
        }elseif($request->ans=='option_3'){
            $q->ans=$request->option_3;
        }else{
            $q->ans=$request->option_4;
        }

        $q->options = json_encode(array('option1'=>$request->option_1,'option2'=>$request->option_2,'option3'=>$request->option_3,'option4'=>$request->option_4));
        
        $q->update();

        echo json_encode(array('status'=>'true','message'=>'successfully updated','reload'=>url('admin/add_questions/'.$q->exam_id)));

    }


    public function admin_view_result($id){
        
        $std_exam = user_exam::where('id',$id)->get()->first();
        
        $data['student_info'] = User::where('id',$std_exam->user_id)->get()->first();

        $data['exam_info'] = Oex_exam_master::where('id',$std_exam->exam_id)->get()->first();

        $data['result_info'] = Oex_result::where('exam_id',$std_exam->exam_id)->where('user_id',$std_exam->user_id)->get()->first();

        return view('admin.admin_view_result',$data);


    }
}
