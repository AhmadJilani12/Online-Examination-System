<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamAttempt;
class exam extends Model
{
    use HasFactory;
    public $timestamps = true;
protected $fillable =[

    'exam_name',
    'time',
    'subject_id',
    'date',
    'attempt',
    'entrance_id'
    
];

protected $appends = ['attempt_counter'];
public $count = '';



public function getQnaExam(){

    return $this->hasMany(QnaExam::class,'exam_id');

}





public function subjects(){

    return $this->belongsTo(Subject::class,'subject_id');

}

public function getIdAttribute($value)
{
  $attempt_count =  ExamAttempt::where(['exam_id' => $value, 'user_id'=> auth()->user()->id])->count();
$this->count =$attempt_count;

return $value;
}

public function getAttemptCounterAttribute()
{
    return $this->count;
}



}
