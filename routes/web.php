<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'studentRegister'])->name('studentRegister');


Route::get('/login',function(){

    return redirect('/');
});
Route::get('/',[AuthController::class ,'loadLogin']);

Route::post('/login',[AuthController::class ,'userLogin'])->name('userLogin')->middleware('web');



Route::group(['middleware'=>['web','checkAdmin']],function(){

    Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);

    //subject route

    Route::post('/add-subject',[AdminController::class,'AddSubject'])->name('AddSubject');
     Route::post('/edit-subject',[AdminController::class,'editSubject'])->name('editSubject');
     Route::post('/delete-subject',[AdminController::class,'deleteSubject'])->name('deleteSubject');
     Route::get('/admin/exam',[AdminController::class,'examDashboard']);
     Route::post('/add-exam',[AdminController::class,'addExam'])->name('addExam');
     Route::get('/get-exam-detail/{id}',[AdminController::class,'getExamDetail'])->name('getExamDetail');
     Route::post('/update-exam',[AdminController::class,'updateExam'])->name('updateExam');
     Route::post('/delete-exam',[AdminController::class,'deleteExam'])->name('deleteExam');

     //Q & A Route
     Route::get('/admin/qna-ans',[AdminController::class,'qnaDashboard']);
     Route::post('/add-qna-ans',[AdminController::class,'addQna'])->name('addQna');
     
     Route::get('/get-qna-details',[AdminController::class,'getQnaDetails'])->name('getQnaDetails');
     

     Route::get('/delete-ans',[AdminController::class,'deleteAns'])->name('deleteAns');

     

     Route::post('/admin-updateQNA',[AdminController::class,'updateQNA'])->name('updateQNA');
     Route::post('/admin-deleteQNA',[AdminController::class,'deleteQNA'])->name('deleteQNA');
     Route::post('/admin-importQNA',[AdminController::class,'importQNA'])->name('importQNA');
       //Student Routing
     Route::get('/admin/student',[AdminController::class,'studentDashboard'])->name('studentDashboard');
     Route::post('/add-Student',[AdminController::class,'addStudent'])->name('addStudent');
     Route::post('/edit-Student',[AdminController::class,'editStudent'])->name('editStudent');
     Route::post('/delete-Student',[AdminController::class,'delteStudent'])->name('deleteStudent');

     // qna exam routing
     Route::get('/get-questions',[AdminController::class,'getQuestions'])->name('getQuestions');
     Route::post('/add-questions',[AdminController::class,'addquestions'])->name('addquestions');


});

Route::group(['middleware'=>['web','checkStudent']],function(){


    Route::get('/dashboard',[AuthController::class,'loadDashboard']);
});

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/forget-password',[AuthController::class,'forgetPasswordLoad']);


Route::post('/forget-password',[AuthController::class,'forgetPassword'])->name('forgetPassword');
Route::get('/reset-password',[AuthController::class,'resetPasswordLoad']);
Route::post('/reset-password',[AuthController::class,'resetPassword'])->name('resetPassword');







