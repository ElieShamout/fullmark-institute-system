<?php

namespace App\Http\Controllers;

use App\Models\DailyLessons;
use App\Models\Lessons;
use App\Models\StuTeachLessCoun;
use App\Models\Subjects;
use App\Notifications\LessonsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function new_lesson_view()
    {
        $time = time();
        return view('admin.new-lesson-view', compact('time'));
    }

    public function new_lesson(Request $request)
    {
        return $request;
    }

    public function save_lesson_api(Request $request)
    {

        // $subject_id=Subjects::where('name','=',$request->subject);

        $lesson = new Lessons();
        $lesson->admin_id = Auth::user()->id;
        $lesson->teacher_id = $request->teacher_id;
        $lesson->subject_id = $request->subject_id;
        $lesson->student_id = $request->student_id;
        $lesson->number_of_lesson = $request->number_of_lesson;
        $lesson->note = $request->note;
        $lesson->date = date("Y-m-d H:i:s", strtotime($request->date));

        $lesson->save();

        if ($lesson) {
            if (empty(StuTeachLessCoun::where('teacher_id', $request->teacher_id)->where('student_id', $request->student_id)->get()->first())) {
                StuTeachLessCoun::insert([
                    'teacher_id' => $request->teacher_id,
                    'student_id' => $request->student_id,
                    'lesson_count' => 1,
                    'teacher_rate' => 75,
                ]);
            } else {
                $rate = DB::table('stu_teach_less_couns')
                    ->where('teacher_id', $request->teacher_id)
                    ->where('student_id', $request->student_id)
                    ->get()
                    ->first();

                $rate->lesson_count = $rate->lesson_count + 1;

                if ($rate->lesson_count>5){
                    DB::table('stu_teach_less_couns')
                    ->where('teacher_id', $request->teacher_id)
                    ->where('student_id', $request->student_id)
                    ->update([
                        'lesson_count' => $rate->lesson_count,
                        'teacher_rate' => 85,
                    ]);
                }else{
                    DB::table('stu_teach_less_couns')
                    ->where('teacher_id', $request->teacher_id)
                    ->where('student_id', $request->student_id)
                    ->update([
                        'lesson_count' => $rate->lesson_count,
                    ]);
                }
            }
            $lesson_id = Lessons::where('date', '=', $request->date)->where('student_id', '=', $request->student_id)->select('id')->get()->first();

            return $lesson_id->id;
        }
    }

    public function remove_lesson_api(Request $request)
    {
        $lesson = DB::table('lessons')->where('id', '=', $request->lesson_id)->delete();

        if ($lesson) {
            return 'success';
        } else {
            return 'error';
        }
    }

    public function lessons_view()
    {
        $lessons = [LessonController::class, 'get_all_lessons_api'];
        $subjects = Subjects::get();
        return view('admin.lessons-view', compact('lessons', 'subjects'));
    }

    public function get_all_lessons_api(Request $request)
    {
        $lessons = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('subjects', 'subjects.id', '=', 'lessons.subject_id')
            ->select('lessons.*', 'teachers.first_name as teacher_first_name', 'teachers.last_name as teacher_last_name', 'students.full_name as student_name', 'subjects.name as subject')
            ->get();

        return $lessons;
    }


    public function filter_lesson_teacher_name(Request $request)
    {
        $first_name = explode(' ', $request->teacher_name)[0] ?? '';
        $last_name = explode(' ', $request->teacher_name)[1] ?? '';

        $lessons = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('subjects', 'subjects.id', '=', 'lessons.subject_id')
            ->where('teachers.first_name', 'LIKE', $first_name . "%")
            ->where('teachers.last_name', 'LIKE', $last_name . "%")
            ->select('lessons.*', 'teachers.first_name as teacher_first_name', 'teachers.last_name as teacher_last_name', 'students.full_name as student_name', 'subjects.name as subject')
            ->get();
        return $lessons;
    }

    public function filter_lesson_student_name(Request $request)
    {
        $lessons = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('subjects', 'subjects.id', '=', 'lessons.subject_id')
            ->where('students.full_name', 'LIKE', $request->student_name . "%")
            ->select('lessons.*', 'teachers.first_name as teacher_first_name', 'teachers.last_name as teacher_last_name', 'students.full_name as student_name', 'subjects.name as subject')
            ->get();
        return $lessons;
    }

    public function filter_subject(Request $request)
    {
        $lessons = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('subjects', 'subjects.id', '=', 'lessons.subject_id')
            ->where('lessons.subject_id', '=', $request->subject)
            ->select('lessons.*', 'teachers.first_name as teacher_first_name', 'teachers.last_name as teacher_last_name', 'students.full_name as student_name', 'subjects.name as subject')
            ->get();
        return $lessons;
    }

    public function filter_lesson_date(Request $request)
    {
        $lessons = DB::table('lessons')->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('subjects', 'subjects.id', '=', 'lessons.subject_id')
            ->where('date', '=', $request->date)
            ->select('lessons.*', 'teachers.first_name as teacher_first_name', 'teachers.last_name as teacher_last_name', 'students.full_name as student_name', 'subjects.name as subject')
            ->get();
        return $lessons;
    }

    public function delete_lesson(Request $request)
    {
        $student = Lessons::find($request->lesson_id)->delete();
        return true;
    }


    public function notify()
    {
    }

    public function daily_lessons()
    {
        $lessons = DB::table('daily_lessons')
            ->join('lessons', 'lessons.id', '=', 'daily_lessons.lesson_id')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('subjects', 'subjects.id', '=', 'lessons.subject_id')
            ->select(
                'lessons.*',
                'teachers.cost as lesson_cost',
                'teachers.first_name as teacher_first_name',
                'teachers.last_name as teacher_last_name',
                'students.full_name as student_name',
                'students.phone as student_phone',
                'students.address as student_address',
                'subjects.name as subject'
            )
            ->orderByRaw('lessons.date')
            ->get();


        return $lessons;
    }

    public function lesson_info_api(Request $request)
    {
        $lesson = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('subjects', 'subjects.id', '=', 'lessons.subject_id')
            ->select(
                'lessons.*',
                'teachers.first_name as teacher_first_name',
                'teachers.last_name as teacher_last_name',
                'teachers.phone as teacher_phone',
                'teachers.cost as lesson_cost',
                'students.full_name as student_name',
                'students.phone as student_phone',
                'students.address as student_address',
                'subjects.name as subject'
            )
            ->where('lessons.id', '=', $request->lesson_id)
            ->get()->first();


        return $lesson;
    }
}
