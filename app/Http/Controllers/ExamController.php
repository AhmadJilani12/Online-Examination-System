<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exam;
use App\Models\QnaExam;
use App\Models\ExamAttempt;

use App\Models\ExamAnswer;
use Illuminate\Support\Facades\Auth;


class ExamController extends Controller
{
    

    public function loadExamDashboard($id)
    {
 $qnaExam =    Exam::where('entrance_id', $id)->with('getQnaExam')->get();
    if(count($qnaExam) > 0){
        $attempt_count =  ExamAttempt::where(['exam_id' => $qnaExam[0]['id'], 'user_id'=> auth()->user()->id])->count();
 if($attempt_count >= $qnaExam[0]['attempt'] )
 {
    return view('Student.exam-dashboard',['success'=>false,'msg'=>'Your Exam attemption has been completed', 'exam'=> $qnaExam]);    
 }

      else  if(date('Y-m-d') == $qnaExam[0]['date'] ){

            if(count($qnaExam[0]['getQnaExam'] )>0 )
            {
        $qna =  QnaExam::where('exam_id',$qnaExam[0]['id'])->with('questions','answers')->get();

        return view('Student.exam-dashboard',['success'=>true, 'exam'=> $qnaExam, 'qna'=>$qna]);

            }
            else{
                return view('Student.exam-dashboard',['success'=>false,'msg'=>'This exam is not Available for now! ', 'exam'=> $qnaExam]);
            }

}
else if(date('Y-m-d') < $qnaExam[0]['date'] )
{
    return view('Student.exam-dashboard',['success'=>false,'msg'=>'This exam will be start on '.$qnaExam[0]['date'], 'exam'=> $qnaExam]);
}
else{
    return view('Student.exam-dashboard',['success'=>false,'msg'=>'This exam has been expired on '.$qnaExam[0]['date'], 'exam'=> $qnaExam]);
}
    }
    else{

        return view('404');
    }

    }




    public function examSubmit(Request $request)
    {
  $attempt_id = ExamAttempt::insertGetId([
    'exam_id'=>$request->exam_id,
    'user_id'=>Auth::user()->id,


   ]);

   $qcount =count($request->q);

   if($qcount > 0)
   { 

    for($i =0; $i< $qcount ; $i++)
    {

        if(!empty($request->input('ans_'.($i+1))))
        {
            ExamAnswer::insert([
                'attempt_id'=>$attempt_id,
                'question_id' =>$request->q[$i],
                'answer_id'=> request()->input('ans_'.($i+1))
              
              
              
                ]);
        }
  

    }

   }

   return view("Thankyou");
 
    }

    public function ResultDashboard()
    {

      $attempt =  ExamAttempt::where('user_id', Auth()->user()->id)->with('exam')->orderBy('updated_at')->get();


      return view('Student.result',compact('attempt'));

    }

    public function reviewStudentQna(Request $request)
    {

        try {
         
         $attemptData =   ExamAnswer::where('attempt_id',$request->attempt_id)->with(['question','answer'])->get();




         return response()->json(['success' => true, 'data' =>$attemptData , 'msg' =>'Q&A Data' ]);
        } catch (\Exception $e) {
        
 return response()->json(['success' => false, 'msg' => $e->getMessage() ]);
        }

   

    }

}
