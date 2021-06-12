@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow pt-2">
    <center>
        <h1><i class="fas fa-home mr-4"></i>Trang Trại</h1>
    </center>
    <hr>
    @if($feedings->isEmpty())
    <div style="opacity: 0.6;" class="mb-3">
        <center>
            <h3>Bạn chưa nhận nuôi con vật nào</h3>
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
    @endphp

    @foreach($shops as $sh)
    <div class="general-radius-sm shadow m-4 ">
        <div class="row align-items-center">
            <div class="col-3">
                <center>
                    <img src="{{ asset($sh->path) }}" class="m-2" title="{{$sh->name}}" width="20%" />
                    <span>
                        <h5>{{$sh->name}}</h5>
                        @php $per = $sh->namepermission;foreach($permissions as $permiss){$pername = $permiss->$per;}; @endphp
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

        <center> Lợi nhuận đang có: <span id="profitnow" style = "font-size:18px; color:orangered; opacity:0.8">...</span></center>
        <div class="col-12 mb-2 mt-2" id="_button">
            <div class="btn-block btn-outline-orange btn" style="opacity: 0.6;">
                Thời gian nhận lợi nhuận còn:<span style="font-size: 22px" id="time">...</span>
            </div>
        </div>
    </div>
</div>
@if(!$feedings->isEmpty())
<script>
//=====================================
var time1 = '{{ strtotime(json_decode($feedingtime)->timelimit) }}';
var x1 = setInterval(function() {
    var a1 = new Date().getTime();
    var now1 = Math.floor(a1 / 1000);
    var sum1 = time1 - now1;
    var days1 = Math.floor(sum1 / (60 * 24 * 60));
    var hours1 = Math.floor((sum1 % (60 * 24 * 60)) / (60 * 60));
    var minutes1 = Math.floor(((sum1 % (60 * 24 * 60)) % (60 * 60)) / 60);
    var seconds1 = Math.floor(((sum1 % (60 * 24 * 60)) % (60 * 60)) % 60);
    var dayprofit = (({{$sh->time}} - days1)*{{$sh->profit}}) - {{$sh->profit}};
    document.getElementById("time").innerHTML = days1 + "D " + hours1 + "h" + minutes1 + "m" + seconds1 + "s";
    document.getElementById("profitnow").innerHTML = dayprofit + 'đ';
    
    if (sum1 < 0) {
        clearInterval(x1);
        document.getElementById("profitnow").innerHTML = ({{$sh->profit}}*{{$sh->time}})+ 'đ';
        document.getElementById("_button").innerHTML = `
       <form method="POST">
          @csrf
          <input type="submit" class="btn btn-block btn-outline-orange" value="Nhận lợi nhuận" name="getProfit"/>
        </form>
        `;
    }
}, 1000);
</script>
@endif
@endforeach
@endif

@endsection