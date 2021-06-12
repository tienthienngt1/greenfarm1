@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow">
    <div class="card-header">
        <a href="/adminitration" class="btn btn-outline-dark">
            << </a>
                    <center>
                    <h2>
                        RÚT TIỀN
                    </h2>
                </center>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-sm  table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">USER_ID</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">MONEY</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">TIME</th>
                        <th scope="col">OPTION</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $with = isset($_GET['with']) ? $_GET['with'] : 1;
                    $page = floor($withdraws->count()/100);
                    @endphp
                    @foreach($withdraws->forPage($with,100) as $withdraw)
                    <tr>
                        <td>{{$withdraw -> id}}</td>
                        <td>{{$withdraw -> user_id}}</td>
                        <td>{{$withdraw -> user->email}}</td>
                        <td>{{number_format($withdraw -> money)}}đ</td>
                        <td>
                        @if($withdraw ->status == 0)
                        <span style="color:red">Đang xử lý</span>
                        @elseif($withdraw ->status == 1)
                        <span style="color:green">Hoàn thành</span>
                        @else
                        <span style="color:red">Thất bại</span>
                        @endif
                        </td>
                        <td>{{$withdraw -> created_at}}</td>
                        <td>
                        <form method="post">
                                @csrf
                                <input type="hidden" name="_id" value="{{$withdraw->id}}"/> 
                                <input class="btn btn-outline-primary" type="submit" name="successWithdraw" onclick="return(confirm('are you ok?'))" value="OKK"/> 
                                <input type="submit" class="btn btn-outline-danger" name="failedWithdraw" onclick="return(confirm('are you ok?'))" value="FAIL "/> 
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            @for($i = 1; $i-1 <= $page ; $i++)
            <center>
                <a href="?a=ruttien&with={{$i}}" class="btn btn-outline-dark mt-3" >{{$i}}</a>
            </center>
            @endfor
    </div>
</div>

@endsection