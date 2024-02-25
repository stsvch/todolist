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
    <div class="container">
        <div class="form-block">
            <form  method="post" action="{{route('authorization_add')}}">
                @csrf
                <div class="frm">
                    <h1>Create an account</h1>
                    <div class="inpt">
                        <input type="text" class="name" id="name" name ="name" placeholder="name">
                    </div>
                    <div class="inpt">
                        <input type="email" class="email" id="email" name ="email" placeholder="email">
                    </div>
                    <div class="inpt">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <button class="btn-create" type="submit">Create</button>
            </form>
        </div>
    </div>
</body>
</html>
