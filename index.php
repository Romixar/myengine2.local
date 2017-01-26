<?php

if($_SERVER['REQUEST_URI'] == '/') $page = 'home';
else{
    $page = substr($_SERVER['REQUEST_URI'], 1);// получаю без первого слэша адр строку
    
    if(!preg_match('/^[A-z0-9]{3,15}$/', $page)){// проверка от мусора в URL
        notFound();
    }
}


$conn = mysqli_connect('localhost','root','','myengine2');

if(!$conn) exit('Ошибка подключения к БД!');




session_start();

//exit(print_r($_SESSION));


// проверка сессии и подключение файлов для авторизов-х, гостей, и общей для всех
if(file_exists('all/'.$page.'.php')) include 'all/'.$page.'.php';

elseif(($_SESSION['ulogin'] == 1) && file_exists('auth/'.$page.'.php')) include 'auth/'.$page.'.php';

elseif(($_SESSION['ulogin'] != 1) && file_exists('guest/'.$page.'.php')) include 'guest/'.$page.'.php';

else exit('Страница 404');






function message($text){

    exit('{"message" : "'.$text.'"}');
    
}
function go($url){// редирект
    exit('{"go" : "'.$url.'"}');   
}
function notFound(){
    exit('Страница не найдена...');
}


function rand_str($len=30){// получаю случайную строку символов
    $str = '1234567890QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuioplkjhgfdsazxcvbnm-_';
    return substr(str_shuffle($str),0,$len);
}

function captcha_show(){
    
    $questions = [
        1 => 'Столица России?',
        2 => 'Мультик с волком и заяцем?',
        3 => 'Имя терминатора?',
        4 => 'Пять плюс пять?',
        5 => 'Имя президента России?',
        6 => 'Сколько месяцев в году?',
        7 => 'Какой месяц 28 дней?',
        8 => 'Сколько дней в неделе?',
        9 => 'Первый цвет радуги?',
        10 => 'Имя отца Александра Пушкина?'
    ];
    
    $num = mt_rand(1,count($questions));
    $_SESSION['captcha'] = $num;
    echo $questions[$num];
    
    
}

function captcha_valid(){
    
    $answers = [
        1 => 'москва',
        2 => 'ну погоди',
        3 => 'арнольд',
        4 => 'десять?',
        5 => 'владимир?',
        6 => 'двеннадцать',
        7 => 'февраль',
        8 => 'семь',
        9 => 'красный',
        10 => 'сергей'
    ];
    
    // поиск номера ключа по значению
    $num_answer = array_search(strtolower($_POST['captcha']),$answers);
    
    
    if($_SESSION['captcha'] != $num_answer){
        
        message('Ответ на вопрос не верный!');
        
    }else message('Всё ок!');
        
    
}

function email_valid(){
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        message('E-mail указан не верно!');
    }
}

function pass_valid(){
    if(!preg_match('/^[A-z0-9-_]{7,15}$/', $_POST['password'])) message('Пароль указан не верно!');
    else $_POST['password'] = md5($_POST['password']);
}



function top($title){
    
    echo '<!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>'.$title.'</title>
    <link rel="stylesheet" href="/style.css">
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="/script.js"></script>
    </head>
    
    <body>
    
    <div class="wrapper">
    
    <div class="menu">
    
    <a href="/">Главная</a>
    <a href="/login">Вход</a>
    <a href="/register">Регистрация</a>
    
    </div>
    
    <div class="content">
    <div class="block">';
}

function bottom(){
    
    echo '</div>
    </body>
    </html>';
}


?>