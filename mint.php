<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mint - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>


<!---------------------------------------------------------------------------------------------------------------------------------------
this is probably organized poorly. As is, I'll have to do this whoooole thing aallllllll over again, ad nauseum, if I need more channels.
Not that that's, y'know, specifically outlined in the requirements documentation or anything...
    OTL
----------------------------------------------------------------------------------------------------------------------------------------->
<!--==================================================================-->	
<div class="sidenav">
  <a href="index.php">Lin Picked the Colors</a>
  <a href="heliotrope.php">Heliotrope</a>
  <a href="teaRose.php">Tea Rose</a>
  <a href="mint.php">Mint</a>
  <a href="milan.php">Milan</a>
  <a href="lightSky.php">Light Sky</a>
</div>


<div class="topnav">
      <h2>Lin Picked The Colors</h2>
    </div>
<body>
<!--=================================================================-->


<?php
//probably oughta stick this in another file somewhere XD
require 'messageTempl.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
return $data;}

function fetch_messages ($conn) {
    $sql="SELECT * FROM channel3 ORDER BY chKey DESC";
    if($result=$conn->query($sql)){
        $index=1;
        while($row= ($result->fetch_assoc())){ //Unless there's no more rows to fetch...
            $newraw=array();
            foreach ($row as $field){                   //For each field in the row... (should probably just take "as" as の here)
                array_push($newraw, $field);                        //...print the field's contents followed by a space.
            }
            $newmess=new message($newraw);
            $index=$index+1;
            $newmess->print_with_format(($index%2));
         
            
                                               //...then move to the next line...
        } 
      //...and stop when there's no more rows.
    }
}

$servername = "localhost";
$username = "admin";
$password = "monarchs";
$dbname ="channels";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<form action="mint.php" method="post">
  <fieldset>
    Message:<br>
    <input type="text" name="message"><br>
    <input type="submit" value="Submit">
  </fieldset>
</form>
<?php 

if(isset($_POST["message"])){
$newmess=test_input($_POST["message"]);
$sql="INSERT INTO channel3 VALUES ('DNE', '".$newmess."', now(), now(4));";
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