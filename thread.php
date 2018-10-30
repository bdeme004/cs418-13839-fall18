<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Heliotrope - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>

<?php
require 'messageTemplate.php';
require 'htmlManager.php';
require 'sqlManager.php';

$channel_top=$_GET["top"];
$thread_index=$_GET["thread"];
navbars($channel_top);

$conn= set_connection("threads");
set_thread($conn, $thread_index);


?>

<div style=" position:fixed; z-index: 1; top:100px; width:100%; background-color: var(--color-sub-bcg); border-style: none none solid none; padding: 10px;">
<form action="#" method="post" autocomplete="off">

    Message:<br>
    <textarea name="message" rows="6" cols="180"></textarea><br>
    <input type="submit" value="Submit">
  
</form>
</div>
<div style="position:absolute; top:270px; width:88%;">
<?php 

$stmt="INSERT INTO ". $thread_index ." (user, body, avatar) VALUES (?,?,?)";
$sql = $conn->prepare($stmt);
echo $conn->error;
if(isset($_POST["message"])){
    $body=test_input($_POST["message"]);
    $user=$_SESSION["user"];
    $avatar=$_SESSION["avatar"];

$sql->bind_param("sss", $user, $body, $avatar);



if($sql->execute()){
    fetch_messages($conn, $thread_index, $channel_top);
   
}
    else
{echo ("Sorry, Message not sent.); }
Error: ".$conn->error);}


}
?>


</div>
</body>
</html>
