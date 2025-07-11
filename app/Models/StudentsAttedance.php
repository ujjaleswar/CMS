<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsAttedance extends Model
{
    protected $fillable = [
        'class_id',
        'teacher_id',
        'date',
        'subject_id',
        'attendance',
    ];
}
