<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Home</title>
</head>
<body>
@if(session('error'))
    <p>{{ session('error') }}</p>
@endif
    <div class="container">
        <div class="form-block">
            <form action="{{route('signin')}}" method="post">
                @csrf
                <div class="frm">
                    <h1>Login</h1>
                    <div class="inpt">
                        <input type="text" class="name" id="name" name ="name" placeholder="name">
                    </div>
                    <div class="inpt">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button class="btn-login" type="submit">login</button>
                </div>
            </form>
        </div>
        <form action="{{route('authorization')}}" method="get">
            @csrf
            <button class="btn btn-link rounded-pill px-3" type="submit">Create an account</button>
        </form>
    </div>
</body>
</html>
