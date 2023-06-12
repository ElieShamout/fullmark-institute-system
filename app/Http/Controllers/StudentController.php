<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function students_view(){
        $students=Students::get();
        $specializations=Students::where('specialization','!=','Null')->select('specialization')->distinct()->get();
        return view('admin.students-view',compact('students','specializations'));
    }

    public function new_student(Request $request){
        $stu=new Students();
        $stu->full_name=$request->name;
        $stu->address=$request->address;
        $stu->near=$request->near;
        $stu->phone=$request->phone;
        $stu->class=$request->stu_class;
        $stu->specialization=$request->specialize;
        $stu->save();

        if ($stu){
            return $stu->id;
        }
    }

    public function update_student(Request $request){
        $stu=DB::table('students')->where('id',$request->id)->update([
            'full_name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'class' => $request->stu_class,
            'specialization' => $request->specialize,
        ]);

        if ($stu){
            return 'success';
        }
    }

    public function get_all_students_api(Request $request)
    {
        $teachers = Students::get();

        return $teachers;
    }

    public function filter_name(Request $request)
    {
        $teachers = Students::where('full_name', 'LIKE', $request->full_name . "%")->get();
        return $teachers;
    }

    public function filter_address(Request $request)
    {

        $teachers = Students::where('address', 'LIKE', ($request->address ?? '') . "%")->get();
        return $teachers;
    }

    public function filter_class(Request $request)
    {
        if ($request->class != "all") {
            $students = Students::where('class', '=', $request->class)->get();
        } else {
            $students = Students::get();
        }
        return $students;
    }

    public function filter_specialization(Request $request)
    {
        if ($request->specialization != "all") {
            $students = Students::where('specialization', '=', ($request->specialization ?? ''))->get();
        } else {
            $students = Students::get();
        }
        return $students;
    }

    public function delete_student(Request $request){
        $student=Students::find($request->student_id)->delete();
        return true;
    }
}
