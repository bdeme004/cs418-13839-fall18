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
require 'messageTempl.php';
require 'htmlManager.php';
require 'sqlManager.php';

navbars();

$conn= set_connection("channels");

?>


<form action="heliotrope.php" method="post" autocomplete="off">
  <fieldset>
    Message:<br>
    <input type="text" name="message"><br>
    <input type="submit" value="Submit">
  </fieldset>
</form>
<?php 

$stmt="INSERT INTO channel1 (user, body) VALUES (?, ?)";

$sql = $conn->prepare($stmt);

if(isset($_POST["message"])){
    $body=test_input($_POST["message"]);
    $user=$_SESSION["user"];}

$sql->bind_param("ss", $user, $body);



if($sql->execute()){
    fetch_messages($conn, "channel1");
}
    else
{echo ("Sorry, Message not sent.); }
/*Error: ".$conn->error);}*/

?>



</body>
</html>
