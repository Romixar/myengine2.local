<?php

if(!$_SESSION['confirm']['code']) notFound();

top('Подтверждение');


?>



<h1>Подтверждение регистрации</h1>
<p><input type="text" id="code" placeholder="Код подтверждения"></p>
<p><button onclick="post_query('gform','confirm','code.captcha')">Подтвердить</button></p>






<?php

bottom();
?>