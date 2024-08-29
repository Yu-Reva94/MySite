<?php
//подключение к базе данных
$driver = 'mysql'; // sql
$host = 'localhost'; //имя домена
$dbname = 'mysite'; //имя базы данных
$dbUser = 'root'; // логин к бд
$dbPass = ''; // пароль к бд
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]; // опции которые будем использовать при подключении к бд

try {
    $pdo = new PDO(
        "$driver:host=$host;dbname=$dbname", $dbUser, $dbPass, $options
    );
} catch (PDOException $i){
    die("Ошибка подключения к базе данных");
}
