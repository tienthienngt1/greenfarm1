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
            <h1>Kích hoạt tài khoản</h1>
        </center>
    </div>
</div>
@if(isset($_GET['hash']))
<div class="general-radius-sm shadow p-5 mb-3">
    <form method="POST">
        @csrf
        <div class="form-group row">
            <label for="otp" class="col-md-4 col-form-label text-md-right">Nhập mã otp:</label>

            <div class="col-md-6">
                <input id="otp" type="number" name="otp" class="form-control @error('verified') is-invalid @enderror" placeholder="Nhập mã otp">
                @error('verified')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <input type="submit" class="btn btn-outline-dark" name="sendOtp" value="Gửi" />
            </div>
        </div>
    </form>
</div>

@else
<div class="general-radius-sm shadow p-5 mb-3">
    <form method="POST">
        @csrf
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email của bạn:</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" disabled
                    value="{{\Auth::user()->email}}">
                <input type="hidden" name="email" value="{{\Auth::user()->email}}" />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
            <input type="submit" class="btn btn-outline-dark" name="sendemail" value="Gửi" />
            </div>
        </div>
    </form>
    <h3 style="color:red">*Chú ý:</h3>
    <ul>
        <li>Hệ thống sẽ gửi mã otp cho bạn vào email.</li>
        <li>Bạn hãy vào email để kiểm tra và nhập đúng mã.</li>
        <li>Nhập đúng thì tài khoản của bạn sẽ được kích hoạt.</li>
        <li>Thời gian hết hạn của mã là 10p.</li>
    </ul>
</div>

@endif
@endsection