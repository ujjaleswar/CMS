<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Schedule extends Model
{
     use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject',
        'class_name',
        'day',
        'date',
        'start_time',
        'end_time',
    ];

    // Relationship to teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    // Schedule.php

public function subjectdtl()
{
    return $this->belongsTo(Subject::class, 'subject', 'id');
    
}

// app/Models/Schedule.php

public function subjectlist()
{
    return $this->belongsTo(Subject::class, 'id');
}

}
