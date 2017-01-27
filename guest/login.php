<?php
top('Вход');


?>


<h1>Вход</h1>
<p><input type="email" id="email" placeholder="Email"></p>
<p><input type="password" id="password" placeholder="Пароль"></p>
<p><input type="text" id="captcha" placeholder="<? captcha_show() ?>"></p>
<p><button onclick="post_query('gform','login','email.password.captcha')">Вход</button><button onclick="go('recovery')">Восстановить пароль</button></p>






<?php

bottom();
?>