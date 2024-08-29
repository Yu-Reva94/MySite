<?php
include SITE_ROOT . '/app/database/db.php';

$errMsg = [];
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';
$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAffFromPostsWithUsers('posts', 'users');

//Код для формы создания записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-post'])) { //если в этом массиве есть add-post,

    if (!empty($_FILES['img']['name'])) {

        $imgName = time() . $_FILES['img']['name']; // time добавляет время к названию изображения
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $imgSize = $_FILES["img"]["size"];
        $destination = ROOT_PATH . "\images\posts\\" . $imgName;
        if (strpos($fileType, 'image') === false || $imgSize > 2120000) {
            array_push($errMsg, "Можно загружать только изображения, либо размер файла превышает допустимый");
        } else {
            $result = move_uploaded_file($fileTmpName, $destination);
            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                array_push($errMsg, "Ошибка загружки изображения");
            }
        }
    } else {
        array_push($errMsg, "Ошибка получения изображения");
    }

    $title = trim($_POST['title']); //trim Обрезает личные пробелы
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = $_POST['publish'];

    $publish = isset($_POST['publish']) ? 1 : 0; // если Publish есть в массиве, он будет равен 1 , если нет то 0
    if ($title === '' || $content === '' || $topic === 'Выбрать категорию:') { // проверка не пустые ли поля
        array_push($errMsg, 'Не все поля заполнены!');
    } elseif (mb_strlen($title, 'UTF8') < 2) {
        array_push($errMsg, "Название категории не может быть короче двух символов");
    } else {
        $post = [ // создается массив
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
        ];
        $post = insert('posts', $post);
        $post = selectOne('posts', ['id' => $id]);
        header('Location:index.php');
    }
} else {
    $id = '';
    $title = '';
    $content = '';
    $publish = '';
    $topic = '';
}


//Редактирование записи
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $id = $_GET['id']; //считываем id
    $post = selectOne('posts', ['id' => $id]); // получаем одну запись с помощью нашего id
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];
    $publish = $post['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-post'])) { //если сервер метод POST и в посте содержится

    $id = $_POST['id'];
    $title = trim($_POST['title']); //trim Обрезает личные пробелы
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);

    $publish = isset($_POST['publish']) ? 1 : 0; // если Publish есть в массиве, он будет равен 1 , если нет то 0

    if (!empty($_FILES['img']['name'])) {

        $imgName = time() . $_FILES['img']['name']; // time добавляет время к названию изображения
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $imgSize = $_FILES["img"]["size"];
        $destination = ROOT_PATH . "\images\posts\\" . $imgName;
        if (strpos($fileType, 'image') === false || $imgSize > 21200000) {
            array_push($errMsg, "Можно загружать только изображения, либо размер файла превышает допустимый");
        } else {
            $result = move_uploaded_file($fileTmpName, $destination);
            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                array_push($errMsg, "Ошибка загружки изображения");
            }
        }
    } else {
        array_push($errMsg, "Ошибка получения изображения");
    }

    if ($title === '' || $content === '' || $topic === 'Выбрать категорию:') { // проверка не пустые ли поля
        array_push($errMsg, 'Не все поля заполнены!');
    } elseif (mb_strlen($title, 'UTF8') < 2) {
        array_push($errMsg, "Название категории не может быть короче двух символов");
    } else {
        $post = [ // создается массив
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
        ];

        $post = update('posts', $id, $post);
        header('Location:index.php');
    }
}else{
        $publish = isset($_POST['publish']) ? 1 : 0;
    }

// смена статуса
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) { //если прилетает метод GET
        $id = $_GET['pub_id']; //считываем id
        $publish = $_GET['publish'];
        $postId = update('posts', $id, ['status' => $publish]);
        header('Location:../../admin/posts/index.php');
}
//удаление записи

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id']; //считываем id
    $topic = delete('posts', $id);
    header('Location:../../admin/posts/index.php');

}