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
            <h1>Thông tin người dùng</h1>
        </center>
    </div>
</div>
<div class="general-radius-sm shadow p-1 mb-3 p-3">
@php 
$flag = true;
$button = 'save';
if($infos->isEmpty()){
    $flag = false;
}else{
    foreach($infos as $info){
        $bank = $info->bank;
        $brand = $info->brand;
        $stk = $info->stk;
        $status = $info->status;
    };
}
@endphp
    <form method="post">
    @csrf
        <div class="form-group">
            <label for="name">Họ và tên:</label>
            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" disabled value = "{{ \Auth::user()->name }}">
            <small id="nameHelp" style="color:red;opacity:0.8">Tên phải trùng với tài khoản ngân hàng</small>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" disabled value="{{ \Auth::user()->email }}">
        </div>
        <div class="form-group">
            <label for="bank">Tên ngân hàng:</label>
            <input type="text" name="bank" class="form-control" id="bank" placeholder="Nhập tên ngân hàng" required @if($flag) disabled value="{{$bank}}"@endif>
        </div>
        <div class="form-group">
            <label for="stk">Số tài khoản ngân hàng:</label>
            <input type="number"  name="stk" class="form-control" id="stk" placeholder="Nhập số tài khoản ngân hàng" required @if($flag) disabled  value="{{$stk}}"@endif>
        </div>
        <div class="form-group">
            <label for="brand">Chi nhánh ngân hàng:</label>
            <input type="text" class="form-control" name="brand" id="brand" placeholder="Nhập chi nhánh ngân hàng" required @if($flag) disabled value="{{$brand}}" @endif>
        </div>
        <span style = "color:red;opacity:0.8">* Bạn kiểm tra kĩ thông tin trước khi lưu.</span><br>
        <span style = "color:red;opacity:0.8"> &nbsp Bạn chỉ được phép cập nhật lần đầu tiên. Nếu sai hệ thống sẽ không nhận và rút được tiền.</span>
        <button @if($flag) type="button" @else type="submit" @endif  name="{{$button}}" class="btn btn-block btn-outline-dark">THAY ĐỔI</button>
    </form>
</div>

@endsection