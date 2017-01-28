<?php


top('Рефералы');


?>



<h1>Рефералы</h1>
<p>Пользователи, которые зарегистрировались по Вашей ссылке</p>
<p>Ваша реферальная ссылка: <b>http://myengine2.local/?ref=<?= $_SESSION['id'] ?></b></p>

<br/>
<br/>
<p>Список моих рефералов:</p>

<?php
    $query = mysqli_query($conn, 'SELECT `email` FROM `user` WHERE `ref` = '.$_SESSION['id']);
    
    if(!mysqli_num_rows($query)) $str = '<p>Список пуст...</p>';
    else{
        $str = '<ul>';
        while($row = mysqli_fetch_assoc($query)){    
            $str .= '<li><p>'.$row['email'].'</p></li>';
        }
        $str .= '</ul>';
    }
    
    
    echo $str;

?>




<?php

bottom();          
          
?>