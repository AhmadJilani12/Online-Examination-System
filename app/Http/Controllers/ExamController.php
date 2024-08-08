<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exam;
use App\Models\QnaExam;


class ExamController extends Controller
{
    

    public function loadExamDashboard($id)
    {
 $qnaExam =    Exam::where('entrance_id', $id)->with('getQnaExam')->get();
    if(count($qnaExam) > 0){

        if(date('Y-m-d') == $qnaExam[0]['date'] ){

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

}
