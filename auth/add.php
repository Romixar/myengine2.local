<?php

if(isset($_POST['reviews_f'])){
    
    if(strlen($_POST['mes']) < 10 || strlen($_POST['mes']) > 500) message('Длина текста должна быть от 10 до 500 символов!');
    
    mysqli_query($conn, "INSERT INTO `reviews` VALUES ('', '".$_SESSION['id']."', '".mysqli_real_escape_string($conn,htmlspecialchars($_POST['mes']))."')");
    
    go('reviews');
}





?>