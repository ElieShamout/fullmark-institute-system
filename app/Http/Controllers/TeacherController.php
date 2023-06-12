<?php

namespace App\Http\Controllers;

use App\Models\Lessons;
use App\Models\Subjects;
use App\Models\TeacherLevels;
use App\Models\Teachers;
use App\Models\TeacherSubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function teachers_view()
    {
        $datatime = time();

        $nationality = Teachers::select('nationality')->distinct()->get();

        return view('admin.techers-view', compact('datatime', 'nationality'));
    }

    public function teachers_map_view()
    {
        $datatime = time();
        return view('admin.techers-map-view', compact('datatime'));
    }

    public function get_all_teachers_api(Request $request)
    {
        $teachers = Teachers::get();

        return $teachers;
    }

    public function filter_name(Request $request)
    {


        $first_name = explode(' ', $request->full_name)[0] ?? '';
        $last_name = explode(' ', $request->full_name)[1] ?? '';

        $teachers = Teachers::where('first_name', 'LIKE', $first_name . "%")->where('last_name', 'LIKE', $last_name . "%")->get();

        return $teachers;
    }

    public function filter_address(Request $request)
    {

        $teachers = Teachers::where('address', 'LIKE', ($request->address ?? '') . "%")->get();

        return $teachers;
    }

    public function filter_sex(Request $request)
    {
        $teachers = Teachers::where('sex', '=', ($request->sex ?? ''))->get();
        return $teachers;
    }

    public function filter_nationality(Request $request)
    {
        if ($request->nationality != "all") {
            $techers = Teachers::where('nationality', '=', ($request->nationality ?? ''))->get();
        } else {
            $techers = Teachers::get();
        }
        return $techers;
    }


    public function filtring_teachers(Request $request)
    {


        // return [(date("Y-m-d H:i:s",strtotime($request->date))),$request->date];

        $teachers = DB::table('teachers')
            ->join('teacher_levels', function ($tlq) use ($request) {
                $tlq->on('teacher_levels.teacher_id', '=', 'teachers.id')
                    ->where('teacher_levels.level_id', '=', $request->stu_class);
            })
            ->join('teacher_subjects', function ($tsq) use ($request) {
                $tsq->on('teacher_subjects.teacher_id', '=', 'teachers.id')
                    ->where('teacher_subjects.subject_id', '=', $request->subject);
            })
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->distinct()
            ->select('teachers.id as teacher_id', 'teachers.first_name', 'teachers.last_name', 'subjects.name')->get();

        $result = [];
        foreach ($teachers as $teacher) {
            if ($this->check_date($teacher->teacher_id, $request->date, $request->lesson_number)) {
                array_push($result, $teacher);
            }
        }

        return $result;
    }

    static function check_date($teacher_id, $date, $number_of_lesson)
    {
        $lessons = Lessons::where('teacher_id', '=', $teacher_id)->get();
        $houre_end = date("Y-m-d H:i:s", (strtotime($date) + (($number_of_lesson>1) ? ($number_of_lesson * 3600) - 60 : 3600-60 )));

        foreach ($lessons as $lesson) {
            // end time for new lesson

            if (date("Y-m-d H:i:s", strtotime($lesson->date)) == date("Y-m-d H:i:s", strtotime($date))) {
                return false;
            } else if (
                // start lesson after end old lesson
                !(date("Y-m-d H:i:s", strtotime($date)) > date("Y-m-d H:i:s", (strtotime($lesson->date)+($lesson->number_of_lesson*3600)-60)) ||
                ($houre_end < date("Y-m-d H:i:s", strtotime($lesson->date))))
            ) {
                
                return false;
            }

        }
        return true;
    }

    public function delete_teacher(Request $request){
        $student=Teachers::find($request->teacher_id)->delete();
        return true;
    }
}



// SELECT * FROM `teachers` 
//     join teacher_levels on teacher_levels.teacher_id=teachers.id and teacher_levels.level_id=3 
//     join teacher_subjects on teacher_subjects.teacher_id=teachers.id and teacher_subjects.subject_id=1 
//     INNER JOIN lessons on lessons.teacher_id=teachers.id and lessons.date not BETWEEN '2022-10-04 09:00:00' and '2022-10-04 12:00:00';



// for new lesson calc end time
// $houre_end = date("Y-m-d H:i:s", strtotime($date) + ($number_of_lesson * 3600) - 60);






// $teachers = DB::table('teachers')
// ->join('teacher_levels', function($tlq) use ($request){
//     $tlq->on('teacher_levels.teacher_id', '=', 'teachers.id')
//         ->where('teacher_levels.level_id','=',$request->stu_class);
// })
// ->join('teacher_subjects', function($tsq) use ($request){
//     $tsq->on('teacher_subjects.teacher_id', '=', 'teachers.id')
//         ->where('teacher_subjects.subject_id','=',$request->subject);
// })
// ->rightJoin('lessons', function($leq) use ($request,$houre_end){
//     $leq->on('lessons.teacher_id', '=', 'teachers.id')
//     ->whereNotBetween('lessons.date',[date("Y-m-d H:i:s",strtotime($request->date)),$houre_end]);
// })
// ->join('subjects','subjects.id','=','teacher_subjects.subject_id')
// ->distinct()
// ->select('teachers.id as teacher_id','teachers.first_name','teachers.last_name','lessons.date as lesson_date','subjects.name')->get();



               // dd(
                //     date("Y-m-d H:i:s", strtotime($lesson->date)),
                //     date("Y-m-d H:i:s", strtotime($date)) ,
                //     date("Y-m-d H:i:s", strtotime($lesson->date)) != date("Y-m-d H:i:s", strtotime($date)),

                //     date("Y-m-d H:i:s", (strtotime($lesson->date) + ($lesson->number_of_lesson * 3600))),
                //     date("Y-m-d H:i:s", strtotime($date)),
                //     date("Y-m-d H:i:s", (strtotime($lesson->date) + ($lesson->number_of_lesson * 3600))) < date("Y-m-d H:i:s", strtotime($date)),

                //     date("Y-m-d H:i:s", strtotime($lesson->date)),
                //     $houre_end ,
                //     date("Y-m-d H:i:s", strtotime($lesson->date)) > $houre_end 
                // );