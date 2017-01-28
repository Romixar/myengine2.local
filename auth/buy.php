<?php


if(isset($_POST['services_f'])){
    
    $serv_id = array_pop($_POST);
    
    $price = servicesPrice($serv_id);
    
    if(!$price) message('Ошибка! Услуга не может быть куплена!');
    
    // если цена с учетом скидки
    if(isset($_SESSION['disc'])) $price = $price * (1 - ($_SESSION['disc'] / 100));
    
    if($price > $_SESSION['balance']) message('У вас недостаточно средств!');
    
    $_SESSION['balance'] -= $price;
    
    mysqli_query($conn,"UPDATE `user` SET `balance` = '".$_SESSION['balance']."' WHERE `id` = '".$_SESSION['id']."'");
    
    mysqli_query($conn,"INSERT INTO `history` VALUES ('', '".$_SESSION['id']."', 'Покупка услуги №".$serv_id."')");
    
    go('history');
    
    
}
if(isset($_POST['promo_f'])){
    
    $disc = getDiscount($_POST['code']);
    
    if(!$disc) message('Промокод указан неверно!');
    
    $_SESSION['disc'] = getDiscount($_POST['code']);
    
    //message('Получена скидка в '.getDiscount($_POST['code']).'%');
    
    go('services');
    
}

?>