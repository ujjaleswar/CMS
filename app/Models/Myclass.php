<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Myclass extends Model
{
    protected $fillable = [
        'class',
    ];

    public function students(){
        return $this->hasMany(Students::class,'id');
    }
}
