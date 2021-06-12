@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow">
    <div class="card-header">
    <a href="/adminitration" class="btn btn-outline-dark"><<</a>
        <center>
            <h2>
                USER
            </h2>
        </center>
        <button class="btn btn-outline-dark shadow"
            onclick="$('#add').toggle(1000)">Thêm </button>
            <!-- FORM THÊM   -->
            <form method="post"style="display:none" id="add">
            @csrf
                <div class="form-group">
                    <label for="person">Tên người:</label>
                    <input name="name" type="text" class="form-control" id="person">
                    <label for="animal">Tên Animal:</label>
                    <input name="animal" type="text" class="form-control" id="animal">
                </div>
                    <input type="submit" name="addnotifi" class='btn btn-outline-dark' value = "Thêm">
            </form>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-sm  table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">EMAIL_VERIFIED_AT</th>
                        <th scope="col">TIME</th>
                        <th scope="col">OPTION</th>
                    </tr>
                </thead>
                <tbody>
                @php 
                $page = (int)($users->count())/100;
                $pageUser = isset($_GET['page']) ?  $_GET['page'] : 1;
                $users = $users->sortByDesc('created_at'); 
                @endphp
                @foreach($users->forPage($pageUser, 100) as $user)
                    <tr>
                        <th>{{$user -> id}}</th>
                        <td>{{$user -> name}}</td>
                        <td>{{$user -> email}}</td>
                        <td>{{$user -> status}}</td>
                        <td>
                        @if($user->email_verified_at === null)
                    <span style="color:red">Chưa kích hoạt</span>
                        @else
                    <span style="color:green">Đã kích hoạt</span>
                        @endif
                        </td>
                        <td>{{$user -> created_at}}</td>
                        <td>
                            <form method="post">
                                @csrf
                                <input type="hidden" name="_id" value="{{$user->id}}"/> 
                                <input class="btn btn-outline-danger" type="submit" name="khoa" onclick="return(confirm('are you ok?'))" value="Khoá"/> 
                                <input type="submit" class="btn btn-outline-primary" name="mo" onclick="return(confirm('are you ok?'))" value="MỞ "/> 
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            <center>
            @for($i = 1; $i -1 <= $page; $i++)
                <a href="?a=user&page={{$i}}" class="btn btn-outline-dark mt-3" >{{$i}}</a>
            @endfor
            </center>
    </div>
</div>
@endsection