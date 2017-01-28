<?php

top('Личные данные');

echo '<h2>Добро пожаловать - '.$_SESSION['email'].'!</h2>'; ?>
   <br/>
   <h3>Ваш баланс: <?= $_SESSION['balance'] ?> руб.</h3>
   <br/>
   <br/>
    <b>Редактировать профиль</b>
    <p><input type="password" id="password" placeholder="Новый пароль"></p>
    <p><input type="text" id="ip" placeholder="Список разрешённых IP" value="<?= $_SESSION['ip'] ?>"></p>
    <p>Дополнительное подтверждение входа по E-mail:</p>
    <p><select id="protected">
        <?php $str = '<option value="0">Выкл.</option>
            <option value="1">Вкл.</option>';?>   
           
        <?= str_replace('"'.$_SESSION['protected'].'"','"'.$_SESSION['protected'].'"'.' selected',$str) ?>    
        </select></p>
    <p><button onclick="post_query('aform','edit','password.ip.protected')">Сохранить</button></p>



<?php
bottom();
?>