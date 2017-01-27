<?php

if(isset($_POST['login_f'])){// страница логинизации
    
    captcha_valid();
    email_valid();
    pass_valid();
    
    $query = mysqli_query($conn,"SELECT `id` FROM `user` WHERE `email` = '".$_POST['email']."' AND `password` = '".$_POST['password']."'");

    if(!mysqli_num_rows($query)) message('Не верный логин/пароль!');
    
    $query = mysqli_query($conn,"SELECT * FROM `user` WHERE `email` = '".$_POST['email']."'");
    
    $row = mysqli_fetch_assoc($query);
    
    if($row['ip']){
        
        $arr = explode(',',$row['ip']);
        
        if(!in_array($_SERVER['REMOTE_ADDR'],$arr)) message('С вашего ip доступ запрещён!');
        
        
    }
    
    
    
    
    foreach($row as $k => $v) $_SESSION[$k] = $v;
    
    go('profile');
    
    
}

if(isset($_POST['register_f'])){// страница регистрации
    
    captcha_valid();
    email_valid();
    pass_valid();
    
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

if(isset($_POST['recovery_f'])){// страница восстановление пароля
    
    captcha_valid();
    email_valid();
    
    $query = mysqli_query($conn,"SELECT `id` FROM `user` WHERE `email` = '".$_POST['email']."'");

    if(!mysqli_num_rows($query)) message('Такой e-mail у нас не зарегистрирован!');
    
    $code = rand_str(5);// для отправки польз-лю для подтверждения восстановления пароля
        
    $_SESSION['confirm'] = [
            
        'type' => 'recovery',
        'email' => $_POST['email'],
        'code' => $code,
            
    ];
        
    mail($_POST['email'],'Восстановление пароля',"Для восстановления пароля вставьте на сайте данный код: $code");
    go('confirm');// редирект на страницу подтверждения
    
    
    
    
}

if(isset($_POST['confirm_f'])){// страница подтверждение регистрации или восстановление пароля
    
    if($_SESSION['confirm']['type'] == 'register'){

        if($_SESSION['confirm']['code'] != $_POST['code']) message('Код потверждения указан не верно!');
        
        mysqli_query($conn,"INSERT INTO `user` VALUES ('', '', '".$_SESSION['confirm']['email']."', '".$_SESSION['confirm']['password']."', '')");
        
        unset($_SESSION['confirm']);
        go('login');
        
    }elseif($_SESSION['confirm']['type'] == 'recovery'){

        if($_SESSION['confirm']['code'] != $_POST['code']) message('Код потверждения указан не верно!');
        
        $newpass = rand_str(10);
        
        mysqli_query($conn,"UPDATE `user` SET `password` = '".md5($newpass)."' WHERE `email` = '".$_SESSION['confirm']['email']."'");
        
        mail($_SESSION['confirm']['email'],'Новый пароль','Ваш новый пароль: '.$newpass);
        
        unset($_SESSION['confirm']);
        
        message('Новый пароль отправлен на Ваш email');
        
    }
    
    
}















?>