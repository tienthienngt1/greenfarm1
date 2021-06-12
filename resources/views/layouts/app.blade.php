<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <!-- header color -->
    <meta name="theme-color" content="#633103bb">
    <meta name="msapplication-TileColor" content="#633103bb">
    <meta name="msapplication-navbutton-color" content="#633103bb">
    <meta name="apple-mobile-web-app-status-bar-style" content="#633103bb">

    <!-- icon -->
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icon.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/all.min.js') }}" defer></script>
    <script src="{{ asset('js/pjax.js') }}" defer></script>

    <!-- Styles -->
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/awesome.css') }}" rel="stylesheet">

    <script type="text/javascript">
    $(document).ready(function() {

        $(function() {
            $(document).pjax('a', '#body');
        })
        if ($.support.pjax) {
            $.pjax.defaults.timeout = 1000;
        }

    });
    </script>

</head>

<body>
    <div id="app" class="container mt-4" style="max-width:1000px;min-width:700px">
        <div class="container justify-content-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/iconbackground.png') }}" alt="icon" width="40%">
            </a>
            <div class="float-right mt-5">
                @guest
                <a class="btn btn-outline-dark " href="{{ route('login') }}"><i class="fas fa-user mr-2"></i>Đăng
                    nhập</a>
                <a class="btn btn-outline-dark " href="{{ route('register') }}"><i
                        class="fas fa-user-plus mr-2"></i>Đăng kí</a>
                @else
                @if(\Auth::user()->status == 11)
                 <a class="btn btn-outline-orange " href='/adminitration'>ADMIN</a>
                @endif
                <a href="{{ route('logout') }}" class="btn btn-outline-dark"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt mr-2"></i>Đăng xuất</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @endguest
            </div>
        </div>
        @auth
        @php
        $notifibuys = \Cache::get('notifibuys');
        $notifibuys = $notifibuys->sortByDesc('id');
        $for = 0;
        @endphp
        @if(!$notifibuys->isEmpty())
        <div class="shadow mb-4 mt-4 p-2 general">
            <marquee scrolldelay="50" onmouseover="this.stop()" onmouseout="this.start()">
        @foreach($notifibuys as $notifi)
                <span class="mr-4">
                Chúc mừng bạn <span style="color:red">{{$notifi -> name}}</span> đã nhận nuôi thành công <span style="color:red">{{$notifi->animal}}</span>!
                </span>
        @php 
        $for++;
        if($for >=3){
            break;
        }
        @endphp
        @endforeach
            </marquee>
        </div>
        @endif
        <div class="mb-4 shadow d-flex align-items-center general" id="body" style="height: 60px;">
            <span class="" style="width: 20%;">
                <center>
                    <a href="/home" class="btn btn-outline-dark @if(strpos(url()->current(),'home')) active @endif ">
                        <i class="fas fa-home mr-2"></i>Trang Trại
                    </a>
                </center>
            </span>
            <span class="" style="width: 20%;">
                <center>
                    <a href="/cua-hang"
                        class="btn btn-outline-dark @if(strpos(url()->current(),'cua-hang')) active @endif">
                        <i class="fas fa-store mr-2"></i>Cửa hàng
                    </a>
                </center>
            </span>
            <span class="" style="width: 20%;">
                <center>
                    <a href="/tien-trinh"
                        class="btn btn-outline-dark @if(strpos(url()->current(),'tien-trinh')) active @endif">
                        <i class="fas fa-location-arrow mr-2"></i>Tiến trình
                    </a>
                </center>
            </span>
            <span class="" style="width: 20%;">
                <center>
                    <a href="/ca-nhan"
                        class="btn btn-outline-dark @if(strpos(url()->current(),'ca-nhan')) active @endif">
                        <i class="fas fa-user-edit mr-2"></i>Cá nhân
                    </a>
                </center>
            </span>
            <span class="" style="width: 20%;">
                <center>
                    <a href="/huong-dan"
                        class="btn btn-outline-dark @if(strpos(url()->current(),'huong-dan')) active @endif">
                        <i class="fas fa-sitemap mr-2"></i>Hướng dẫn
                    </a>
                </center>
            </span>
        </div>
        @endauth

        <!-- start main -->

        <main class=" py-4">
            @yield('content')
        </main>

        <!-- end main -->
        <!-- footer -->
        <div class="row justify-content-center">
            Greenfarm1.online Copyright@ 2021
        </div>

    </div>
    @if(Session::has('success'))
    <script>
    Swal.fire({
        title: '{{Session::get("success")}}',
        icon: 'success',
        timer: 5000,
    })
    </script>
    @endif
    @if(Session::has('error'))
    <script>
    Swal.fire({
        title: '{{Session::get("error")}}',
        icon: 'error',
        timer: 7000,
    })
    </script>
    @endif
    <script src="{{ asset('js/custom.js') }}" defer></script>
</body>

</html>