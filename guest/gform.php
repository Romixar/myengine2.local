<?php

if(isset($_POST['login_f'])){
    
    captcha_valid();
    //go('register');
    
}

if(isset($_POST['register_f'])){
    
    email_valid();
    pass_valid();
    //captcha_valid();
    
    $query = mysqli_query($conn,"SELECT `id` FROM `user` WHERE `email` = '".$_POST['email']."'");

    if(mysqli_num_rows($query)) message('Такой email уже существует!');
        
    $code = rand_str(5);// для отправки польз-лю для подтверждения регистрации
        
    $_SESSION['confirm'] = [
            
        'type' => 'register',
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'code' => $code,
            
    ];
        
    mail($_POST['email'],'Подтверждение регистрации',"Вставьте на сайте данный код: $code");
    go('confirm');// редирект на страницу подтверждения

    
}

if(isset($_POST['recovery_f'])){
    
    message('Восстановление пароля');
    
    
}

if(isset($_POST['confirm_f'])){
    
    if($_SESSION['confirm']['type'] == 'register'){

        if($_SESSION['confirm']['code'] != $_POST['code']) message('Код потверждения указан не верно!');
        
        mysqli_query($conn,"INSERT INTO `user` VALUES ('', '', '".$_SESSION['confirm']['email']."', '".$_SESSION['confirm']['password']."')");
        
        unset($_SESSION['confirm']);
        go('login');
        
    }else notFound();
    
    
}















?>