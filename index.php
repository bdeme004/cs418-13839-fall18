<?php
session_start();
require_once 'htmlManager.php';
require_once 'sqlManager.php';

navbars("monarchs");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
  
  
<?php

$error_icon="<i class=\"material-icons\">error_outline  </i>";
$success_icon="<i class=\"material-icons\">check_circle_outline  </i>";
$login_result="";

if(isset($_GET["login"]))
    $login_result= $error_icon."Your login session has expired.";
    


$conn=set_connection("users");
$name=$passcode=$pass_correct="DNE";

//get the password associated with the username in the database
if((isset($_POST["name"]))&& isset($_POST["passcode"]))
{
    $name=test_input($_POST["name"]);
    $passcode=test_input($_POST["passcode"]);
    
   
    
    
    $sql="SELECT passcode, avatar, email FROM usertable WHERE handle LIKE '".$name."';";
    if($result=$conn->query($sql)){
        $result=$result->fetch_assoc();
        $pass_correct= ($result["passcode"]);
        $avatar=($result["avatar"]);
        $email=($result["email"]);
    }
    
    if(isset($pass_correct)){
        if ($pass_correct==$passcode)
        {$login_result= $success_icon. "Success! The page may take a few seconds to update.";
        $_SESSION["user"]=$name;
        if($name=="ADMINISTRATOR" || $name=="bdemerch")
        {$_SESSION["admin"]=true;}
        else 
        {$_SESSION["admin"]=false;}
        
        
        if(!strpos($avatar, "gravatar.com/")){
        if (($avatar==DEFAULT_IMG) || (!file_exists($avatar))) {
            //currently re-gravataring the gravatar every time. Oh, well
            //It's not working right yet anyway so it's a bit of a waste fixing that
                //also, the file pretty seriously doesn't exist. so yeah
           
            
            $avatar= "https://www.gravatar.com/avatar/" . $email. GRAV_EXT;
       
            
            $conn->query("UPDATE usertable SET avatar=\"".$avatar."\" WHERE handle=\"".$name."\"");
            } 
        }
   
            $_SESSION["avatar"]=$avatar;  
        
       header( "refresh:1;" );
       
        }
        
        else
        {$login_result= $error_icon. "user/password combination doesn't match our records.";
        }}
        
        else
        { if($name=="logout")
            {session_unset();
             session_destroy();
             $login_result= $error_icon. ("Logged out. The page may take a few seconds to update.");
             header("refresh;");}
          else {$login_result= $error_icon. "user not found.";}}
}
?>
  
    <div class="container" style="border-color: var(--color-acc-monarchs);">

<img class="b" style="border-color: var(--color-acc-monarchs);" src="<?php echo DEFAULT_IMG;?>" alt="Admin">
<span class="name-left" style="margin-left:55px;">Admin</span>
<div style="margin-left: 75px;">    
<p><b>Welcome to Lin Picked The Colors!</b></p>
<p>Click on a link to the left to enter a chat group.
    (You must be logged in to join a chat group.)<br>
<span class="right-corner">Time is a myth</span>
</div>
</div>
<span style="color:#818181; font-size: 18px;"><?php echo $login_result;?></span>
    <form action="https://github.com/login/oauth/authorize" method="GET">
        <input type="hidden" name="client_id" value="71ce02e70e6de763c9a2">
        <input type="submit" value="GitHub Stuff Button">
    
    </form>
    


</body>
</html>
