<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use App\Models\User;
use App\Models\QnaExam;
use App\Models\exam;
use Illuminate\Http\Request;

use App\Models\Question;
use App\Models\Answer;
use Carbon\Carbon;
use App\Imports\QnaImport;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{
    //

    public function AddSubject(Request $request)
    {

        try {

            Subject::insert([
                'subject' => $request->subject
            ]);
            return response()->json(['success' => true, 'msg' => 'subject added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function editSubject(Request $request)
    {



        try {
            $subject = Subject::find($request->id);

            $subject->subject = $request->subject;

            $subject->save();



            return response()->json(['success' => true, 'msg' => 'subject updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }







    public function deleteSubject(Request $request)
    {



        try {
            Subject::Where('id', $request->id)->delete();


            return response()->json(['success' => true, 'msg' => 'subject deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }



//exam Dashboard load

public function examDashboard()
{


    
$subject=Subject::with('exams')->get();


$subjects=Subject::all();
$exam=exam::with('subjects')->get();

    return view('admin.edashboard',['subjects'=>$subjects,'exam'=>$exam,'subject'=>$subject]);
}

//Add Exam

public function addExam(Request $request)
{

    
    try {


$validatedData = $request->validate([
            'hours' => 'required|integer|min:0',
            'minutes' => 'required|integer|min:0|max:59',
            
        ]);
        $duration = sprintf("%02d:%02d", $validatedData['hours'], $validatedData['minutes']);
        // $duration = ($validatedData['hours'] * 60) + $validatedData['minutes'];

        exam::create(array(
            'exam_name'=> $request->exam_name,
            'time'=>$duration,
            'subject_id' =>$request->subject_id,
        'date'=>$request->date,
        'attempt'=>$request->attempt
        ));




        return response()->json(['success' => true, 'msg' => 'Exam Added successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    }

}


public function getExamDetail($id)
{
    try {


        
     $exam = Exam::Where('id', $id)->get();

        
                return response()->json(['success' => true, 'data'=>$exam]);
                
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        

}




public function updateExam(Request $request)
{
    try {

        $validatedData = $request->validate([
            'hours' => 'required|integer|min:0',
            'minutes' => 'required|integer|min:0|max:59',
            
        ]);
        $duration = sprintf("%02d:%02d", $validatedData['hours'], $validatedData['minutes']);
        
        $exam = Exam::find($request->exam_id);

        $exam->exam_name=$request->exam_name;
        $exam->date=$request->date;
        $exam->subject_id=$request->subject_id;
        $exam->time=$duration;
        $exam->attempt=$request->attempt;

        $exam->save();

                   return response()->json(['success' => true, 'msg' => 'Exam updated successfully']);
                   
               } catch (\Exception $e) {
                   return response()->json(['success' => false, 'msg' => $e->getMessage()]);
               }

}







public function deleteExam(Request $request)
{



    try {


        
 Exam::Where('id',$request->delete_exam_id)->delete();
   
           
                   return response()->json(['success' => true, 'msg' =>'Exam deleted successfully']);
                   
               } catch (\Exception $e) {
                   return response()->json(['success' => false, 'msg' => $e->getMessage()]);
               }

}

public function qnaDashboard(){

    $question = Question::with('answer')->get();
    $questionJson = json_encode($question);
    
    return view('admin.qnaDashboard', compact('question', 'questionJson'));


}


public function addQna(Request $request){


    try {


     $qid=   Question::insertGetId(
            [
                'question'=> $request->Question
            ]
        );


       foreach ($request->answers as $answer) {
        
        $is_correct=0;

        if($request->is_correct == $answer)
        {
            $is_correct=1;

        }


        Answer::insert([

            'question_id' => $qid,
            'answer' => $answer,
            'is_correct' => $is_correct


        ]);
       }

          
                          return response()->json(['success' => true, 'msg' =>'Exam deleted successfully']);
                          
                      } catch (\Exception $e) {
                          return response()->json(['success' => false, 'message' => $e->getMessage()]);
                      }
    
    }
    




  public function  getQnaDetails (Request $request)
  {
   $qna= Question:: Where('id',$request->qid)->with('answer')->get();

    return response()->json(['data' => $qna]);



  }

public function deleteAns(Request $request)
{


    try {
        
Answer::where('id',$request->id)->delete();

return response()->json(['success'=>true, 'msg'=>'Answer deleted successfully']);

    } catch (\Exception $e) {
      

        
return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
    }



}

public function updateQNA(Request $request)
{


    try {
        
        Question::where('id',$request->question_id)->update([

            'question'=>$request->Question,

        ]);

     
  //old answerhandling
  if(isset($request->answers))
  {

    foreach ($request->answers as $id =>  $answer) {
   
      
$is_correct=0;

if($request->is_correct == $answer){


$is_correct=1;
}
$updated_at = Carbon::now()->toDateTimeString();

   
$ans = Answer::where('id', $id)->firstOrFail();
$ans->answer = $answer;
$ans->is_correct = $is_correct;
$ans->updated_at = now(); // Or any desired datetime
$ans->save();

    }

  }

  //new answer handling 

  if(isset($request->new_answers))
  {

    foreach ($request->new_answers as   $answer) {
   
      
$is_correct=0;

if($request->is_correct == $answer){


$is_correct=1;
}


     Answer::insert([
      'question_id'=>$request->question_id,
      'answer'=>$answer,
      'is_correct'=>$is_correct

     ]);
    }

  }





    return response()->json(['success'=>true, 'msg'=>'Question and Answers updated successfully']);


    } catch (\Exception $e) {
      

        
return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
    }



}




public function deleteQNA(Request $request)
{

    try

{

    Question::where('id', $request->deleteQna_id)->delete();
    Answer::where('question_id',$request->deleteQna_id)->delete();

    return response()->json(['success'=>true, 'msg'=>'Question and Answers deleted successfully']);


} catch (\Exception $e) {
  

    
return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
}



}



public function importQNA(Request $request)
{

    try

    {

        if (!in_array($request->file('file')->getClientOriginalExtension(), ['xlsx', 'xls','csv'])) {
            return response()->json(['success' => false, 'msg' => 'Invalid file format. Please upload an Excel file.']);
        }


    

    Excel::import(new QnaImport,$request->file('file'));

    return response()->json(['success' =>true, 'msg' => 'QNA imported successfully']);
    
    } catch (\Exception $e) {
      
    
        
    return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
    }
    

}


   //student Dashboard

  public function studentDashboard(Request $request)
  { 


    $student =User::where('is_admin',0)->get();

    return view('admin.studentdashboard',compact('student'));
  }

  public function addStudent(Request $request)
  { 


    try

    {
   $password = Str::random(8);

   User::insert([
    'name' =>$request->name,
    'email' =>$request->email,
    'password' =>Hash::make($password)


   ]);
       $url =URL::to('/');
       $data['url']=$url;
       $data['name']=$request->name;
       $data['email']=$request->email;
       $data['password']=$password;
       $data['title']="Student Registration on Online Examination System";

       Mail::send('RegistrationMail',['data'=>$data],function($message) use ($data)  
    {
        $message->to($data['email'])->subject($data['title']);

    }
    
    );

    return response()->json(['success' =>true, 'msg' => 'Student Added Successfully!!']);
    
    } catch (\Exception $e) {
      
    
        
    return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
    }
    
  }


 //update Student
  public function editStudent(Request $request)
  {
    try{
      $user = User::find($request->id);

      $user->name = $request->name;
      
      $user->email = $request->email;

      $user->save();


 
       $url =URL::to('/');
       $data['url']=$url;
       $data['name']=$request->name;
       $data['email']=$request->email;
       
       $data['title']="Updated Student Profile on Online Examination System ";

       Mail::send('updateProfileMail',['data'=>$data],function($message) use ($data)  
    {
        $message->to($data['email'])->subject($data['title']);

    }
    
    );

    return response()->json(['success' =>true, 'msg' => 'Student updated Successfully!!']);
    
    } catch (\Exception $e) {
      
    
        
    return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
    }

   
  }
       //delete student

  public function delteStudent(Request $request)
  {
          
    
 try{
     User::where('id',$request->id)->delete();

 return response()->json(['success' =>true, 'msg' => 'Student deleted Successfully!!']);
 
 } catch (\Exception $e) {
   
 
     
 return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
 }
  }

  public function getQuestions(Request $request)
  { 

   try {
    
    $questions =Question::all();
    
    if(count($questions) >0)
    {
      $data =[];

      $counter =0;

      foreach($questions as $question)
      {
      $qnaExam =  QnaExam::where(['exam_id' => $request->exam_id, 'question_id' => $question->id])->get();

        if(count($qnaExam) == 0)
        {

        $data[$counter]['id'] = $question->id;
        $data[$counter]['question'] = $question->question;

        $counter ++;


        }



      }


      return response()->json(['success'=>true, 'msg'=>'questions data', 'data'=>$data]);
    }
    else{

 return response()->json(['success'=>false, 'msg'=>'questions not found']);
    }
   } catch (\Exception $e) {
    
 return response()->json(['success'=>false, 'msg'=>'questions not found']);
   }


  }

  public function addquestions(Request $request)
  {
    try{

        if(isset($request->question_ids))
        {
            foreach ($request->question_ids as $qid) {
                  

                QnaExam::insert([
     'exam_id' => $request->exam_id,
     'question_id' =>$qid

                ]);
            }
        }

        return response()->json(['success'=>true, 'msg'=>'questions Added successfully !']);
           }
           catch (\Exception $e) {
           
        return response()->json(['success'=>false, 'msg'=>'questions not found']);
          }
  }


public function examquestions(Request $request)
{
    try{



       $data = QnaExam::where('exam_id',$request->exam_id)->with('questions')->get();
    return response()->json(['success'=>true, 'data' =>$data]);
}
catch (\Exception $e) {

return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
}


}



 public function deleteexamquestions(Request $request)
 {

    try{
  
        

       QnaExam::where('id',$request->id)->delete();
    
        return response()->json(['success'=>true,'msg'=>'Question deleted successfully']);
    }
    catch (\Exception $e)
    {
        return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
    }
 }

}







