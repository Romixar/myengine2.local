<?php

if(isset($_POST['login_f'])){
    
    captcha_valid();
    
    if($_POST['password'] !== '12345' || $_SERVER['REMOTE_ADDR'] !== '127.0.0.1') message('В доступе отказано!');
    
    $_SESSION['admin'] = 1;
    
    go('a.home');
}

?>