<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>New User- Lin Picked The Colors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>
  
<?php

require 'htmlManager.php';
require 'sqlManager.php';

navbars("monarchs");

$email_err=$handle_err=$password_err=$repeat_err="";
$email=$handle="";

$conn=set_connection("users");

$stmt="SELECT handle, email FROM usertable WHERE handle LIKE ? OR email LIKE ?;";
$stmt2="INSERT INTO usertable (handle, email, passcode, avatar) VALUES (?,?,?, \"default_img.png\");";
$sql=$conn->prepare($stmt);
$sql2=$conn->prepare($stmt2);
//get the password associated with the username in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = " *Invalid email format";
        }
    }
    
    if (empty($_POST["handle"])) {
        $handle_err = " *Username is required";
    } else {
        $handle = test_input($_POST["handle"]);
    }
    
    if (empty($_POST["passcode"])) {
        $password_err= " *Password is required";
    } else {
        $passcode = test_input($_POST["passcode"]);
    }
    
    if (empty($_POST["passcode-repeat"])){
        $repeat = "";
    } else {
        $repeat= test_input($_POST["passcode-repeat"]);
        if ($passcode!=$repeat)
            $repeat_err = " *Passwords don't match";
    }
}

    
    $col1=$col2="";
    $sql->bind_param("ss", $handle, $email);
    $sql->execute();
    $sql->bind_result($col1, $col2);
    
    if($sql->fetch()){
    if ($handle==$col1)
    $handle_err= " *Username is already in use";
    if ($email==$col2)
    $email_err= " *Email is already in use";
    }

    else
    {
    $sql2->bind_param("sss", $handle, $email, $passcode);
    if($sql2->execute()){
    echo "You're signed up! Yay.";
    
    $_SESSION["user"]=$handle;
    $_SESSION["avatar"]="default_img.png";
    header("Location: index.php");
    }

}


?>

<form action="#" method="post">
<div class="container">
<h1>New Account</h1>
<hr>

<label><b>Email: </b>
<input type="text" name="email" value="<?php echo $email; ?>" required>

</label><span> <?php echo $email_err;?></span><br><br>
<label><b>Username: </b>
<input type="text" name="handle" value="<?php echo $handle; ?>" required>
<span> <?php echo $handle_err;?></span>
</label><br><br>
<label><b>Password: </b>
<input type="password" name="passcode" required>
<span> <?php echo $password_err;?></span>
</label><br><br>
<label><b>Repeat Password: </b>
<input type="password" name="passcode-repeat" required>
<span> <?php echo $repeat_err;?></span>
</label>
<hr>

<button type="submit" class="registerbtn">Sign Up</button>

</div>
</form>

</body>
</html>