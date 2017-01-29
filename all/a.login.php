<?php
top('Вход в админ-панель');


?>


<h1>Вход в админ-панель</h1>

<p><input type="password" id="password" placeholder="Пароль"></p>
<p><input type="text" id="captcha" placeholder="<? captcha_show() ?>"></p>
<p><button onclick="post_query('a.auth','login','password.captcha')">Вход</button></p>






<?php

bottom();
?>