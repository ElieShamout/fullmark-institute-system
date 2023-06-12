<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subjects;

class Teachers extends Model
{
    use HasFactory;

    protected $table='teachers';


    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'sex',
        'nationality',
        'phone',
        'whatsapp',
        'email',
        'address',
    ];

    public function subjects(){
        $this->hasMany(Subjects::class,'techer_id');
    }
}
