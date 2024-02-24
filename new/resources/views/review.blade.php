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
    <form method="post" action="{{route('review_check')}}">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Add</h1>

        <div class="form-floating">
            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
            <label for="date">Date</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="title" name="title" placeholder="ToDo">
            <label for="title">To do</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Add</button>
    </form>
</main>
</body>
</html>
