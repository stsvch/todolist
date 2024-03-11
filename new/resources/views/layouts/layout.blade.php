<!DOCTYPE html>
<html lang="ru">
<head>
    @section('head')
        <meta charset="UTF-8">
        <title></title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    @endsection
    @yield('head')
</head>
<body>
    @if(Session::get('user'))
        @section('header')
                <header class="d-flex justify-content-evenly py-3">
                    <form class ="nav-form" action="{{route('review')}}" method="get">
                        @csrf
                        <button class="nav-link active" type="submit"  aria-selected="true">
                            New todo
                        </button>
                    </form>
                    <form class ="nav-form" action="{{route('profile')}}" method="get">
                        @csrf
                        <button class="nav-link" type="submit" aria-selected="true">
                            List
                        </button>
                    </form>
                    <form class ="nav-form" action="{{route('logout')}}" method="get">
                        @csrf
                        <button class="nav-link" data-bs-toggle="pill" type="submit"  aria-selected="true">
                            Logout
                        </button>
                    </form>
                </header>
        @show
    @endif
    @section('content')
    @show
</body>
</html>
