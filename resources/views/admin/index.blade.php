@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow">
    <div class="card-header">
        <center>
            <h2>
                ADMIN
            </h2>
        </center>
    </div>
    <div class="card-body" id="admin">
        @php 
        $deposit = $deposits->filter(function($deposits){return $deposits->status == 0;})->count();
        $withdraw = $withdraws->filter(function($withdraws){return $withdraws->status == 0;})->count();
        @endphp
        <a href="?a=user" class="btn btn-block btn-outline-dark">USER</a>
        <a href="?a=naptien" class="btn btn-block btn-outline-dark">NẠP TIỀN<span class="badge badge-danger ml-2" style="font-size: 20px;">{{$deposit}}</span></a>
        <a href="?a=ruttien" class="btn btn-block btn-outline-dark">RÚT TIỀN<span class="badge badge-danger ml-2" style="font-size: 20px;">{{$withdraw}}</span></a>
        <a href="?a=edit" class="btn btn-block btn-outline-dark">SỬA THÔNG TIN</a>
        <a href="?a=sodu" class="btn btn-block btn-outline-dark">SỐ DƯ</a>
    </div>
</div>
@endsection