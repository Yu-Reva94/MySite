<?php
//контроллер
include_once SITE_ROOT . "/app/database/db.php";
$commentsForAdm = selectAll('comments');
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
        $user = selectOne('users', ['email' => $email]);
if( $user['email'] == $email && $user['admin'] == 1){

    $status = 1;
}
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
//удаление комментария
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id']; //считываем id
    delete('comments', $id);
    header('Location: ../../admin/comments/index.php');

}
//смена статуса
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) { //если прилетает метод GET
    $id = $_GET['pub_id']; //считываем id
    $publish = $_GET['publish'];
    update('comments', $id, ['status' => $publish]);
    header('Location:../../admin/comments/index.php');
}
//обновление комментария
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $comment = selectOne('comments', ['id' => $_GET['id']]); // получаем одну запись с помощью нашего id
    $id = $comment['id'];
    $email = $comment['email'];
    $content = $comment['comment'];
    $publish = $comment['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-comment'])) { //если сервер метод POST и в посте содержится
   var_dump($_POST);
    $id = $_POST['id'];
    $content = trim($_POST['content']);
    $publish = isset($_POST['publish']) ? 1 : 0; // если Publish есть в массиве, он будет равен 1 , если нет то 0


    if ($content === '') { // проверка не пустые ли поля
        array_push($errMsg, 'Поля комментарий не должно быть пустое!');
    } elseif (mb_strlen($content, 'UTF8') < 3) {
        array_push($errMsg, "Комментарий не может быть короче трех символов");
    } else {
        $com = [ // создается массив
            'comment' => $content,
            'status' => $publish,
        ];
        $com = update('comments', $id, $com);
        header('Location:index.php');
    }
}
