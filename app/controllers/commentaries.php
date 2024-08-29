<?php
//контроллер
$page = $_GET['post'];
$email = "";
$comment = '';
$errMsg = [];
$status = 0;
$comments = [];
//код для формы создания комментария
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) { //если в этом массиве есть add-post,

    $email = trim($_POST['email']); //trim Обрезает личные пробелы
    $comment = trim($_POST['comment']);


    if ($email === '' || $comment === '' ) { // проверка не пустые ли поля
        array_push($errMsg, 'Не все поля заполнены!');
    } elseif (mb_strlen($comment, 'UTF8') < 3) {
        array_push($errMsg, "Комментарий не может быть меньше 3 трех");
    } else {
        $comment = [ // создается массив
            'status' => $status,
            'page' => $page,
            'email' => $email,
            'comment' => $comment
        ];
        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['page' => $page, 'status' => 1]);

    }
} else {
    $email = " ";
    $comment = " ";
    $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}

