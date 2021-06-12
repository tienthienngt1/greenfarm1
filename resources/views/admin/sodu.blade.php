@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow">
    <div class="card-header">
        <a href="/adminitration" class="btn btn-outline-dark"><<</a>
            <center>
                <h2>
                    BALANCE
                </h2>
            </center>
            <a href="?refferal=1&a=sodu" class="btn btn-outline-dark">REFFERAL</a>
            <a href="?deposit=1&a=sodu" class="btn btn-outline-dark">DEPOSIT</a>
            <a href="?withdraw=1&a=sodu" class="btn btn-outline-dark">WITHDRAW</a>
            <a href="?balance=1&a=sodu" class="btn btn-outline-dark">BALANCE</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-sm  table-bordered">
                <thead>
                    <tr>
                        <th scope="col">USER_ID</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">BALANCE</th>
                        <th scope="col">DEPOSIT</th>
                        <th scope="col">REFFERAL</th>
                        <th scope="col">WITHDRAW</th>
                        <th scope="col">PENDING</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    if(isset($_GET['refferal'])){
                        $moneys = $moneys->sortByDesc('refferal');
                    }
                    elseif(isset($_GET['deposit'])){
                        $moneys = $moneys->sortByDesc('deposit');
                    }
                    elseif(isset($_GET['pending'])){
                        $moneys = $moneys->sortByDesc('pending');
                    }
                    else{
                        $moneys = $moneys->sortByDesc('balance');
                    }
                    $page = (int)($moneys->count())/100;
                    $pageUser = isset($_GET['page']) ?  $_GET['page'] : 1;
                    @endphp
                    @foreach($moneys->forPage($pageUser, 100) as $money)
                    <tr>
                        <td>{{$money -> user_id}}</td>
                        <td>{{$money -> user->email}}</td>
                        <td>{{number_format($money -> balance)}}đ</td>
                        <td>{{number_format($money -> deposit)}}đ</td>
                        <td>{{number_format($money -> refferal)}}đ</td>
                        <td>{{number_format($money -> withdraw)}}đ</td>
                        <td>{{number_format($money -> pending)}}đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <center>
                @for($i = 1; $i -1 <= $page; $i++)
                    <a href="?a=sodu&page={{$i}}" class="btn btn-outline-dark mt-3" >{{$i}}</a>
                @endfor
            </center>
    </div>
</div>

@endsection