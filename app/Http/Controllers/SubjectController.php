<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use App\Models\Teachers;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // public function teachers(Request $request){
    //     $subject_id=Subjects::select('id')->where('name','=',$request->subject)->get()->first();

    //     if (isset($subject_id->id)){
    //         $subject=Subjects::find($subject_id->id);
    //         return $subject->teachers;
    //     }
    // }

    public function subjects_view()
    {
        $subjects=Subjects::get();
        return view('admin.subjects-view',compact('subjects'));
    }

    public function filtring_teachers(Request $request){
        $techers=Teachers::where('address','LIKE','%'.$request->address.'%')->get();
    }
    
    public function add_subjects_api(Request $request){
        $subject=new Subjects;
        $subject->name=$request->subject_name;
        $subject->specialization=$request->specialization;
        $subject->save();

        if ($subject){
            return $subject;
        }
    }

    public function remove_subjects_api(Request $request){
        $subject=Subjects::find($request->subject_id)->delete();
        if ($subject){
            return true;
        }
    }

}
