<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment_view()
    {
        $payments = Payment::select('status')->distinct()->get();
        return view('admin.payment-view', compact('payments'));
    }
    public function new_payment_view($lesson_id=null)
    {
        return view('admin.new-payment-view',compact('lesson_id'));
    }

    public function get_all_payments_api()
    {
        $payments = Payment::get();
        return $payments;
    }

    public function filter_payment_status(Request $request)
    {
        if ($request->status != "all") {
            $payments = Payment::where('status', '=', $request->status)->get();
        } else {
            $payments = Payment::get();
        }
        return $payments;
    }

    public function delete_payment(Request $request)
    {
        $payments = Payment::find($request->payment_id)->delete();
        return true;
    }

    public function filter_payment_date(Request $request)
    {
        $payments = Payment::where('date', '>=', $request->date)->get();
        return $payments;
    }

    public function get_payment_info_api(Request $request)
    {
        $lesson = DB::table('payments')
            ->join('lessons', 'lessons.id', '=', 'payments.lesson_id')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('students', 'students.id', '=', 'lessons.student_id')
            ->join('subjects', 'subjects.id', '=', 'lessons.subject_id')
            ->select(
                'payments.*',
                'lessons.number_of_lesson',
                'lessons.date as lesson_date',
                'lessons.note as lesson_note',
                'lessons.status as lesson_status',
                'teachers.first_name as teacher_first_name',
                'teachers.last_name as teacher_last_name',
                'students.full_name as student_name',
                'students.phone as student_phone',
                'students.address as student_address',
                'subjects.name as subject'
            )
            ->where('lessons.id', '=', $request->lesson_id)
            ->get()->first();

        return $lesson;
    }

    public function add_payment(Request $request)
    {
        $request->validate([
            'payment_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        $imageName = time() . '.' . $request->payment_image->extension();
        
        $request->payment_image->move(public_path('images/payments'), $imageName);
        
        $payment=new Payment();
        $payment->lesson_id=$request->lesson_id;
        $payment->link=$request->payment_link;
        $payment->imageURL=$imageName;
        $payment->date=$request->payment_date;
        $payment->status=$request->payment_status;
        $payment->note=$request->payment_note;
        $payment->save();

        return redirect('admin/payment');
    }
}
