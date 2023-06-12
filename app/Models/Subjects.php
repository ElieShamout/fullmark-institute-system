<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teachers;

class Subjects extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'name',
    ];

    public function teachers(){
        return $this->belongsToMany(Teachers::class,'teacher_subjects','teacher_id','subject_id');
    }
}
