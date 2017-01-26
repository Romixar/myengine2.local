<?php

if(!$_SESSION['confirm']['code']) notFoud();

top('Подтверждение');


?>



<h1>Подтверждение регистрации</h1>
<p><input type="text" id="code" placeholder="Код"></p>
<p><input type="text" id="captcha" placeholder="<? captcha_show() ?>"></p>
<p><button onclick="post_query('gform','confirm','code.captcha')">Подтвердить</button></p>






<?php

bottom();
?>