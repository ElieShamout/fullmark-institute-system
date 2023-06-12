@extends('admin.admin-layout')

@section('style')
<link rel="stylesheet" href="{{asset('css/admin/start.css')}}">
@endsection

@section('content')
<div class="start d-flex align-items-center justify-content-center">
    <div class="">
        <div class="start-title">
            Welcome Administrator
        </div>
        <div class="notify text-center">
            {{date('Y-m-d')}}
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection