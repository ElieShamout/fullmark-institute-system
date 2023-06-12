@extends('admin.admin-layout')

@section('style')
<link rel="stylesheet" href="{{asset('css/admin/student.css')}}">
@endsection


@section('content')
<div class="students-section container position-relative h-100">
    <div class="row align-items-center mb-2">
        <div class="col-9">
            <span class="title col-6 d-flex align-items-center">Students</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-3">
            <input type="text" class="form-control filter-student-name" placeholder="Student Name">
        </div>
        <div class="col-3">
            <input type="text" class="form-control filter-student-address" placeholder="Address">
        </div>
        <div class="col-3">
            <select class="form-select filter-student-specialization" aria-label="Default select example">
                <option value="all" selected>{{__('Specialization')}}</option>
                @foreach($specializations as $specialization)
                    <option value="{{$specialization->specialization}}">{{$specialization->specialization}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <select class="form-select filter-student-class" aria-label="Default select example">
                <option value="all" selected>{{__('Class')}}</option>
                <option value="1">{{__('1')}}</option>
                <option value="2">{{__('2')}}</option>
                <option value="3">{{__('3')}}</option>
                <option value="4">{{__('4')}}</option>
                <option value="5">{{__('5')}}</option>
                <option value="6">{{__('6')}}</option>
                <option value="7">{{__('7')}}</option>
                <option value="8">{{__('8')}}</option>
                <option value="9">{{__('9')}}</option>
                <option value="10">{{__('10')}}</option>
                <option value="11">{{__('11')}}</option>
                <option value="12">{{__('12')}}</option>
            </select>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Class</th>
                <th scope="col">Specialization</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="students-data">

        </tbody>
    </table>

</div>
@endsection

@section('script')
<script src="{{asset('js/admin/student.js')}}"></script>
@endsection