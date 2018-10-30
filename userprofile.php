<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Users - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>

<?php
require 'htmlManager.php';
require 'sqlManager.php';

navbars("monarchs");

$user=$_GET["user"];

$conn=set_connection("users");

$sql="SELECT * FROM usertable WHERE handle LIKE\"". $user ."\";";

if ($result=$conn->query($sql))
{
    $result=$result->fetch_assoc();
    
    $avatar=$result["avatar"];
    $comment=$result["comment"];
        
}
else {
    $avatar="default_img.png";
    $comment="Looks like something went wrong. Sorry about that!";
}

?>

    <div class="container" style="border-color: var(--color-acc-monarchs);">

<?php print("<img class=\"b\" style=\"border-color: var(--color-acc-monarchs);\" src=\. $avatar."\" alt=\"Avatar\">") ?>
<div style="margin-left:75px;">    
<h2><?php echo $user;?></h2>
<hr>
<p><?php echo $comment;?></p>
<hr>
<h3> Channel Membership: </h3>
<h4>Hosted Channels</h4>
<?php echo $user;?> isn't hosting any channels.
<h4>Private Channels</h4>
<?php echo $user;?> isn't part of any private channels.
<br>
</div>
</div>



</body>
</html>
