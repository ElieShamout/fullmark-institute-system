@extends('admin.admin-layout')

@section('style')
<link rel="stylesheet" href="{{asset('css/admin/payment.css')}}">
<style>
    .new-payment {
        background-color: white;
        padding:20px;
    }
</style>
@endsection


@section('content')
<div class="payment-section container">

    <div class="row align-items-center mb-4">
        <div class="col-9">
            <span class="title col-6 d-flex align-items-center">Add New Payment</span>
        </div>
    </div>

    <div class="row col-4 mb-4 m-auto new-payment shadow rounded">
        <form action='{{route("add-new-payment")}}' method="post" id="image-upload" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3">
                <label for="lesson_id" class="form-label">Lesson ID</label>
                <input type="number" class="form-control" name="lesson_id" value="{{$lesson_id}}" id="lesson_id">
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">payment link</label>
                <input type="text" class="form-control" name="payment_link" id="payment_link">
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="datetime-local" class="form-control" name="payment_date" id="payment_date">
            </div>
            <div class="mb-3">
                <label for="Status" class="form-label">Status</label>
                <input type="text" class="form-control" name="payment_status" id="payment_status">
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <textarea class="form-control" name="payment_note" id="note"></textarea>
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" name="payment_image" id="payment_image">
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success save-payment">Save</button>
            </div>
        </form>

    </div>

</div>
@endsection
