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
            <h1>Rút tiền</h1>
        </center>
    </div>
</div>
<div class="general-radius-sm shadow p-2 mb-3">
    <div class="general-radius-sm shadow p-5 m-3" style="font-size:23px;">
    @if($infos->isEmpty())
    <center>
        <p style="opacity:0.6; font-size:28px;">Bạn vui lòng cập nhật thông tin tài khoản...</p>
    </center>
    @else
    @foreach($infos as $info)
        <p>
            Họ và tên: <span style='color:red; font-size:27px;'>{{ \Auth::user()->name}}</span>
        </p>
        <p>
            Tên Ngân hàng: <span  style='color:red; font-size:27px;'>{{$info -> bank}}</span>
        </p>
        <p>
            STK: <span  style='color:red; font-size:27px;'>{{$info -> stk}}</span>
        </p>
        <center>Số dư: <span style="color:red">{{ number_format(\Auth::user()->money->balance) }}đ</span></center>
    @endforeach
    @endif
        <form method='post'>
            @csrf
            <div class="form-group">
                <label for="money">Số tiền rút:</label>
                <input type="number" name="money" class="form-control" id="money" placeholder="Nhập số tiền muốn rút" required>
            </div>
            <input type='submit' class="btn btn-outline-dark" name="withdraw" value="Rút tiền" />
        </form>
        <center>
            <h3 style="color:red">* Quy định:</h3>
            <p>Số tiền rút ít nhất là <span style="color:red" >100.000đ.</span></p>
            <p>Tiền sẽ về trước 18h ngày hôm sau.</p>
            <p>Tài khoản đã kích hoạt mới có thể rút tiền.</p>
            <p>Liên hệ ADMIN để biết thêm chi tiết.</p>
        </center>
    </div>
    <hr>
    <div class="general-radius-sm shadow p-3 m-3">
        <center>
            <h2>Lịch sử rút tiền</h2>
        </center>
        <table class="table table-hover table-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã giao dịch</th>
                    <th scope="col">Tiền rút</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Thời gian</th>
                </tr>
            </thead>
            <tbody>
                @php $stt = 1; @endphp
                @if($withdraws->isEmpty())
                <th colspan=5>
                    <center>
                        <h2 style="opacity:0.6">Chưa có giao dịch</h2>
                    </center>
                </th>
                @else
                @foreach($withdraws->sortByDesc('created_at') as $withdraw)
                <tr>
                    <th scope="row">{{ $stt }}</th>
                    <th scope="row">{{$withdraw -> hash}}</th>
                    @if($withdraw -> status == 0)
                    <th scope="row" style="color:red">{{number_format($withdraw -> money)}}đ</th>
                    <th scope="row" style="color:red">Đang chờ</th>
                    @elseif($withdraw -> status == 2)
                    <th scope="row" style="color:red">{{number_format($withdraw -> money)}}đ</th>
                    <th scope="row" style="color:red">Thất bại</th>
                    @else
                    <th scope="row" style="color:green">{{number_format($withdraw -> money)}}đ</th>
                    <th scope="row" style="color:green">Hoàn thành</th>
                    @endif
                    <th scope="row">{{ $withdraw -> created_at }}</th>
                    @php $stt++; @endphp
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection