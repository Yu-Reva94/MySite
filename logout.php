<?php
session_start();
include ('path.php');

unset($_SESSION['id']); // удаляем переменную
unset($_SESSION['login']);
unset($_SESSION['admin']);

header('Location: ' . BASE_URL);