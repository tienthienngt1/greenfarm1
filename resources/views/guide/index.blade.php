@extends('layouts.app')

@section('content')

<div class="card general-background shadow" style="border-radius: 20px;">
    <div class="card-header">
        <center>
            <h2><i class="fas fa-user mr-4"></i>HƯỚNG DẪN</h2>
        </center>
    </div>
    <div class="card-body">
        <!-- Hướng dẫn đầu tư -->
        <button class="btn btn-outline-dark  btn-block mb-3 shadow" style="font-size:23px"
            onclick="$('#dautu').toggle(1000)">Hướng Dẫn Đầu Tư</button>
        <div class="card m-2 p-3" style="display:none;font-size:19px" id="dautu">
            <ul>
                <li>Trong cửa hàng có 10 con vật để bạn lựa chọn đầu tư. Mỗi con sẽ có lợi nhuận, giá mua, thời gian
                    hoàn thành là khác nhau.</li>
                <li>Mỗi con có giới hạn mua nên khi mua hết con vật này bạn có thể mua thêm những con vật có lợi nhuận
                    cao hơn.</li>
                <li>Hết thời gian hoàn thành bạn hãy vào trang trại để thu lợi nhuận.</li>
                <li>Sau khi nhận lợi nhuận xong thì tiền gốc sẽ được trả lại.</li>
                <li>Bạn có thể xem các tiến trình của mình đang làm và đã hoàn thành trong mục TIẾN TRÌNH.</li>
            </ul>
        </div>
        <!-- Kích hoạt tài khoản -->
        <button class="btn btn-outline-dark  btn-block mb-3 shadow" style="font-size:23px"
            onclick="$('#kichhoat').toggle(1000)">Kích Hoạt Tài Khoản</button>
        <div class="card m-2 p-3" style="display:none;font-size:19px" id="kichhoat">
            <ul>
                <li>Nếu tài khoản nào chưa được kích hoạt thì bạn hãy vào mục Cá Nhân -> Kích Hoạt Ngay.</li>
                <li>Hãy chắc chắn email này của bạn đang được sử dụng.</li>
                <li>Mã OTP sẽ được gửi vào email của bạn. Bạn vào email để lấy mã OTP.</li>
                <li>Mã OTP sẽ hết hạn trong vòng 10p. Nếu hết hạn bạn hãy thực hiện lại để nhận lại mã OTP</li>
                <li>Sau khi nhập đúng mã OTP thì tài khoản của bạn sẽ được kích hoạt ngay.</li>
            </ul>
        </div>
        <!-- Cập nhật thông tin người dùng -->
        <button class="btn btn-outline-dark  btn-block mb-3 shadow" style="font-size:23px"
            onclick="$('#thongtin').toggle(1000)">Cập Nhật Thông Tin Người Dùng</button>
        <div class="card m-2 p-3" style="display:none;font-size:19px" id="thongtin">
            <ul>
                <li>Bạn hãy chắc chắn họ và tên của bạn phải đúng với tên của tài khoản ngân hàng.</li>
                <li>Chỉ được cập nhật thông tin một lần đầu tiên.</li>
                <li>Nếu có thắc mắc hãy liên hệ với bộ phận chăm sóc khách hàng để biết thêm chi tiết.</li>
            </ul>
        </div>
        <!-- Giới thiệu -->
        <button class="btn btn-outline-dark  btn-block mb-3 shadow" style="font-size:23px"
            onclick="$('#gioithieu').toggle(1000)">Giới Thiệu</button>
        <div class="card m-2 p-3" style="display:none;font-size:19px" id="gioithieu">
            <ul>
                <li>Hệ thống đa dạng với hai tầng giới thiệu.</li>
                <li>Khi tầng 1 mua bất cứ con vật nào trong cửa hàng thì bạn sẽ nhận được 10% lợi nhuận từ con vật đó.
                    Tương tự tầng 2 sẽ được 5%.</li>
                <li>Tiền giới thiệu sẽ được cộng trực tiếp vào tài khoản chính. Thống kê tổng tiền giới thiệu sẽ có
                    trong mục tiền giới thiệu.</li>
                <li>Bạn có thể xem lịch sử của người giới thiệu trong mục Cá Nhân-> Thống Kê Giới Thiệu.</li>
            </ul>
        </div>
        <!-- Nạp Tiền -->
        <button class="btn btn-outline-dark  btn-block mb-3 shadow" style="font-size:23px"
            onclick="$('#naptien').toggle(1000)">Nạp Tiền</button>
        <div class="card m-2 p-3" style="display:none;font-size:19px" id="naptien">
            <ul>
                <li>Vào mục Cá nhân -> Nạp tiền.</li>
                <li>Thực hiện chuyển khoản vào tài khoản của hệ thống ghi theo đúng nội dung và số tiền muốn nạp.</li>
                <li>Sau khi chuyển khoản thành công hãy chụp ảnh chứng từ xác minh đã chuyển khoản thành công.</li>
                <li>Tạo lệnh và đợi hệ thống xử lý trong vài phút.</li>
                <li>Nếu quá 1h chưa được xử lý hãy liên hệ bộ phận chăm sóc hàng để được giải quyết.</li>
            </ul>
        </div>
        <!-- Rút Tiền -->
        <button class="btn btn-outline-dark  btn-block mb-3 shadow" style="font-size:23px"
            onclick="$('#ruttien').toggle(1000)">Rút Tiền</button>
        <div class="card m-2 p-3" style="display:none;font-size:19px" id="ruttien">
            <ul>
                <li>Tài khoản phải được kích hoạt thành công mới có thể rút tiền.</li>
                <li>Trước khi rút tiền bạn hãy vào mục Cá Nhân -> Thông Tin Người Dùng để cập nhật thông tin ngân hàng.
                </li>
                <li>Số tiền rút nhỏ nhất là 100.000đ.</li>
                <li>Bạn sẽ nhận được tiền trước 18h cùng ngày hoặc 18h ngày mai.</li>
                <li>Quá trình rút tiền hơn 2 ngày bạn hãy liên hệ bộ phận chăm sóc khách hàng để giải quyết.</li>
            </ul>
        </div>
    </div>
</div>
@endsection