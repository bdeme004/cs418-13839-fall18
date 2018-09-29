<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Forms and Pets</title>
</head>
<body>
<p>XKCD #1558, Vet: <a href="https://xkcd.com/1558/">https://xkcd.com/1558/</a></p>
<image src="https://imgs.xkcd.com/comics/vet.png" alt="xkcd #1558: Vet">
	<form action="index.php" method="post" autocomplete="off">
		Pet: <input type="text" name="pet"><br>
		<input type="submit" value="That's my pet!">
	</form>
	
<?php
$pet="";
$pet=$_POST["pet"];
if(strlen($pet)>0)
{if ($pet=="Roomba") {
    
    echo "A Roomba is not a pet.";
}else 
{echo "Your pet is a ". $pet."!";}
}	

$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


?>



</body>
</html>