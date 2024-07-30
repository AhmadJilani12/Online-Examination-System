<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    use HasFactory;
    public $timestamps = true;
protected $fillable =[

    'exam_name',
    'time',
    'subject_id',
    'date',
    'attempt'
    
];

public function subjects(){


    return $this->belongsTo(Subject::class,'subject_id');

    
}







}
