@extends('layouts.app')

@section('content')

@php
        $cost = 0;
        if(!$feedings->isEmpty()){
            foreach($feedings as $f){
                $name = $f->name;
                break;
            };

            $getCollection = $shop->filter(function($shop) use($name){
                return $shop->id == $name;
            });
            foreach($getCollection as $g){
                $cost = $g->cost;
                break;
            };
        }
    @endphp 

@foreach($moneys as $money)
<div class="general-radius-sm shadow p-1 mb-3 row align-items-center ">
    <div class="col-2">
        <a href="/ca-nhan" class="btn btn-block btn-outline-dark">
            <i class="fas fa-angle-double-left"></i>
        </a>
    </div>
    <div class="col-10">
        <center>
            <h1>Thống kê thu nhập</h1>
        </center>
    </div>
</div>
<div class="general-radius-sm shadow p-1 mb-3 row align-items-center justify-content-center">
    <div class="col-3 general-radius-sm shadow m-3 p-1">
        <center>
            <h5>Số Dư</h5>
            <h4 style="color:orangered">{{number_format($money->balance)}}đ</h4>
        </center>
    </div>
    <div class="col-3 general-radius-sm shadow m-3 p-1">
        <center>
            <h5>Tổng Nạp</h5>
            <h4 style="color:orangered">{{number_format($money->deposit)}}đ</h4>
        </center>
    </div>
    <div class="col-3 general-radius-sm shadow m-3 p-1">
        <center>
            <h5>Lợi Nhuận</h5>
            <h4 style="color:orangered">{{number_format($money->deposit + ($money->refferal)*2 - $cost - $money->balance - $money->pending - $money->withdraw)}}đ</h4>
        </center>
    </div>  
    <div class="col-3 general-radius-sm shadow m-3 p-1">
        <center>
            <h5>Giới Thiệu</h5>
            <h4 style="color:orangered">{{number_format($money->refferal)}}đ</h4>
        </center>
    </div>
    <div class="col-3 general-radius-sm shadow m-3 p-1">
        <center>
            <h5>Đang rút</h5>
            <h4 style="color:red">{{number_format($money->pending)}}đ</h4>
        </center>
    </div>
    <div class="col-3 general-radius-sm shadow m-3 p-1">
        <center>
            <h5>Đã rút</h5>
            <h4 style="color:green">{{number_format($money->withdraw)}}đ</h4>
        </center>
    </div>
</div>
@endforeach

@endsection
