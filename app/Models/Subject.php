<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subjectname',
        'subjectcode',
        'description',
    ];
    public function schedules()
{
    return $this->hasMany(Schedule::class, 'id');
}

}
