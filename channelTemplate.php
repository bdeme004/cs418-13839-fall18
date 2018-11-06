<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Forms and No Pets</title>
</head>
<body>

<!---------------------------------------------------------------------------------------------------------------------------------------
this is probably organized poorly. As is, I'll have to do this whoooole thing aallllllll over again, ad nauseum, if I need more channels.
Not that that's, y'know, specifically outlined in the requirements documentation or anything...
    OTL
----------------------------------------------------------------------------------------------------------------------------------------->
	
<?php
require 'object.php';
require 'utilities.php';

$servername = "localhost";
$username = "admin";
$password = "monarchs";
$dbname ="channels";

//==========================================================================
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//==========================================================================
?>


<section>
CAT PETS
<form method="post">
  <fieldset>
    Message:<br>
    <input type="text" name="message"><br>
    <input type="submit" value="Submit">
  </fieldset>
</form>
</section>

<?php 

$newmess=test_input($_POST["message"]);
if(isset($_POST["message"])){
    //RTC-- need to fetch channel value maybe? Kinda fuzzy. @_@
    // I just need to make sure that things get put in the right place, preferably without writing the same code 17 times.
$sql="INSERT INTO channel1 VALUES ('DNE', '".$newmess."', now(), now(4));";
if($conn->query($sql)){
    fetch_messages($conn);
}
else {
    echo "error: message not sent: ".$sql;
}
}
?>


</body>
</html>