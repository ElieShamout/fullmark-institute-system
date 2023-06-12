<?php

use App\Mail\TeacherNotifyMail;
use App\Models\Languages;
use App\Models\Levels;
use App\Models\Subjects;
use App\Models\Teachers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/test', function(){
    return Teachers::get();
});


Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth']
    ],
    function () {

        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

        Route::get('/techers', [App\Http\Controllers\TeacherController::class, 'teachers_view']);

        Route::get('/students', [App\Http\Controllers\StudentController::class, 'students_view'])->name('students');

        Route::get('/levels', [App\Http\Controllers\LevelController::class, 'levels_view'])->name('levels');

        Route::get('/subjects', [App\Http\Controllers\SubjectController::class, 'subjects_view'])->name('subjects');
        Route::get('/get-all-subjects-api', [App\Http\Controllers\SubjectController::class, 'get_all_subjects_api']);
        Route::get('/add-subjects-api', [App\Http\Controllers\SubjectController::class, 'add_subjects_api']);
        Route::get('/remove-subject-api', [App\Http\Controllers\SubjectController::class, 'remove_subjects_api']);

        Route::get('/statistics', [App\Http\Controllers\StatisticsController::class, 'statistics_view'])->name('statistics');

        Route::get('/get-all-teachers-api', [App\Http\Controllers\TeacherController::class, 'get_all_teachers_api']);
        Route::get('/delete-teacher-api', [App\Http\Controllers\TeacherController::class, 'delete_teacher']);
        Route::get('/filter-teacher-name', [App\Http\Controllers\TeacherController::class, 'filter_name']);
        Route::get('/filter-teacher-address', [App\Http\Controllers\TeacherController::class, 'filter_address']);
        Route::get('/filter-teacher-sex', [App\Http\Controllers\TeacherController::class, 'filter_sex']);
        Route::get('/filter-teacher-nationality', [App\Http\Controllers\TeacherController::class, 'filter_nationality']);
        Route::get('/get-teachers-api', [App\Http\Controllers\TeacherController::class, 'filtring_teachers']);


        Route::post('/new-student-api', [App\Http\Controllers\StudentController::class, 'new_student']);
        Route::get('/update-student-api', [App\Http\Controllers\StudentController::class, 'update_student']);



        Route::get('/techers-map', [App\Http\Controllers\TeacherController::class, 'techers_map_view'])->name('techers-map');



        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('home');



        Route::get('/get-all-students-api', [App\Http\Controllers\StudentController::class, 'get_all_students_api']);
        Route::get('/delete-student-api', [App\Http\Controllers\StudentController::class, 'delete_student']);
        Route::get('/filter-student-name', [App\Http\Controllers\StudentController::class, 'filter_name']);
        Route::get('/filter-student-address', [App\Http\Controllers\StudentController::class, 'filter_address']);
        Route::get('/filter-student-class', [App\Http\Controllers\StudentController::class, 'filter_class']);
        Route::get('/filter-student-specialization', [App\Http\Controllers\StudentController::class, 'filter_specialization']);


        Route::get('/new-lesson', [App\Http\Controllers\LessonController::class, 'new_lesson_view'])->name('new-lesson');
        Route::get('/lessons', [App\Http\Controllers\LessonController::class, 'lessons_view'])->name('lessons');
        Route::get('/daily-lessons-api', [App\Http\Controllers\LessonController::class, 'daily_lessons'])->name('daily_lessons');
        Route::get('/get-all-lessons-api', [App\Http\Controllers\LessonController::class, 'get_all_lessons_api']);
        Route::get('/lesson-info-api', [App\Http\Controllers\LessonController::class, 'lesson_info_api']);
        Route::get('/delete-lesson-api', [App\Http\Controllers\LessonController::class, 'delete_lesson']);
        Route::get('/filter-lesson-teacher-name', [App\Http\Controllers\LessonController::class, 'filter_lesson_teacher_name']);
        Route::get('/filter-lesson-student-name', [App\Http\Controllers\LessonController::class, 'filter_lesson_student_name']);
        Route::get('/filter-subject', [App\Http\Controllers\LessonController::class, 'filter_subject']);
        Route::get('/filter-lesson-date', [App\Http\Controllers\LessonController::class, 'filter_lesson_date']);
        Route::get('/save-lesson-api', [App\Http\Controllers\LessonController::class, 'save_lesson_api']);
        Route::get('/remove-lesson-api', [App\Http\Controllers\LessonController::class, 'remove_lesson_api']);



        Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'payment_view']);
        Route::get('/new-payment-view/{lesson_id?}', [App\Http\Controllers\PaymentController::class, 'new_payment_view'])->name('new-payment-view');
        Route::post('/add-new-payment', [App\Http\Controllers\PaymentController::class, 'add_payment'])->name('add-new-payment');
        Route::get('/get-all-payments-api', [App\Http\Controllers\PaymentController::class, 'get_all_payments_api']);
        Route::get('/payment-info-api', [App\Http\Controllers\PaymentController::class, 'get_payment_info_api']);
        Route::get('/filter-payment-status', [App\Http\Controllers\PaymentController::class, 'filter_payment_status']);
        Route::get('/delete-payment-api', [App\Http\Controllers\PaymentController::class, 'delete_payment']);
        Route::get('/filter-payment-date', [App\Http\Controllers\PaymentController::class, 'filter_payment_date']);


        Route::get('/teacher-daily-lesson', function () {
            return view('admin.mail.mail-daily-lessons');
        });


        Route::get('/add-new-admin', [App\Http\Controllers\AdminController::class, 'add_admin_view']);



        Route::get('/notifications-api', [App\Http\Controllers\NotifyLessonController::class, 'notify_admin']);
        Route::get('/change-status-notifications-api', [App\Http\Controllers\NotifyLessonController::class, 'change_status']);
        Route::get('/marked-notify-api', [App\Http\Controllers\NotifyLessonController::class, 'marked_notify']);

        Route::get('/notify', [App\Http\Controllers\LessonController::class, 'notify']);

        // Route::get('/teacher-notify', function () {
        //     $mail = [
        //         'teacher_name' => 'Elie Shamout',
        //         'teacher_email' => 'elie@gmail.com',
        //         'student_name' => 'Haya alassaf',
        //         'student_phone' => '87459521',
        //         'student_address' => 'kafr buhum, hama, syria',
        //         'lesson_date' => '2022-10-12 15:00:00pm',
        //     ];
        //     return view('teacher.emaill.lesson-notify',compact('mail'));
        // });
    }
);
