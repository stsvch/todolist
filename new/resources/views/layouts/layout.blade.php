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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    @endsection
    @yield('head')
</head>
<body>
        @section('header')
            @if(Session::get('user'))
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
                            Calendar
                        </button>
                    </form>
                    <form class ="nav-form" action="{{route('calendar','all')}}" method="get">
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
            @elseif(Session::get('admin'))
                <header class="d-flex justify-content-evenly py-3">
                    <form class ="nav-form" action="{{route('calendar','all tasks')}}" method="get">
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
            @endif
        @show
    @section('content')
    @show
</body>
</html>
