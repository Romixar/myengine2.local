<?php
top('Отзывы');


?>


<h1>Отзывы</h1>
<p><button onclick="bbcode('url')">Ссылка</button><button onclick="bbcode('audio')">Аудио</button><button onclick="bbcode('video')">Видео</button></p>

<p><textarea id="mes" cols="30" rows="10" placeholder="Текст сообщения"></textarea></p>

<p><button onclick="post_query('add','reviews','mes')">Добавить</button></p>

<p>Список моих отзывов:</p>

<?php
    $query = mysqli_query($conn, 'SELECT `text`, `user_id` FROM `reviews` ORDER BY `id` DESC');
    
    if(!mysqli_num_rows($query)) $str = '<p>Список пуст...</p>';
    else{
        $str = '<ul>';
        while($row = mysqli_fetch_assoc($query)){
            
            $emails = mysqli_query($conn, 'SELECT `email` FROM `user` WHERE `id` = '.$row['user_id']);
            $email = mysqli_fetch_assoc($emails);
            
            $str .= '<li>
                <p> - <span>'.$email['email'].'</span> - </p>
                <p>'.bbcode(nl2br($row['text'],false)).'</p></li>';// заменяю разрешённые теги
        }
        $str .= '</ul>';
    }
    
    
    echo $str;

?>




<?php

bottom();
?>