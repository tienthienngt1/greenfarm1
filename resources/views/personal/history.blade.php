@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow p-1 mb-3 row align-items-center ">
    <div class="col-2">
        <a href="/ca-nhan" class="btn btn-block btn-outline-dark">
            <i class="fas fa-angle-double-left"></i>
        </a>
    </div>
    <div class="col-10">
        <center>
            <h1>Lịch sử giao dịch</h1>
        </center>
    </div>
</div>
<div class="general-radius-sm shadow p-3 mb-3">
    <!-- <center>
        <h2>
            <div class="btn-group btn-group-lg" role="group" aria-label="First group">
                <button type="button" onclick="window.location.href='lich-su-giao-dich' "
                    class="btn btn-outline-dark @if(isset($_GET['action']) && $_GET['action'] === 'success' ) @else active @endif ">Đang
                    thực hiện</button>
                <button type="button" onclick="window.location.href='?action=success' "
                    class="btn btn-outline-dark @if(isset($_GET['action']) && $_GET['action'] === 'success' ) active @endif ">
                    Hoàn thành
                </button>
            </div </h2>
    </center> -->
    @php
    $stt = 1;
    @endphp
    @if($deposits->isEmpty())
    <center style="opacity:0.6;font-size:25px">Chưa có giao dịch</center>
    @else
    <table class="table table-hover table-sm table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã giao dịch</th>
                <th scope="col">Tiền nạp</th>
                <th scope="col">Ghi chú</th>
                <th scope="col">Thời gian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits->sortByDesc('created_at') as $deposit)
            <tr>
                <th scope="row">{{ $stt }}</th>
                <th scope="row">{{$deposit -> hash}}</th>
                <th scope="row" style="color:red">+{{number_format($deposit -> money)}}đ</th>
                <th scope="row">
                    @if($deposit -> status == 0)
                    <span style="color:red">Đang xử lý</span>
                    @elseif($deposit -> status == 1)
                    <span style="color:green">Hoàn thành</span>
                    @else
                    <span style="color:red">Thất bại</span>
                    @endif
                </th>
                <th scope="row">{{ $deposit -> created_at }}</th>
                @php $stt++; @endphp
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection