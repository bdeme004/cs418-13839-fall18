<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>New User- lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="lptcolors.js"></script>

</head>
<body>
  
<?php

require_once 'htmlManager.php';
require_once 'sqlManager.php';
require_once 'lib/recaptcha-master/src/autoload.php';
    
    //change this value to 'true' to bypass captcha for testing
    $passed=false;

if(!empty($_POST["g-recaptcha-response"])){
    $secret='6LfatX0UAAAAAE6K0bsAXifdavd7Ngrs9g1LXQ9R';
    $gRecaptchaResponse=$_POST["g-recaptcha-response"];
    $remoteIp=$_SERVER['REMOTE_ADDR'];
    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
    if ($resp->isSuccess()) {
        $passed=true;
    } else {
        $errors = $resp->getErrorCodes();
    }
}
    
    
navbars("monarchs");

$email_err=$handle_err=$password_err=$repeat_err="";
$email=$handle="";

$conn=set_connection("users");

$stmt="SELECT handle, email FROM usertable WHERE handle LIKE ? OR email LIKE ?;";
$stmt2="INSERT INTO usertable (handle, email, passcode, avatar) VALUES (?,?,?,?);";
if(!$sql=$conn->prepare($stmt))
    $email_err = $conn->error;
if(!$sql2=$conn->prepare($stmt2))
    $email_err = $conn->error;
    $clear=true;
//get the password associated with the username in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
        $clear=false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = " *Invalid email format";
            $clear=false;
        }
        if (strlen($email)>45)
        {$email_err = "*Max 45 characters";
         $clear=false;}
    }
    
    if (empty($_POST["handle"])) {
        $handle_err = " *Username is required";
            $clear=false;
    } else {
        $handle = test_input($_POST["handle"]);
        if (strlen($handle)>13)
        {$handle_err = "*Max 13 characters";
         $clear=false;}
        
    }
    
    if (empty($_POST["passcode"])) {
        $password_err= " *Password is required";
        $clear=false;
    } else {
        $passcode = test_input($_POST["passcode"]);
        if (strlen($passcode)>13)
        {$password_err = "*Max 13 characters";
         $clear=false;}
    }
    
    if (empty($_POST["passcode-repeat"])){
        $repeat = "";
    } else {
        $repeat= test_input($_POST["passcode-repeat"]);
        if ($passcode!=$repeat){
            $repeat_err = " *Passwords don't match";
            $clear=false;}
    }
    
    if($clear){
    $col1=$col2="";
    $sql->bind_param("ss", $handle, $email);
    $sql->execute();
    $sql->bind_result($col1, $col2);
    
    if($sql->fetch()){
    if ($handle==$col1){
    $handle_err= " *Username is already in use";
        }
    if ($email==$col2){
    $email_err= " *Email is already in use";
        }
    }

    elseif($passed)
    {
    $avatar= "https://www.gravatar.com/avatar/". md5( strtolower( trim( $email ) ) ).GRAV_EXT ;
    $sql2->bind_param("ssss", $handle, $email, $passcode, $avatar);
    if($sql2->execute()){
    echo "You're signed up! Yay.";
    
    $_SESSION["user"]=$handle;
    $_SESSION["avatar"]=$avatar;
    header("Location: index.php");
    }

    else $email_err=$conn->error;

    }
        else $repeat_err="Please complete the CAPTCHA form.";
            
    
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
<br><br>

<hr>
    
    <div class="g-recaptcha" data-sitekey="6LfatX0UAAAAABxYqjHLajS2yvFLtmUEejaWSGbX"></div>
    
<button type="submit" id="sign-up-button">Sign Up</button>

</div>

</form>

    <?php

    

    ?>    

    
    
</body>
</html>
