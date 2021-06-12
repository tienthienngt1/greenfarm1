@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow">
    <div class="card-header">
        <a href="/adminitration" class="btn btn-outline-dark">
            << </a>
                    <center>
                    <h2>
                        NAP TIEN
                    </h2>
                </center>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm  table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">USER_ID</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">NAME</th>
                        <th scope="col">MONEY</th>
                        <th scope="col">HASH</th>
                        <th scope="col">===========IMAGE=============</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">TIME</th>
                        <th scope="col">OPTION</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $page = (int)($deposits->count())/100;
                    $pageUser = isset($_GET['page']) ?  $_GET['page'] : 1;
                    @endphp
                    
                    @foreach($deposits->forPage($pageUser, 100) as $deposit)
                    <tr>
                        <td>{{$deposit -> id}}</td>
                        <td>{{$deposit -> user_id}}</td>
                        <td>{{$deposit -> user->email}}</td>
                        <td>{{$deposit -> user->name}}</td>
                        <td>{{number_format($deposit -> money)}}đ</td>
                        <td>{{$deposit -> hash}}</td>
                        <td><img src="{{ asset($deposit->image) }}" width="100%"></td>
                        <td>
                            @if($deposit -> status == 2)
                            <span style="color:red">Thất bại</span>
                            @elseif($deposit -> status == 0)
                            <span style="color:red">Đang xử lý</span>
                            @else
                            <span style="color:green">Hoàn thành</span>
                            @endif
                        </td>
                        <td>{{$deposit -> created_at}}</td>
                        <td>
                            <form method="post">
                                @csrf
                                <input type="hidden" name="_id" value="{{$deposit->id}}" />
                                <input type="hidden" name="user_id" value="{{$deposit->user_id}}" />
                                <input type="hidden" name="money" value="{{$deposit->money}}" />
                                <input type="submit" class="btn btn-outline-primary" name="chapnhan"
                                    value="OK" onclick="return(confirm('are you ok?'))"/>
                                <input type="submit" class="btn btn-outline-danger" onclick="return(confirm('are you ok?'))" name="tuchoi" value="FAIL" />
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <center>
                @for($i = 1; $i -1 <= $page; $i++)
                    <a href="?a=naptien&page={{$i}}" class="btn btn-outline-dark mt-3" >{{$i}}</a>
                @endfor
            </center>
    </div>
</div>
@endsection