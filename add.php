<?php
    $task =$_POST['task'];
    if($task == '')
    {
        echo 'erro!!!';
        exit();
    }

    $dsn ='mysql:host=localhost;dbname=todo';
    $pdo=new PDO($dsn, 'root', 'root');

    $sql='INSERT INTO tasks(task) VALUES(:task)';
    $query=$pdo->prepare($sql);
    $query->execute(['task'=>$task]);

    header('Location: /');
?>
