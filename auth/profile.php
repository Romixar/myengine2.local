<?php

top('Личные данные');

echo '<h2>Добро пожаловать - '.$_SESSION['email'].'!</h2>'; ?>

    <b>Редактировать профиль</b>
    <p><input type="text" id="password" placeholder="Новый пароль"></p>
    <p><button onclick="post_query('aform','edit','password')">Сохранить</button></p>



<?php
bottom();
?>