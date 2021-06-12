@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow">
    <div class="card-header">
        <center>
            <h2>
                <div class="btn-group btn-group-lg" role="group" aria-label="First group">
                    <button type="button" onclick="window.location.href='?action=working' "
                        class="btn btn-outline-dark @if(isset($_GET['action']) && $_GET['action'] === 'success' ) @else active @endif ">Đang
                        tiến hành</button>
                    <button type="button" onclick="window.location.href='?action=success' "
                        class="btn btn-outline-dark @if(isset($_GET['action']) && $_GET['action'] === 'success' ) active @endif ">Đã
                        hoàn thành</button>
                </div </h2>
        </center>
    </div>
    @if($feedings->isEmpty())
    <div style="opacity: 0.6;" class="mb-3 mt-3">
        <center>
            <h3>Chưa có tiến trình nào đang làm việc!</h3>
        </center>
    </div>
    @else
    @php
    foreach($feedings as $feeding){
    $feedingname = $feeding->name;
    $feedingtime = $feeding->time;
    };
    $shops = $shop->filter(function($shop) use($feedingname){
    return (int)$shop->id === $feedingname;
    });
    $time = strtotime(json_decode($feedingtime)->time);
    $timelimit = strtotime(json_decode($feedingtime)->timelimit);
    $sum = $timelimit - $time;
    $percent = round(((strtotime(now())-$time)/$sum)*100, 2);
    if($percent > 100){
        $percent = 100;
    }
    @endphp

    @foreach($shops as $sh)
    <div class="general-radius-sm shadow m-4 ">
        <div class="row align-items-center">
            <div class="col-3">
                <center>
                    <img src="{{ asset($sh->path) }}" class="m-2" title="{{$sh->name}}" width="20%" />
                    <span>
                        <h5>{{$sh->name}}</h5>
                        @php $per = $sh->namepermission;foreach($permissions as $permiss){$pername = $permiss->$per;};
                        @endphp
                        Số lượt mua: {{ $pername }}/{{$sh->limited}}
                    </span>
                </center>
            </div>
            <div class="col-3">
                <center>
                    <h5 style="color:orangered">{{number_format($sh->profit)}}đ</h5>
                    Lợi nhuận/ngày
                </center>
            </div>
            <div class="col-3">
                <center>
                    <h5 style="color:orangered">{{$sh->time}} ngày</h5>
                    Thời gian thu hoạch
                </center>
            </div>
            <div class="col-3">
                <center>
                    <h5 style="color:orangered">{{number_format($sh->cost)}}đ</h5>
                    Giá nhận nuôi
                </center>
            </div>
        </div>
        <div class="col-12 mb-2 mt-2" id="_button">
            <div class="progress mb-2 mt-4">
                <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress" role="progressbar"
                    aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
                    <center>
                        <span id="percent"></span>
                    </center>
            <div class="btn-block btn-outline-orange btn" style="opacity: 0.6;">
                <span id = 'percent1'>Đang tiến hành
                <span class="spinner-grow spinner-grow-sm"></span>
                <span class="spinner-grow spinner-grow-sm"></span>
                <span class="spinner-grow spinner-grow-sm"></span>
                </span>
            </div>
        </div>
    </div>
@if(!$feedings->isEmpty())
<script>
//=====================================
var x1 = setInterval(function() {
    var a1 = new Date().getTime();
    var sum1 = a1/1000 - {{$time}} -{{$sum}};

    var per = ((a1/1000 - {{$time}})/{{$sum}})*100;
    if(per > 100){
        per = 100;
    }
    var per = per.toString();
    document.getElementById("percent").innerHTML = per.slice(0,5) + '%';
    document.getElementById("progress").style.width = per+'%';
    
    if (a1/1000 > {{$timelimit}}) {
        clearInterval(x1);
        document.getElementById("progress").style.width = '100%';
        document.getElementById("percent").innerHTML = per.slice(0,5) + '%';
        document.getElementById("percent1").innerHTML =  'Chưa nhận thưởng';
    }
}, 1000);
</script>
@endif
    @endforeach
    @endif
</div>
@endsection
