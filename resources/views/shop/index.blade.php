@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow p-1 mb-3">
    <center>
        <h1><i class="fas fa-store mr-4"></i>Cửa hàng</h1>
    </center>
</div>
@foreach($shop as $sh)
@foreach($users as $user)
<div class="general-radius-sm shadow row mb-4 align-items-end">
    <div class="col-3">
        <center>
            <img src="{{ asset($sh->path) }}" class="m-2" title="cat" width="35%" />
            <span>
                <h5>{{ $sh->name }}</h5>
                @php $per = $sh->namepermission @endphp
                Số lượt mua:@foreach($userPermission as $up){{ $up->$per }}/{{$sh->limited}}@endforeach
                @if(!is_numeric($sh->required))
                <p>
                    <span style="color:red">
                        *Yêu cầu: Đã mua {{$sh->required}}
                    </span>
                </p>
                @endif
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
            Thời gian hoàn thành
        </center>
    </div>
    <div class="col-3">
        <center>
            <h5 style="color:orangered">{{number_format($sh->cost)}}đ</h5>
            Giá mua
        </center>
    </div>
    <div class="col-12 mb-2 mt-2">
        @if(!$userFeeding->isEmpty())
        @foreach($userFeeding as $feed)
        @if((int)$feed->name === (int)$sh->id)
        <button type="button" class="btn-block btn-outline-orange btn" name="buy" disabled style="opacity: 0.5;">Đang
            nuôi</button>
        @else
        <form method="POST">
            @csrf
            <input type="hidden" name="_id" value="{{$sh->id}}" />
            <input type="hidden" name="_namepermission" value="{{$sh->namepermission}}" />
            <button type="submit" class="btn-block btn-outline-orange btn" name="buy">Mua</button>
        </form>
        @endif
        @endforeach
        @else
        <form method="POST">
            @csrf
            <input type="hidden" name="_id" value="{{$sh->id}}" />
            <input type="hidden" name="_namepermission" value="{{$sh->namepermission}}" />
            <button type="submit" class="btn-block btn-outline-orange btn" name="buy">Mua</button>
        </form>
        @endif
    </div>
</div>
@endforeach
@endforeach

@endsection