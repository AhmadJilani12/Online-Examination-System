<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =[
        'answer',
        'is_correct',
        'question_id',
        
        ];
}
