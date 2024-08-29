<?php
// если количество элементов в массиве больше 0, выводим ошибку
if (count($errMsg) > 0):?>
    <ul>
        <?php foreach ($errMsg as $err): ?>
            <li><?php echo $err; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
