<?php


if(isset($_POST['contact_f'])){

    email_valid();
    captcha_valid();
    
    if(strlen($_POST['mes']) < 10 || strlen($_POST['mes']) > 500) message('Длина текста должна быть от 10 до 500 символов!');
    
    mail('admin@zolushka18.ru','Обращение с сайта','E-mail отпрваителя: '.$_POST['email'].'\n\n
    Текст обращения: '.htmlspecialchars($_POST['mes']));
    
    message('Сообщение отправлено!');
}











?>