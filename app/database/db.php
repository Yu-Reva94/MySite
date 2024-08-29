<?php
session_start();
global $pdo;
require 'connect.php';


function dbCheckError($query)
{
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
}
function tt($arr) {
    echo '<prev>';
    print_r($arr);
    echo '</prev>';
    exit();
}
//Запрос на получение данных с одной таблицы
function selectAll($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    $values = [];

    if (!empty($params)) {
        $conditions = [];
        foreach ($params as $key => $value) {
            $conditions[] = "$key = :$key";
            $values[":$key"] = $value;
        }
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $query = $pdo->prepare($sql);
    if (!$query) {
        throw new Exception("Cannot prepare query: " . $pdo->errorInfo());
    }

    if (!$query->execute($values)) {
        dbCheckError($query);
    }

    return $query->fetchAll();
}

//запрос на получение одной строки с выбранной таблицы
function selectOne($table, $params)
{
    global $pdo;
    $sql = "SELECT * FROM $table ";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . "WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    $sql = $sql . " LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

//Запись в таблицу БД
function insert($table, $params)
{
    //объявляем глобальную переменную
    global $pdo;
    // запрос на добавление данных в таблицу
    $i = 0;
    $coll = ''; //столбцы
    $mask = ''; //значения
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)"; //строка , которая хрнаит в себе строку для запроса в бд

    // Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
    $query = $pdo->prepare($sql);
    // Запускает подготовленный запрос на выполнение
    $query->execute();
    dbCheckError($query);
    return $pdo->lastInsertId(); //возвращаем id после отправки данных в бд
}

// insert('users', $arrData);
//Обновление данных строки в таблице
function update($table, $id, $params)
{
    //объявляем глобальную переменную
    global $pdo;
    // запрос на добавление данных в таблицу
    $i = 0;
    $str = ''; //строка запроса, куда собираем обновленную строку
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . "$value" . "'";
        } else {
            $str = $str . ", $key" . " = '" . "$value" . "'";
        }
        $i++;
    }
// UPDATE `users` SET 'username' = 'Antonik', 'password' = 628859 WHERE 'id' = 39;
    $sql = "UPDATE $table SET $str WHERE id =$id"; //строка , которая хрнаит в себе строку для запроса в бд
    // Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
    $query = $pdo->prepare($sql);
    // Запускает подготовленный запрос на выполнение
    $query->execute();
    dbCheckError($query);
}

//Функция удаления строки
function delete($table, $id)
{
    //объявляем глобальную переменную
    global $pdo;

    $sql = "DELETE FROM $table WHERE id =" . $id; //строка , которая хрнаит в себе строку для запроса в бд
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

// Выборка записей (posts) с автором в админку
function selectAffFromPostsWithUsers($table1, $table2)
{
    global $pdo;
    $sql = "SELECT t1.id, t1.title, t1.img, t1.content, t1.status, t1.id_topic, t1.created_date, t2.username 
FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//Вывод автора на главную страницу
function selectAffFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset)
{
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status = 1 LIMIT $limit OFFSET $offset";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

function selectTopicsFromPosts($table)
{
    global $pdo;
    $sql = "SELECT * FROM $table WHERE id_topic = 58";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//Поиск по заголовкам и содержимому
function searchInTitleAndContent($term, $table1, $table2)
{
    $term = trim(strip_tags(stripcslashes(htmlspecialchars($term))));
    global $pdo;
    $sql = "SELECT p.*, u.username 
FROM $table1 AS p 
JOIN $table2 AS u 
ON p.id_user = u.id 
WHERE p.status = 1
AND p.title LIKE '%$term%' OR p.content LIKE '%$term%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//выбор одной записи с автором для сингл страницы
function selectOnePostFromPost($table1, $table2, $id)
{
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

function countRow($table)
{
    global $pdo;
    $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchColumn();
}