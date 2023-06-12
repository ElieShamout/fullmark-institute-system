<?php

namespace App\Console\Commands;

use App\Mail\TeacherNotifyMail;
use App\Models\DailyLessons;
use App\Models\Lessons;
use App\Models\NotifyLesson;
use App\Models\StuTeachLessCoun;
use App\Models\Teachers;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NotifyLessons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:lessons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $lessons = DB::table('daily_lessons')
            ->join('lessons', 'lessons.id', '=', 'daily_lessons.lesson_id')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('stu_teach_less_couns', 'stu_teach_less_couns.teacher_id', '=', 'teachers.id')
            ->where('lessons.date', '>=', date('Y-m-d H:i:s', strtotime(Carbon::now())))
            ->where('lessons.date', '<', date('Y-m-d H:i:s', strtotime(Carbon::now()) + 3600))
            ->select(
                'daily_lessons.id as id',
                'daily_lessons.lesson_id as lesson_id',
                'daily_lessons.status as status',
                DB::raw("CONCAT(teachers.first_name,' ',teachers.last_name) AS teacher_name"),
                'teachers.email as teacher_email',
                'teachers.cost as lesson_cost',
                'stu_teach_less_couns.teacher_rate as teacher_cost_rate',
                'lessons.id as lesson_id',
                'lessons.date as lesson_date',
                'lessons.date as lesson_date',
                'students.full_name as student_name',
                'students.address as student_address',
                'students.phone as student_phone',
            )->get();


        DB::table('notify_lessons')
            ->join('lessons', 'lessons.id', '=', 'notify_lessons.lesson_id')
            ->where('lessons.date', '<', date('Y-m-d H:i:s', strtotime(Carbon::now())))
            ->update(['notify_lessons.status' => 'marked']);

        DB::table('notify_lessons')
            ->join('lessons', 'lessons.id', '=', 'notify_lessons.lesson_id')
            ->where('lessons.date', '<', date('Y-m-d H:i:s', strtotime(Carbon::now())))
            ->update(['notify_lessons.status' => 'marked']);


        foreach ($lessons as $lesson) {

            if (!(NotifyLesson::where('lesson_id', '=', $lesson->lesson_id)->get()->first())) {
                $notify = new NotifyLesson();
                $notify->lesson_id = $lesson->lesson_id;
                $notify->status = 'waite';
                $notify->save();
                Mail::to($lesson->teacher_email)->send(new TeacherNotifyMail([
                    'teacher_name' => $lesson->teacher_name,
                    'teacher_email' => $lesson->teacher_email,
                    'student_name' => $lesson->student_name,
                    'student_phone' => $lesson->student_phone,
                    'student_address' => $lesson->student_address,
                    'lesson_date' => $lesson->lesson_date,
                    'lesson_cost' => $lesson->lesson_cost,
                    'teacher_cost_rate' => $lesson->teacher_cost_rate,
                ]));
            }
        }

        // $teachers = Teachers::get();

        // foreach ($teachers as $teacher) {
        //     $count_lessons = StuTeachLessCoun::where('teacher_id','=',$teacher->id)->get()->first();
        //     if ($count_lessons['lesson_count'] > 5) {
        //         $count_lessons->teacher_rate=85;
        //         $count_lessons->save();
        //     }
        // }
    }
}
