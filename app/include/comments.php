<?php
global $page;
include "app/controllers/commentaries.php";

?>
<div class="col-md-12 col-12 comments">
    <h3>Оставить комментарий</h3>
    <form action="<?php echo "single.php?post=$page";?>" method="post">
        <input name="page" value="<?php echo $page; ?>" type="hidden">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email адрес</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="@mail.ru">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Введите Ваш комментарий</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
        </div>
    </form>
    <?php if (count($comments) > 0): ?>
    <div class="row all-comments">
    <h3 class="col-12">Комментарии </h3>
    <?php foreach($comments as $comment): ?>
    <div class="one-comment col-12">
        <span class="fa-solid fa-envelope"> <?php echo $comment['email']?></span>
        <span class="fa-solid fa-calendar"> <?php echo $comment['created_date']?></span>
        <div class="col-12 text">
            <span><?php echo $comment['comment']?></span>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>