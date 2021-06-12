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
            <h1>Thống kê giới thiệu</h1>
        </center>
    </div>
</div>

<div class="general-radius-sm shadow p-3 mb-1">
    <a href="/ca-nhan/thong-ke-gioi-thieu"
        class="btn mb-3  btn-outline-dark @if(isset($_GET['list']) && $_GET['list'] == '1' || isset($_GET['list']) && $_GET['list'] == '2') @else active @endif">Danh sách
        nhận thưởng</a>
    <a href="?list=1"
        class="btn btn-outline-dark mb-3 @if(isset($_GET['list']) && $_GET['list'] == '1') active @endif">Danh sách cấp
        dưới tầng 1</a>
    <a href="?list=2"
        class="btn btn-outline-dark mb-3 @if(isset($_GET['list']) && $_GET['list'] == '2') active @endif">Danh sách cấp
        dưới tầng 2</a>
    <table class="table table-hover table-sm table-bordered">

        @if(isset($_GET['list']) && $_GET['list'] == '1')
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên người giới thiệu</th>
                <th scope="col">Tầng hoa hồng</th>
                <th scope="col">Thời gian</th>
            </tr>
        </thead>
        <tbody>
        @php $stt = 1; $refferal1 = $refferal1->sortByDesc('created_at'); @endphp
        @foreach($refferal1 as $ref)
            <tr>
                <th scope="row">{{$stt}}</th>
                <td>{{$ref->user->name}}</td>
                <td style="color:red">Tầng 1</td>
                <td>{{ $ref->created_at }}</td>
            </tr>
            @php $stt++; @endphp
            @endforeach

            @elseif(isset($_GET['list']) && $_GET['list'] == '2')
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên người giới thiệu</th>
                    <th scope="col">Tầng hoa hồng</th>
                    <th scope="col">Thời gian</th>
                </tr>
            </thead>
            <tbody>
            @php $stt = 1; $refferal2 = $refferal2->sortByDesc('created_at'); @endphp
            @foreach($refferal2 as $ref)
                <tr>
                    <th scope="row">{{$stt}}</th>
                    <td>{{$ref->user->name}}</td>
                    <td style="color:red">Tầng 2</td>
                    <td>{{ $ref->created_at }}</td>
                </tr>
            @php $stt++; @endphp
            @endforeach

            @else
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên người giới thiệu</th>
                    <th scope="col">Tiền thưởng</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Tầng hoa hồng</th>
                    <th scope="col">Thời gian</th>
                </tr>
            </thead>
        <tbody>
            @php $stt = 1; $historybuys = $historybuys->sortByDesc('created_at'); @endphp
            @foreach($historybuys as $hb)
            <tr>
                <th scope="row">{{$stt}}</th>
                <td>{{$hb->user->name}}</td>
                <td style="color:green">+{{number_format($hb->money) }}</td>
                <td>Mua {{$hb->name}}</td>
                <td style="color:red">Tầng {{$hb->level}}</td>
                <td>{{ $hb->created_at }}</td>
            </tr>
            @php $stt++; @endphp
            @endforeach
            @endif
        </tbody>
    </table>
</div>

@endsection