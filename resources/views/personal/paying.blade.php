@extends('layouts.app')

@section('content')
@php
foreach($users as $user){
    $name = $user -> name;
};
@endphp
<div class="general-radius-sm shadow p-1 mb-3 row align-items-center ">
        <div class="col-2">
            <a href="/ca-nhan" class="btn btn-block btn-outline-dark">
                <i class="fas fa-angle-double-left"></i>
            </a>
        </div>
        <div class="col-10">
            <center>
                <h1>Nạp tiền</h1>
            </center>
        </div>
</div>
<div class="general-radius-sm shadow p-1 mb-3">
@if(!$deposits->isEmpty())
@php 
$deposit = $deposits->filter(function($deposits){
    return (int)$deposits->status === 0;
})
@endphp

@if(!$deposit->isEmpty())
<a href = "/ca-nhan/lich-su-giao-dich"  class="ml-4 btn btn-outline-orange">
    Bạn đang có giao dịch chưa xử lý
</a>
@endif
@endif
    <center>
        <h4 style="color:red">*Lưu ý:</h4>
    </center>
    <ul>
        <li>Hệ thống sẽ xét duyệt tự động việc nạp tiền của bạn.</li>
        <li>Nạp tiền đúng với số tài khoản ở phía dưới, nếu sai hệ thống sẽ không xử lý cho bạn được.</li>
        <li>Nội dung chuyển khoản phải ghi rõ như nội dung bên dưới. Ghi đúng hệ thống sẽ xử lý nhanh hơn.</li>
        <li>Gửi kèm theo hình ảnh chuyển tiền thành công để hệ thống xác thực một cách chính xác nhất.</li>
        <li>Nếu có vấn đề về nạp tiền xin liên hệ dịch vụ chăm sóc khách hàng để được giải quyết nhanh nhất.</li>
        <li>Số tiền nạp ít nhất là <span style="color:red">85,688 vnđ</span> tương đương với giá của Mèo cấp 1.</li>
        <li>Lưu ý chuyển khoản đúng theo số tiền đã chọn.</li>
    </ul>
    <div class="ml-4 mb-5">
        <div class="mb-4">
            <h3>Thông tin nạp tiền</h3>
        </div>
        <h5>
            <p>Chủ Tài khoản: <span style="color:red">NGUYEN TIEN THIEN</span></p>
            <p>Số tài khoản: <span style="color:red">0010140867301</span></p>
            <p>Tên ngân hàng: <span style="color:red">MBBANK</span></p>
            <p>Nội dung: <span style="color:red">{{str_replace(' ','',$name)}}CK</span></p>
        </h5>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-5">
                <label for="money">Số tiền đã nạp:</label>
                <input type="number" class="form-control" id="money1" aria-describedby="Help" placeholder="Nhập số tiền đã nạp" disabled required>
                <input type="hidden" name="money" class="form-control" id="money2" aria-describedby="Help" placeholder="Nhập số tiền đã nạp">
                <small id="Help" class="form-text text-muted">Số tiền nạp ít nhất là: <span style="color:red">85,688 vnđ</span></small>
                <input class="btn btn-outline-dark select_money" type="button" value="85,688">
                <input class="btn btn-outline-dark select_money" type="button" value="549,094">
                <input class="btn btn-outline-dark select_money" type="button" value="5,000,000">
                <input class="btn btn-outline-dark select_money" type="button" value="1,200,052">
                <input class="btn btn-outline-dark select_money" type="button" value="2,500,094">
                <input class="btn btn-outline-dark select_money" type="button" value="3,809,049">
                <input class="btn btn-outline-dark select_money" type="button" value="7,497,097">
                <input class="btn btn-outline-dark select_money" type="button" value="15,098,005">
                <input class="btn btn-outline-dark select_money" type="button" value="51,000,192">
                <input class="btn btn-outline-dark select_money" type="button" value="80,502,013">
            </div>
            <div class="form-group">
                <label class="form-label" for="fileck">Hình ảnh chuyển tiền thành công</label>
                <input type="file" name="image" class="form-control" id="fileck" />
            </div>
            <button type="submit" name="paying" class="btn btn-outline-dark">Tạo đơn</button>
        </form>
    </div>
</div>

@endsection