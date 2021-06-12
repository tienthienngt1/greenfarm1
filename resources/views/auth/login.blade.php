@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    <center>
                        <h3>ĐĂNG NHẬP</h3>
                    </center>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Nhập email">

                                @error('email')
                                <span style="color: red;" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">Mật Khấu</label>

                            <div class="col-md-9">
                                <input id="password" type="password"
                                    class="form-control @error('email') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="Nhập mật khẩu">

                                @error('password')
                                <span style="color: red;" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <center>
                                    <button type="submit" class="btn btn-outline-dark btn">
                                        Đăng Nhập
                                    </button>
                                </center>
                            </div>

                            <div class="col-12 mt-2">
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="btn btn-outline-dark btn-sm">
                                    Quên mật khẩu?
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection