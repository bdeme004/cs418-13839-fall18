<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Forms and No Pets</title>
</head>
<body>

	<form action="index.php" method="post" autocomplete="off">
		Username: <input type="text" name="name"><br>
		Password: <input type="text" name="passcode"><br>
		<input type="submit" value="Login">
	</form>
	
<?php
require 'messageTempl.php';
require 'utilities.php';


$servername = "localhost";
$username = "admin";
$password = "monarchs";
$dbname ="users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	
}

//=========================================================
$name=$passcode=$pass_correct="DNE";

//get the password associated with the username in the database
if((isset($_POST["name"]))&& isset($_POST["passcode"]))
{
$name=test_input($_POST["name"]);
$passcode=test_input($_POST["passcode"]);
	

$sql="SELECT passcode FROM usertable WHERE handle LIKE '".$name."'";
if($pass_correct=$conn->query($sql)){
$pass_correct= ($pass_correct->fetch_assoc()["passcode"]); //<-element of the array with the index "passcode".
}

if(isset($pass_correct)){
if ($pass_correct==$passcode)
	{echo "success!";}
else
{echo "user/password combination doesn't match our records.";}}
else
{echo nl2br("user not found.\n");}

}

?>

</body>
</html>