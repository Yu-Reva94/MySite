<?php
include SITE_ROOT . '/app/database/db.php';
$errMsg = [];
$users = selectAll('users');
function authUser($params)
{
    $_SESSION['id'] = $params['id'];
    $_SESSION['login'] = $params['username'];
    $_SESSION['admin'] = $params['admin'];
    if ($_SESSION['admin']) {
        header('Location: ' . 'admin/posts/index.php');
    } else {
        header('Location: ' . BASE_URL);
    }
}

$isSubmit = false;
// код для формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) { //если в этом массиве есть button-reg, значит клиент пришел с регистрации

    $admin = 0;
    $login = trim($_POST['login']); //trim Обрезает личные пробелы
    $email = trim($_POST['mail']);
    $pass = trim($_POST['password']);
    $repeatPass = trim($_POST['repeatPassword']);


    if ($login === '' || $email === '' || $pass === '' || $repeatPass === '') {
        array_push($errMsg, 'Не все поля заполнены!');
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        array_push($errMsg, "Логин не может быть короче двух символов");
    } elseif ($pass !== $repeatPass) {
        array_push($errMsg, "Пароль должны совпадать");
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence['email'] === $email) {
            array_push($errMsg, "Пользователь с такой почтой уже  зарегистрирован!");
        } else {
            $pass = password_hash($pass, PASSWORD_DEFAULT); //хешифурет пароль
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id]);
            authUser($user);

        }
    }
} else {
    $login = '';
    $email = '';
}
// код для формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
    $email = trim($_POST['mail']); //trim Обрезает личные пробелы
    $pass = trim($_POST['password']);
    if ($email === '' || $pass === '') {
        array_push($errMsg, "Не все поля заполнены");
    }else {
        $existence = selectOne('users', ['email' => $email]);
       if ($existence && password_verify($pass, $existence['password'])) {
           //авторизовать
           authUser($existence);
       }else{
           array_push($errMsg, "Неверно введен логин или пароль");
       }
    }
}else{
    $email = '';
}
// Код для создания пользователя через админку
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) { //если в этом массиве есть button-reg, значит клиент пришел с регистрации

    $admin = 0;
    $login = trim($_POST['login']); //trim Обрезает личные пробелы
    $email = trim($_POST['mail']);
    $pass = trim($_POST['password']);
    $repeatPass = trim($_POST['repeatPassword']);


    if ($login === '' || $email === '' || $pass === '' || $repeatPass === '') {
        array_push($errMsg, 'Не все поля заполнены!');
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        array_push($errMsg, "Логин не может быть короче двух символов");
    } elseif ($pass !== $repeatPass) {
        array_push($errMsg, "Пароль должны совпадать");
    } else {
        $existence = selectOne('users', ['email' => $email] || ['login' => $login]);
        if ($existence['email'] === $email || ['login' => $login]) {
            array_push($errMsg, "Пользователь с такой почтой или логином уже  зарегистрирован!");
        } else {
            $pass = password_hash($pass, PASSWORD_DEFAULT); //хешифурет пароль
            if (isset($_POST['admin'])) $admin = 1;
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id]);
            header('Location: /index.php');
            exit();
        }
    }
} else {
    $login = '';
    $email = '';
}
//код для редактирования пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $user = selectOne('users', ['id' => $_GET['id']]); // получаем одну запись с помощью нашего id

    $id = $user['id'];
    $admin = $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])) { //если сервер метод POST и в посте содержится

    $id = $_POST['id'];
    $email = trim($_POST['email']); //trim Обрезает личные пробелы
    $login = trim($_POST['login']);
    $pass = trim($_POST['password']);
    $repeatPass = trim($_POST['repeatPassword']);
    $admin = trim($_POST['admin']) ? 1 : 0;



    if ($login === '' ) { // проверка не пустые ли поля
        array_push($errMsg, 'Не все поля заполнены!');
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        array_push($errMsg, "Логин не может быть короче двух символов");
    }elseif ($pass !== $repeatPass) {
        array_push($errMsg, "Пароль должны совпадать");
    } else {
        $password = password_hash($pass, PASSWORD_DEFAULT); //хешифурет пароль
        if (isset($_POST['admin'])) $admin = 1;
        $user = [
            'admin' => $admin,
            'username' => $login,
            'password' => $pass
        ];

        $user = update('users', $id, $user);
        header('Location:index.php');
    }
}else{
   $login ='';
   $email = '';
}

// смена статуса
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) { //если прилетает метод GET
    $id = $_GET['pub_id']; //считываем id
    $publish = $_GET['publish'];
    $postId = update('posts', $id, ['status' => $publish]);
    header('Location:../../admin/posts/index.php');
}


// Удаление пользователя

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id']; //считываем id
    $user = delete('users', $id);
    header('Location:../../admin/users/index.php');
}
