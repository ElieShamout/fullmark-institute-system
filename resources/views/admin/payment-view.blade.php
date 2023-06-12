@extends('admin.admin-layout')

@section('style')
<link rel="stylesheet" href="{{asset('css/admin/payment.css')}}">
<style>
    .view-box .view-box-content{ 
        width:800px;
    }
</style>
@endsection


@section('content')
<div class="payment-section container">

    <div class="row align-items-center mb-4">
        <div class="col-9">
            <span class="title col-6 d-flex align-items-center">Payment</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-3">
            <input type="datetime-local" class="form-control filter-payment-date">
        </div>
        <div class="col-3">
            <select class="form-select filter-payment-status" aria-label="Default select example">
                <option value="all" selected>{{__('Status')}}</option>
                @foreach($payments as $payment)
                <option value="{{$payment->status}}">{{$payment->status}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <button class="btn btn-primary new-payment">new payment</button>
        </div>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Link</th>
                <th scope="col">Status</th>
                <th scope="col">Note</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="payments-data">

        </tbody>
    </table>

</div>
@endsection

@section('script')
<script src="{{asset('js/admin/payment.js')}}"></script>
@endsection