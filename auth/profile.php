<?php

top('Личные данные');

echo '<h2>Добро пожаловать - '.$_SESSION['email'].'!</h2>'; ?>

    <b>Редактировать профиль</b>
    <p><input type="password" id="password" placeholder="Новый пароль"></p>
    <p><input type="text" id="ip" placeholder="Список разрешённых IP" value="<?= $_SESSION['ip'] ?>"></p>
    <p><button onclick="post_query('aform','edit','password.ip')">Сохранить</button></p>



<?php
bottom();
?>