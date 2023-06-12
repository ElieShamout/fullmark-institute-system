<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function statistics_view(){
        return view('admin.statistics-view');
    }
}
