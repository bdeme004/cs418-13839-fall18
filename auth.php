<?php
session_start();
require_once 'constants.php';
require_once 'lib/Requests-master/library/Requests.php';
require_once 'sqlManager.php';

Requests::register_autoloader();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>lptColors</title>
    </head>
    <body>
        

        <?php
     $data = array('client_id' => GH_CLIENT_ID, 'client_secret' => GH_CLIENT_SEC, 'code' => $_GET["code"]);
        $response = Requests::post('https://github.com/login/oauth/access_token', array(), $data);
       
        parse_str($response->body, $result);
        $_SESSION["token"]=$result["access_token"];
     //   echo $token;

        
        $userdata0 = Requests::get('https://api.github.com/user?access_token='.$_SESSION["token"]);
        //var_dump($userdata0);
       $userdata=json_decode($userdata0->body); 
        
       // var_dump($userdata);
        
        $_SESSION["user"]=$userdata->login;
        $_SESSION["avatar"]=$userdata->avatar_url;
        $_SESSION["admin"]=false;
        
        if(!user_exists_strict($_SESSION["user"])){
            $email=$userdata->email;
            if($email===null){
                $email=$_SESSION["user"]."@github";
            }
            $conn=set_connection("users");
            $stmt="INSERT INTO usertable (handle, email, passcode, avatar) VALUES (?,?,'',?);";
            $sql=$conn->prepare($stmt);
            $sql->bind_param("sss", $_SESSION["user"], $email, $_SESSION["avatar"]);
            $sql->execute();
            
            
        }
        
       header("location:index.php");
        
        
        
        ?>
        
    </body>
</html>