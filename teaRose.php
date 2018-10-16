<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tea Rose - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>

<?php
require 'messageTempl.php';
require 'htmlManager.php';
require 'sqlManager.php';

navbars();

$conn= set_connection("channels");

//test using the output of a function that doesn't exist yet!
//This is a brilliant idea which will in no way cause future issues.
    //if (test_permission())

?>


<form action="teaRose.php" method="post" autocomplete="off">
  <fieldset>
    Message:<br>
    <input type="text" name="message"><br>
    <input type="submit" value="Submit">
  </fieldset>
</form>
<?php 

$stmt="INSERT INTO channel2 (user, body) VALUES (?, ?)";

$sql = $conn->prepare($stmt);

if(isset($_POST["message"])){
    $body=test_input($_POST["message"]);
    $user=$_SESSION["user"];}

$sql->bind_param("ss", $user, $body);



if($sql->execute()){
    fetch_messages($conn, "channnel2");
}

?>



</body>
</html>
