<?php
include SITE_ROOT . "/app/controllers/commentaries.php"
?>
<div class="col-md-12 col-12 comments">
    <h3>Оставить комментарий</h3>
    <form action="<?php echo "single.php?post=$page"?> method="post">
        <input name="page" value="<?php echo $page; ?>" type="hidden">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email адрес</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Введите Ваш комментарий</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
        </div>
    </form>
<h3>Комментарии к записи</h3>
    Вывод через foreach комментов
</div>