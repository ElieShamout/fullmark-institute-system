@extends('admin.admin-layout')

@section('style')
<link rel="stylesheet" href="{{asset('css/admin/subjects.css')}}">
@endsection

@section('content')
<div class="subjects-section container position-relative h-100">

    <div class="row align-items-center mb-2">
        <div class="col-9">
            <span class="title col-6 d-flex align-items-center">{{__('Subjects')}}</span>
        </div>
        <div class="row my-4 border-bottom pb-2">
            <div class="col-4">
                <label for="new-subject">{{__('Add new subject')}}</label>
                <div class="d-flex">
                    <input type="text" class="form-control subject-name w-100" id="new-subject" placeholder="Subject Name">
                    <select type="text" class="form-select specialization w-100 mx-1" id="new-subject" placeholder="Specialization">
                        <option value="" selected>{{__('Specialization')}}</option>
                        <option value="">{{__('None')}}</option>
                        <option value="scientific">{{__('Scientific')}}</option>
                        <option value="literary">{{__('Literary')}}</option>
                    </select>
                    <button class="btn btn-success ms-2 add-subject-btn">Add</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{__('Subject ID')}}</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Specialization')}}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="subjects-data">
            @foreach($subjects as $subject)
            <tr class="subject-row-{{$subject->id}}">
                <td>{{$subject->id}}</td>
                <td>{{$subject->name}}</td>
                <td>{{$subject->specialization}}</td>
                <td>
                    <button class="btn btn-success subject-all-info disabled" student-id="${ele.id}">{{__('Mory')}}</button>
                    <button class="btn btn-danger remove-subject" subject-id="{{$subject->id}}">{{__('Remove')}}</button>
                    <button class="btn btn-primary edit-subject disabled" subject-id="{{$subject->id}}">{{__('Edit')}}</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script src="{{asset('js/admin/subjects.js')}}"></script>
@endsection