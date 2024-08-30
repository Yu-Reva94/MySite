<?php
include SITE_ROOT . '/app/database/db.php';

$errMsg = [];
$id = '';
$name = '';
$description = '';
$topics = selectAll('topics');


//Код для создания категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])) { //если в этом массиве есть button-reg, значит клиент пришел с регистрации
    $name = trim($_POST['name']); //trim Обрезает личные пробелы
    $description = trim($_POST['description']);


    if ($name === '' || $description === '') { // проверка не пустые ли поля
        array_push($errMsg, 'Не все поля заполнены!');
    } elseif (mb_strlen($name, 'UTF8') < 2) {
        array_push($errMsg, "Название категории не может быть короче двух символов");
    } else {
        $existence = selectOne('topics', ['name' => $name]);
        if ($existence['name'] === $name) {
            array_push($errMsg,"Категория с таким именем уже существует!");
        } else {
            $topic = [ // создается массив
                'name' => $name,
                'description' => $description,
            ];
            $id = insert('topics', $topic);
            $topic = selectOne('topics', ['id' => $id]);
            header('Location:index.php');

        }
    }
} else {
// массив с данными из инпута для добавления в бд

    //
    //   $lastRow = selectOne('users', ['id' => $id]);

    $name = '';
    $description = '';
}


//Редактирование категории

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id']; //считываем id
    $topic = selectOne('topics', ['id' => $id]); // получаем одну запись
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) { //если в этом массиве есть button-reg, значит клиент пришел с регистрации

    $name = trim($_POST['name']); //trim Обрезает личные пробелы
    $description = trim($_POST['description']);


    if ($name === '' || $description === '') { // проверка не пустые ли поля
        array_push($errMsg,'Не все поля заполнены!');
    } elseif (mb_strlen($name, 'UTF8') < 2) {
        array_push($errMsg,"Название категории не может быть короче двух символов");
    } else {
        $topic = [ // создается массив
            'name' => $name,
            'description' => $description,
        ];
        $id = $_POST['id'];
        $topic_id = update('topics', $id, $topic);
        header('Location:index.php');
    }
}

//удаление категории

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id']; //считываем id
    $topic = delete('topics', $id);
    header('Location:../../admin/topics/index.php');

}
