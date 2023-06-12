@extends('admin.admin-layout')

@section('style')
<link rel="stylesheet" href="{{asset('css/admin/admins.css')}}">
@endsection

@section('content')
<div class="admin-section container">

    <div class="row align-items-center mb-4">
        <div class="col-9">
            <span class="title col-6 d-flex align-items-center">Add New Admin</span>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{asset('js/admin/admins.js')}}"></script>
@endsection