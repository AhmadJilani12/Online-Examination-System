<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

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
}
