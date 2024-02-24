<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
<main class="form-signin w-100 m-auto">
    <form>
        <h1>Sign in</h1>

        <div class="form-floating">
            <input type="text" class="name" id="name" name ="name" placeholder="name">
            <label for="name">Name</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    </form>
    <form action="{{route('authorization')}}" method="get">
        @csrf
        <button class="btn btn-link rounded-pill px-3" type="submit">Create an account</button>
    </form>
</main>
</body>
</html>
