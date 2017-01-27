<?php
    
    if(isset($_POST['edit_f'])){
        
        if($_POST['password'] && (md5($_POST['password']) != $_SESSION['password'])){
            
            pass_valid();
            mysqli_query($conn,"UPDATE `user` SET `password` = '".$_POST['password']."' WHERE `id` = ".$_SESSION['id']);
            
        }
            
            
            
        
        
        
    }





    message('Новый пароль сохранен!');

?>