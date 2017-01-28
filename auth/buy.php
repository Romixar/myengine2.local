<?php


if(isset($_POST['services_f'])){
    
    $serv_id = array_pop($_POST);
    
    $price = servicesPrice($serv_id);
    
    if(!$price) message('Ошибка! Услуга не может быть куплена!');
    
    if($price > $_SESSION['balance']) message('У вас недостаточно средств!');
    
    $_SESSION['balance'] -= $price;
    
    mysqli_query($conn,"UPDATE `user` SET `balance` = '".$_SESSION['balance']."' WHERE `id` = '".$_SESSION['id']."'");
    
    mysqli_query($conn,"INSERT INTO `history` VALUES ('', '".$_SESSION['id']."', 'Покупка услуги №".$serv_id."')");
    
    
    
    
    go('history');
    
    
}

?>