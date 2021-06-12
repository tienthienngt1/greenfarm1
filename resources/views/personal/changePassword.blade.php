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
      <h1>Đổi mật khẩu</h1>
    </center>
  </div>
</div>
<div class="general-radius-sm shadow p-5 mb-3">
  <form method="POST">
    @csrf

    <div class="form-group row">
      <label for="passwordold" class="col-md-4 col-form-label text-md-right">Mật khẩu cũ:</label>

      <div class="col-md-6">
        <input id="passwordold" type="password" class="form-control @error('email') is-invalid @enderror" name="passwordold"required autocomplete="password" placeholder="Nhập mật khẩu">

        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu mới:</label>

      <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Nhập mật khẩu mới">

        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Nhập lại mật khẩu:</label>

      <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Nhập lại mật khẩu mới">
      </div>
    </div>

    <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-outline-dark">
          Thay đổi
        </button>
      </div>
    </div>
  </form>
</div>
@endsection