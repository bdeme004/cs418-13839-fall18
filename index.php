<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lin Picked The Colors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>
<?php

require 'htmlManager.php';
require 'sqlManager.php';

navbars();


$conn=set_connection("users");
$name=$passcode=$pass_correct="DNE";

//get the password associated with the username in the database
if((isset($_POST["name"]))&& isset($_POST["passcode"]))
{
    $name=test_input($_POST["name"]);
    $passcode=test_input($_POST["passcode"]);
    
   
    
    
    $sql="SELECT passcode FROM usertable WHERE handle LIKE '".$name."'";
    if($pass_correct=$conn->query($sql)){
        $pass_correct= ($pass_correct->fetch_assoc()["passcode"]);
    }
    
    if(isset($pass_correct)){
        if ($pass_correct==$passcode)
        {echo "Success! The page may take a few seconds to update.";
        $_SESSION["user"]=$name;
        header( "refresh:2;" );}
        
        else
        {echo "user/password combination doesn't match our records.";}}
        
        else
        { if($name=="logout")
            {session_unset();
             session_destroy();
             echo ("Logged out. The page may take a few seconds to update.");
             header("refresh:2;");}
          else {echo nl2br("user not found.\n");}}
}
?>
<div class="container b">
<span class="name-left">Admin</span>    
<img class="b" src="round_account_circle_black_48dp.png" alt="Admin">
<p><b>Welcome to Lin Picked The Colors!</b></p>
<p>Click on a link to the left to enter a chat group.</p>
<p>(You must be logged in to join a chat group.</p>
<span class="time-right">".$this->time."</span>
</div>
</body>
</html>
