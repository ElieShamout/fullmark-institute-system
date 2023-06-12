<?php

namespace App\Console\Commands;

use App\Models\DailyLessons;
use App\Models\Lessons;
use App\Models\NotifyLesson;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LessonsDelay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lesson:delay';

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
    
        NotifyLesson::truncate();
        DailyLessons::truncate();
        $lessons = Lessons::where('date', '>=', date("Y-m-d",strtotime(Carbon::now())))
                          ->where('date', '<',  date("Y-m-d",strtotime(Carbon::now())+(86400)))
                          ->get();

        foreach ($lessons as $lesson) {
            $nn = new DailyLessons();
            $nn->lesson_id=$lesson->id;
            $nn->status='waite';
            $nn->save();
        }

    }
}
