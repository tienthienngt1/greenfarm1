@extends('layouts.app')

@section('content')

<div class="card general-background shadow" style="border-radius: 20px;">
    <div class="card-header">
        <center>
            <h2><i class="fas fa-user mr-4"></i> THÔNG TIN CÁ NHÂN</h2>
        </center>
    </div>
    @php
        foreach($moneys as $m){
            $balance = $m->balance;
            $deposit = $m->deposit;
            $refferal = $m -> refferal;
            $pending = $m -> pending;
            $withdraw = $m -> withdraw;
        };
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
    @foreach($users as $user)
    <div class="card-body">
        <!-- header -->
        <div class="row">
            <div class="col-3">
                <img src="{{ asset('images/personal/'.$user->image) }}" title="{{ $user->name }}" width="75%" height="150px" />
            </div>
            <div class="col-9 mt-5">
                <strong>
                    <h5>{{ $user->name }}</h5>
                </strong>
                <p>
                    Mã giới thiệu: {{$user->refferal->refferal}}
                </p>
                @if($user->email_verified_at)
                <span style="color:green">
                <i class="fas fa-check-square"></i> Đã kích hoạt
                </span>
                @else
                <span style="color:red">
                    * Tài khoản chưa kích hoạt <a class="btn btn-outline-orange" href="/ca-nhan/kich-hoat-tai-khoan">Kích hoạt ngay</a>
                </span>
                @endif
            </div>
        </div>
        <!-- deposit -->
        <div class="mt-4 row">
            <div class="col-6">
                <a class="btn btn-block btn-outline-danger" href="?action=1" class="shadow">Nạp tiền</a>
            </div>
            <div class="col-6">
                <a class="btn btn-block btn-outline-dark" href="?action=2" class="shadow">Rút tiền</a>
            </div>
        </div>
        <!-- thong ke -->
        <div class="row mt-4">
            <div class="col-3 general">
                <center>
                    <div>
                        <span style="color:orangered">{{number_format($balance)}}đ</span>
                    </div>
                    <div>
                        Số dư
                    </div>
                </center>
            </div>
            <div class="col-3 general">
                <center>
                    <div>
                        <span style="color:orangered">{{number_format($deposit)}}đ</span>
                    </div>
                    <div>
                        Tổng đầu tư
                    </div>
                </center>
            </div>
            <div class="col-3 general">
                <center>
                    <div>
                        <span style="color:orangered">{{number_format(abs(-$deposit - ($refferal)*2 + $cost + $balance + $pending + $withdraw))}}đ</span>
                    </div>
                    <div>
                        Tổng lợi nhuận
                    </div>
                </center>
            </div>
            <div class="col-3 general">
                <center>
                    <div>
                        <span style="color:orangered">{{ number_format($user->money->refferal)}}đ</span>
                    </div>
                    <div>
                        Thu nhập giới thiệu
                    </div>
                </center>
            </div>
        </div>
@endforeach
        <!-- thong tin -->
        <a href="/ca-nhan/thong-tin" class="shadown">
            <button class="btn btn-block btn-outline-dark mt-4 text-left">
                <i class="fas fa-user-edit mr-2 ml-3"></i>
                Thông tin người dùng
                <i class="fas fa-angle-double-right ml-2"></i>
            </button>
        </a>
        <!-- ======================= -->
        <a href="/ca-nhan/thong-ke-gioi-thieu" class="shadow">
            <button class="btn btn-block btn-outline-dark mt-4 text-left">
                <i class="fas fa-restroom mr-2 ml-3"></i>
                Thống kê giới thiệu
                <i class="fas fa-angle-double-right ml-2"></i>
            </button>
        </a>
        <!-- ======================= -->
        <a href="/ca-nhan/thong-ke-thu-nhap" class="shadow">
            <button class="btn btn-block btn-outline-dark mt-4 text-left">
                <i class="fas fa-hand-holding-usd mr-2 ml-3"></i>
                Thống kê thu nhập
                <i class="fas fa-angle-double-right ml-2"></i>
            </button>
        </a>
        <!-- ======================= -->
        <a href="/ca-nhan/lich-su-giao-dich" class="shadow" class="shadow">
            <button class="btn btn-block btn-outline-dark mt-4 text-left">
                <i class="fas fa-chart-line mr-2 ml-3"></i>
                Lịch sử giao dịch
                <i class="fas fa-angle-double-right ml-2"></i>
            </button>
        </a>
        <!-- ======================= -->
        <a href="{{ route('home') }}">
            <button class="btn btn-block btn-outline-dark mt-4 text-left">
                <i class="fas fa-cat mr-1 ml-3"></i>
                Trang trại của tôi
                <i class="fas fa-angle-double-right ml-2"></i>
            </button>
        </a>
        <!-- ======================= -->
        <a href="/lien-he">
            <button class="btn btn-block btn-outline-dark mt-4 text-left">
                <i class="fas fa-book mr-1 ml-3"></i>
                Liên hệ chăm sóc khách hàng
                <i class="fas fa-angle-double-right ml-2"></i>
            </button>
        </a>
        <!-- ======================= -->
        <a href="ca-nhan/doi-mat-khau" class="shadow" class="shadow">
            <button class="btn btn-block btn-outline-dark mt-4 text-left">
                <i class="fas fa-key mr-2 ml-3"></i>
                Đổi mật khẩu
                <i class="fas fa-angle-double-right ml-2"></i>
            </button>
        </a>
        <!-- ======================= -->
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <button class="btn btn-block btn-outline-dark mt-4 text-left">
                <i class="fas fa-user-edit mr-2 ml-3"></i>
                Đăng xuất
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                <i class="fas fa-angle-double-right ml-2"></i>
            </button>
        </a>
        <!-- ======================= -->
    </div>

    @endsection