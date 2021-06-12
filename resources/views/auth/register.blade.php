@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    <center>
                        <h3>ĐĂNG KÍ</h3>
                    </center>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Họ Và Tên</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Tên trùng với tên ngân hàng">
                                @error('name')
                                <span style="color: red;">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Nhập email ">

                                @error('email')
                                <span style="color: red;" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">Mật khấu</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mật khẩu chứa 6 chữ số">

                                @error('password')
                                <span style="color: red;" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">Xác nhận mật khẩu</label>

                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Mật khẩu chứa 6 chữ số">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="refferal" class="col-md-3 col-form-label text-md-right">Mã giới thiệu</label>

                            <div class="col-md-9">
                                <input id="refferal" name="refferal" type="number" class="form-control  @error('ref') is-invalid @enderror" placeholder="Không bắt buộc" value="@php 
                                if(isset($_GET['ref'])){
                                    echo $_GET['ref'];
                                }else{}
                                @endphp">
                                @error('ref')
                                <span style="color: red;"><small>{{ $message }}</small></span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                            <center>
                                <button type="submit" class="btn btn-outline-dark">
                                    Đăng kí
                                </button>
                            </center>
                            </div>

                            <div class="col-12 mt-3">
                                <a href="{{ route('login') }}" class="btn btn-outline-dark">Đăng nhập tài khoản hiện có?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection