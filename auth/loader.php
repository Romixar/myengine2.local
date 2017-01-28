<?php

$query = mysqli_query($conn, 'SELECT `text` FROM `history` WHERE `user_id` = '.$_SESSION['id'].' ORDER BY `id` DESC LIMIT '.$_SESSION['offset'].', 2');

if(!mysqli_num_rows($query)){
    
    if($_SESSION['offset'] == 0) exit('empty');
    else exit('end');

    exit;
}

$_SESSION['offset'] += 2; // смещение
while($row = mysqli_fetch_assoc($query)){
    
    echo '<p>'.$row['text'].'</p>';
    
}


?>