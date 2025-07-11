<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
     use HasFactory;

    protected $fillable = [
        'student_id',
        'status',
        'date',
        'UserID'
    ];
    public function student()
{
    return $this->belongsTo(Students::class);
}
public function std()
{
    return $this->belongsTo(User::class, 'id');
}


}
