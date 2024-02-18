<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name ="viewport" content = "width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TO DO LIST</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="contaier">
        <h1>LIST</h1>
        <form action="/add.php" method="post">
            <input type="text" name="task" id="task" placeholder="need to do" class="form-control">
            <button type="submit" name = "sendTask" class="btn btn-dark btn-lg"> Send</button>
        </form>
    </div>
</body>
</html>