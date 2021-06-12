@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow">
  <div class="card-header mb-4">
    <center>
      <h2>
        <div class="btn-group btn-group-lg" role="group" aria-label="First group">
          <button type="button" onclick="window.location.href='?action=working' "
            class="btn btn-outline-dark @if(isset($_GET['action']) && $_GET['action'] === 'success' ) @else active @endif ">Đang
            tiến hành</button>
          <button type="button" onclick="window.location.href='?action=success' "
            class="btn btn-outline-dark @if(isset($_GET['action']) && $_GET['action'] === 'success' ) active @endif ">Đã
            hoàn thành</button>
        </div>
      </h2>
    </center>
  </div>
  @if($userShops->isEmpty())
  <div style="opacity: 0.6;" class="mb-3">
    <center>
      <h3>Chưa có tiến trình nào được hoàn thành!</h3>
    </center>
  </div>
  @else
  @foreach($userShops->sortByDesc('created_at') as $ush)
  @php
  $shops = $shop->filter(function($shop) use($ush){
  return (int)$shop->id === (int)$ush->name;
  });
  @endphp
  @foreach($shops as $sh)
  @php
  $per = $sh->namepermission;
  foreach($permissions as $permiss){
  $pername = $permiss->$per;
  };
  @endphp
  <div class="general-radius-sm shadow m-4 ">
    <div class="row align-items-center">
      <div class="col-3">
        <center>
          <img src="{{ asset($sh->path) }}" class="m-2" title="{{$sh->name}}" width="20%" />
          <span>
            <h5>{{$sh->name}}</h5>
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

    <center> Lợi nhuận thu được: <span id="profitnow"
      style="font-size:18px; color:orangered; opacity:0.8">{{number_format($sh -> profit * $sh->time)}}đ</span>
    </center>
    <div class="col-12 mb-2 mt-2" id="_button">
      <div class="btn-block btn-outline-orange btn" style="opacity: 0.6;">
        Đã hoàn thành
      </div>
    </div>
    <span style="opacity:0.8; " class="ml-5">{{$ush->created_at}}</span>
  </div>
  @endforeach
  @endforeach
  @endif
</div>
@endsection