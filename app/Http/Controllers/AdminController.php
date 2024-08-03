<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\exam;
use Illuminate\Http\Request;

use App\Models\Question;
use App\Models\Answer;

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
    
}


