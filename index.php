<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lin Picked The Colors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>

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
      <form action="index.php" method="post" style="float: right; margin-right:200px;">
          <input type="text" placeholder="Username" name="username">
          <input type="password" placeholder="Password" name="psw">
          <button type="submit">Login</button>
      </form>
</div>

<?php 
/*
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
*/
?>
<body>
<div class="container">
  <img src="https://www.cs.odu.edu/~bdemerch/cs418/round_account_circle_black_48dp.png" alt="Avatar" >
  <p>I told Lin to pick a color so he picked a color. He picked pink. So I used pink on my website.</p>
  <span class="time-right">11:00</span>
</div>

<div class="container b">
  <img class="b" src="https://www.cs.odu.edu/~bdemerch/cs418/round_account_circle_black_48dp.png" alt="Avatar">
  <p>Then I found more colors that went with the pink. Because there's an app for that. I have it on my phone.</p>
  <span class="time-right">11:01</span>
</div>

<div class="container">
  <img src="https://www.cs.odu.edu/~bdemerch/cs418/round_account_circle_black_48dp.png" alt="Avatar">
  <p>It's a fancy app that can do all sorts of things. You can use the camera to pick colors of IRL objects and get hex codes for them.</p>
  <span class="time-right">11:02</span>
</div>

<div class="container b">
  <img class="b" src="https://www.cs.odu.edu/~bdemerch/cs418/round_account_circle_black_48dp.png" alt="Avatar">
  <p>So now it's called Lin Picked The Colors, because Lin picked the colors. I got colors and a title, all in one! How nice.</p>
  <span class="time-right">11:05</span>
</div>

<div class="container">
  <img src="https://www.cs.odu.edu/~bdemerch/cs418/round_account_circle_black_48dp.png" alt="Avatar">
  <p><?php echo"Now I have a fancy-looking (sort of) website that doesn't really do much more than it did before. But there's colors! (Lin picked them.)"?></p>
  <span class="time-right">11:02</span>
</div>

</body>
</html>
