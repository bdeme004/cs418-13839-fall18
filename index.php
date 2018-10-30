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
  
    <div class="container" style="border-color: var(--color-acc-monarchs);">

<img class="b" style="border-color: var(--color-acc-monarchs);" src="img/default_img.png" alt="Admin">
<span class="name-left">Admin</span>
<div style="margin-left:75px;">    
<p><b>Welcome to Lin Picked The Colors!</b></p>
<p>Click on a link to the left to enter a chat group.
    (You must be logged in to join a chat group.)<br>
<span class="time-right">Time is a myth</span>
</div>
</div>



<?php

require 'htmlManager.php';
require 'sqlManager.php';

navbars("monarchs");

$conn=set_connection("users");
$name=$passcode=$pass_correct="DNE";

//get the password associated with the username in the database
if((isset($_POST["name"]))&& isset($_POST["passcode"]))
{
    $name=test_input($_POST["name"]);
    $passcode=test_input($_POST["passcode"]);
    
   
    
    
    $sql="SELECT passcode, avatar FROM usertable WHERE handle LIKE '".$name."'";
    if($result=$conn->query($sql)){
        $result=$result->fetch_assoc();
        $pass_correct= ($result["passcode"]);
        $avatar=($result["avatar"]);
    }
    
    if(isset($pass_correct)){
        if ($pass_correct==$passcode)
        {echo "Success! The page may take a few seconds to update.";
        $_SESSION["user"]=$name;
        //should properly be testing the link. oh, well.
        $file=$avatar;
        if(file_exists($file))
        { $_SESSION["avatar"]=$avatar;
        } else
        {
            $_SESSION["avatar"]="default_img.png";
            $conn->query("UPDATE usertable SET avatar=\"default_img.png\" WHERE handle=\"".$name."\"");
        }
        
       header( "refresh:2;" );
       
        }
        
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

</body>
</html>
