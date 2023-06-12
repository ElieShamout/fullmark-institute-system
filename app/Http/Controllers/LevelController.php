<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function levels_view(){
        return view('admin.levels-view');
    }
}
