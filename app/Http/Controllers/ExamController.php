<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exam;
use App\Models\QnaExam;


class ExamController extends Controller
{
    

    public function loadExamDashboard($id)
    {
 $qnaExam =    Exam::where('entrance_id', $id)->get();

    if(count($qnaExam) > 0){

    
    }
    else{

        return view('404');
    }

    }

}
