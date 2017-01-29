<?php
$handle = @fopen("ban.txt", "r");
if($handle){
    while(($buffer = fgets($handle, 4096)) !== false){
        if(trim($buffer) === $_SERVER['REMOTE_ADDR']) exit('Доступ к сайту с вашего IP запрещён!');
    }
    if(!feof($handle)){
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

if(is_numeric($_GET['ref']) && $_GET['ref'] > 0 && (strpos($_GET['ref'],'.') === false)){
    
    setcookie('ref',$_GET['ref'],strtotime('+1 week'));
    header('location: /home');
    
}


if($_SERVER['REQUEST_URI'] == '/') $page = 'home';
else{
    $page = substr($_SERVER['REQUEST_URI'], 1);// получаю без первого слэша адр строку
    
    if(!preg_match('/^[A-z0-9\.]{3,15}$/', $page)){// проверка от мусора в URL
        notFound();
    }
}


$conn = mysqli_connect('localhost','root','','myengine2');

if(!$conn) exit('Ошибка подключения к БД!');


session_start();

//unset($_SESSION);
//print_r($_SESSION);
//exit(print_r($_SESSION));
//if(file_exists($page.'.php'))


// проверка сессии и подключение файлов для авторизов-х, гостей, и общей для всех
if(file_exists('all/'.$page.'.php')) include 'all/'.$page.'.php';

elseif($_SESSION['id'] && file_exists('auth/'.$page.'.php')) include 'auth/'.$page.'.php';

elseif(!$_SESSION['id'] && file_exists('guest/'.$page.'.php')) include 'guest/'.$page.'.php';

elseif($_SESSION['admin'] && file_exists('admin/'.$page.'.php')) include 'admin/'.$page.'.php';

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

function bbcode($text){
    
    $search = [// что ищем в тектсе
        '[b]',
        '[/b]',
        '[i]',
        '[/i]',
        '[url=',
        '*name=',
        '[/url]',
        '[audio]',
        '[/audio]',
        '[video]',
        '[/video]',
        
        
        
        //'[url=http://mysite.ru*name=Тело ссылки[/url]',
    ];
    
    $repl = [//на что заменим
        '<b>',
        '</b>',
        '<i>',
        '</i>',
        '<a href="',
        '">',
        '</a>',
        '<audio src="',
        '" controls ></audio>',
        '<video width="400" height="300" src="',
        '" controls ></video>',
        
        
//        '<a href="http://mysite.ru]Тело ссылки[/url]',
    ];
    
    
    
    return str_replace($search,$repl,$text);
}


function rand_str($len=30){// получаю случайную строку символов
    $str = '1234567890QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuioplkjhgfdsazxcvbnm-_';
    return substr(str_shuffle($str),0,$len);
}

function captcha_show(){
    
    $questions = [
        1 => 'Столица России?',
        2 => 'Мультик с волком и заяцем?',
        3 => 'Имя терминатора в жизни?',
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

function servicesPrice($id){
    $arr = [
        1 => 100,
        2 => 250,
        3 => 450,
    ];
    
    return $arr[$id];
}

function getDiscount($code){
    $arr = [
        'AAA' => 10,
        'GGG' => 50,
    ];
    
    return $arr[$code];
}

function captcha_valid(){
    
    $answers = [
        1 => 'москва',
        2 => 'ну погоди',
        3 => 'арнольд',
        4 => 'десять',
        5 => 'владимир',
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
        
    }
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


function sendMail($email,$title,$text){
    mail($email,$title,
        '<!DOCTYPE html>
        <html>
        <head>
        <title>'.$title.'</title>
        </head>
        <body style="margin:0px;">
        <div style="padding:0px;font-size:18px;font-family:Arial sans-serif;font-weight:bold;text-align:center;background:#FCFCDF;">
           <div style="background:#464E78;margin:0;padding:25px;color:#fff;">
               Тема письма: '.$title.'
           </div>
           <div style="padding:30px;">
               <div style="background:#FFF;border-radius:10px;padding:25px;border:1px solid #EEEFF2">'.$text.'</div>
           </div>
        </div>
        </body>
        </html>','From: admin@zolushka18.ru'."\r\n".'MIME-Version 1.0'."\r\n".'Content-type: text/html; charset=UTF-8');
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
    <a href="/contact">Обратная связь</a>';
    
    if($_SESSION['id']){
        echo '<a href="/profile">Профайл</a>
              <a href="/reviews">Отзывы</a>
              <a href="/history">История</a>
              <a href="/referral">Рефералы</a>
              <a href="/services">Наши услуги</a>
              <a href="/logout">Выход</a>';
    }else{
        echo '<a href="/">Главная</a>
              <a href="/login">Вход</a>
              <a href="/register">Регистрация</a>';
    }
    
    echo '</div>
    <div class="content">
    <div class="block">';
}

function bottom(){
    
    echo '</div>
    </body>
    </html>';
}


?>