<!DOCTYPE html>
<html>
<?php

include 'sqlManager.php';
include 'messageTemplate.php';

if(isset($_GET['op']))
    $op=intval($_GET['op']);
else
    $op=intval($_POST['op']);


    switch ($op){
    
        case 1:
            $q = test_input($_GET['q']);
            search_users($q);
            break;
            
        case 2:   
           $body = test_input($_POST["message"]);
           update_thread($body, $_POST["top"], $_POST["thread"], $_POST["user"], $_POST["avatar"]);
           break;
                    
    } //end switch
    


?> 
</html>