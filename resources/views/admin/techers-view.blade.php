@extends('admin.admin-layout')

@section('style')
    <link rel="stylesheet" href="{{asset('css/admin/techer.css')}}">
@endsection

@section('content')
<div class="techer-section container position-relative h-100">
    <div class="row align-items-center mb-2">
        <div class="col-9">
            <span class="title col-6 d-flex align-items-center">Techers</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-3">
            <input type="text" class="form-control filter-techer-name" placeholder="Techer Name">
        </div>
        <div class="col-3">
            <input type="text" class="form-control filter-techer-address" placeholder="Address">
        </div>
        <div class="col-3">
            <select class="form-select filter-techer-nationality" aria-label="Default select example">
                <option value="all" selected>{{__('Nationality')}}</option>
                @foreach($nationality as $nation)
                    <option value="{{$nation->nationality}}">{{$nation->nationality}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <select class="form-select filter-techer-sex" aria-label="Default select example">
                <option selected>{{__('Sex')}}</option>
                <option value="male">{{__('Male')}}</option>
                <option value="female">{{__('Female')}}</option>
            </select>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Sex</th>
                <th scope="col">Nationality</th>
                <th scope="col">Phone</th>
                <th scope="col">Whatsapp</th>
                <th scope="col">Address</th>
                <th scope="col">Cost</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="techers-data">

        </tbody>
    </table>

</div>
@endsection

@section('script')
<script src="{{asset('js/admin/techer.js')}}"></script>
@endsection