<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Teacher extends Model
{
     protected $fillable = [
        'name',
        'email',
        'phone',
         'preferred_sub',
    ];
public function subjects()
{
    return $this->belongsToMany(Subject::class);
}
public function schedules()
{
    return $this->hasMany(Schedule::class);
}

}
