<?php


top('Обратная связь');


?>



<h1>Обратная связь</h1>
<p><input type="email" id="email" value="<?= $_SESSION['email'] ?>" placeholder="Email" /></p>
<p><textarea id="mes" cols="30" rows="10" placeholder="Текст сообщения"></textarea></p>
<p><input type="text" id="captcha" placeholder="<? captcha_show() ?>"/></p>
<p><button onclick="post_query('mail','contact','email.mes.captcha')">Отправить</button></p>





<?php

bottom();
          
          
?>