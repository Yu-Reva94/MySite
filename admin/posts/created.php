<?php
include "../../path.php";
include "../../app/controllers/posts.php"
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d4b56dc8d3.js" crossorigin="anonymous"></script>
    <title>Мой сайт</title>
</head>
<body>
<!-- header -->
<?php
include('../../app/include/header-admin.php');
?>
<div class="container">
    <?php
    include('../../app/include/sidebar-admin.php');
    ?>
    <div class="col-1"></div>
    <div class="posts col-8">
        <div class="row title-table">
            <h2>Добавление записи</h2>
            <div class="mb-12 col-12 col-mb12 err">
                <!-- Вывод массива с ошибками -->
                <p><?php include "../../app/helps/errorInfo.php" ?></p>
            </div>
        </div>
        <div class="row add-post">
            <form action="created.php" method="post" enctype="multipart/form-data">
                <!-- enctype необходимо чтобы подгружать файлы-->
                <div class="col">
                    <input value="<?php echo $title; ?>" name="title" type="text" class="form-control" placeholder="Заголовок"
                           aria-label="Название статьи">
                </div>
                <div class="col">
                    <label for="editor" class="form-label">Содержимое записи</label>
                    <textarea value="<?php echo $content; ?>" name='content' class="form-control" id="content" rows="6"></textarea>
                </div>
                <div class="input-group col">
                    <input name="img" type="file" class="form-control id='inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
                <select name="topic" class="form-select" aria-label="Default select example">
                    <option selected>Выбрать категорию:</option>
                    <?php foreach ($topics as $key => $topic): ?>
                        <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="col col-6">
                    <input name="publish" type="checkbox" name="publish" values="1" checked>
                    <label>Опубликовать</label>
                </div>
                <div class="col col-6">
                    <button name="add-post" class="btn btn-primary" type="submit">Добавить запись</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
