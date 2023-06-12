<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherLanguages extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'teacher_id',
        'language_id',
    ];
}
