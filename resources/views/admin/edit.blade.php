@extends('layouts.app')

@section('content')

<div class="general-radius-sm shadow">
    <div class="card-header">
        <a href="/adminitration" class="btn btn-outline-dark"><<</a>
            <center>
                <h2>
                    SỬA THÔNG TIN
                </h2>
            </center>
            <button class="btn btn-outline-dark shadow"
            onclick="$('#editinfo').toggle(1000)">Sửa </button>
            <button class="btn btn-outline-dark shadow" 
            onclick="$('#search').toggle(1000)">Tìm email</button>
            <!-- FORM SEARCH EMAIL   -->
            <form method="post"style="display:none" id="search">
            @csrf
                <div class="form-group">
                    <label for="user_id">Email</label>
                    <input name="email" type="email" class="form-control" id="user_id">
                </div>
                    <input type="submit" name="searchEmail" class='btn btn-outline-dark' value = "Tìm kiếm">
            </form>

            <!-- FORM EDIT -->
            <form method="post"style="display:none" id="editinfo">
            @csrf
                <div class="form-group">
                    <label for="user_id">user id</label>
                    <input name="user_id" type="number" class="form-control" id="user_id">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung cần sửa</label>
                    <input type="text" name="content" class="form-control" id="content">
                </div>
                <div class="form-group">
                    <label for="contentEdit">Nội dung sửa</label>
                    <input type="text" name="contentEdit" class="form-control" id="contentEdit">
                </div>
                    <input type="submit" name="infoEdit" class='btn btn-outline-dark' onclick="return(confirm('are you ok?'))" value = "sửa">
            </form>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-sm  table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">USER_ID</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">STK</th>
                        <th scope="col">BANK</th>
                        <th scope="col">CHI NHANH</th>
                        <th scope="col">TIME</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $page = (int)($infos->count())/100;
                    $pageUser = isset($_GET['page']) ?  $_GET['page'] : 1;
                    @endphp
                    @foreach($infos->forPage($pageUser, 100) as $info)
                    <tr>
                        <td>{{$info -> id}}</td>
                        <td>{{$info -> user_id}}</td>
                        <td>{{$info -> user->email}}</td>
                        <td>{{$info -> stk}}</td>
                        <td>{{$info -> bank}}</td>
                        <td>{{$info -> brand}}</td>
                        <td>{{$info -> created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <center>
                @for($i = 1; $i -1 <= $page; $i++)
                    <a href="?a=edit&page={{$i}}" class="btn btn-outline-dark mt-3" >{{$i}}</a>
                @endfor
            </center>
    </div>
</div>

@endsection