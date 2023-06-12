@extends('admin.admin-layout')

@section('style')
<link rel="stylesheet" href="{{asset('css/admin/lessons.css')}}">
@endsection

@section('content')
<div class="lesson-section container">

    <div class="row align-items-center mb-4">
        <div class="col-9">
            <span class="title col-6 d-flex align-items-center">Lessons</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-3">
            <input type="text" class="form-control filter-lesson-student-name" placeholder="Student Name">
        </div>
        <div class="col-3">
            <input type="text" class="form-control filter-lesson-teacher-name" placeholder="Teacher Name">
        </div>
        <div class="col-2">
            <select class="form-select filter-subject" aria-label="Default select example">
                <option value="all" selected>{{__('Subject')}}</option>
                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <input type="datetime-local" class="form-control filter-lesson-date" id="">
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr class="lesson-row-{{$subject->id}}">
                <th scope="col">ID</th>
                <th scope="col">Teacher Name</th>
                <th scope="col">Student Name</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Number Of Lessons</th>
                <th scope="col">Note</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="lessons-data">

        </tbody>
    </table>

</div>
@endsection

@section('script')
<script src="{{asset('js/admin/lessons.js')}}"></script>
@endsection