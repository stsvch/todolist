<?php
require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('C:\Users\USER\Desktop\4 сем\вт\todolist\new\resources\views\template');
$twig = new \Twig\Environment($loader);

// Передача данных в шаблон
$data = [
    'pageTitle' => 'Пример шаблонизатора Twig',
    'greeting' => 'Добро пожаловать!',
    'content' => 'Это пример использования Twig в PHP.',
];

// Отображение шаблона с переданными данными
echo $twig->render('tmp.twig', $data);

