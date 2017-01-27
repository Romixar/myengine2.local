<?php
    
    if(isset($_POST['edit_f'])){
        
        if($_POST['password'] && (md5($_POST['password']) != $_SESSION['password'])){
            
            pass_valid();
            mysqli_query($conn,"UPDATE `user` SET `password` = '".$_POST['password']."' WHERE `id` = ".$_SESSION['id']);
            
        }
            
            
        if($_POST['ip'] != $_SESSION['ip']){

            if($_POST['ip']){
                
                $arr = explode(',',$_POST['ip']);
                
                if(count($arr) == 0 || count($arr) > 3) message('Количество IP не более 3');
                
                foreach($arr as $k => $v){
                    if(!filter_var($v,FILTER_VALIDATE_IP)) message('IP - '.$v.' указан не верно!');
                }
                
                $_SESSION['ip'] = $_POST['ip'];
                
                
            }else $_SESSION['ip'] = '';
            
            mysqli_query($conn,"UPDATE `user` SET `ip` = '".$_SESSION['ip']."'");
        
        }
        
        
        
    }





    message('Настройки сохранены!');

?>