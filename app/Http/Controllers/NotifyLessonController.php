<?php

namespace App\Http\Controllers;

use App\Models\NotifyLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifyLessonController extends Controller
{
    public function notify_admin()
    {
        $lessons = NotifyLesson::join('lessons', 'lessons.id', '=', 'notify_lessons.lesson_id')
            ->where('notify_lessons.status','=','waite')
            ->select('notify_lessons.lesson_id','lessons.date','notify_lessons.status','notify_lessons.id')
            ->orderByRaw('lessons.date')
            ->get();

        DB::table('notify_lessons')->where('status','!=','marked')->update(['status'=>'notified']);

        return $lessons;
    }
    
    public function change_status(Request $request)
    {
        $lessons=DB::table('notify_lessons')->where('status','=','notified')->update(['status'=>$request->status]);
        return $lessons;
    }

    public function marked_notify(Request $request)
    {
        $lessons=DB::table('notify_lessons')->where('id','=',$request->notify_id)->update(['status'=>$request->status]);
        return $lessons;
    }
}
