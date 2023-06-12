<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyLesson extends Model
{
    use HasFactory;

    protected $fillable=['lesson_id','status'];
}
