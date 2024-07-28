<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function AddSubject(Request $request){

        try {

            Subject::insert([
                'subject' => $request->subject
            ]);
            return response()->json(['success'=>true, 'msg'=>'subject added successfully']);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
        }

    }
}
