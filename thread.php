<?php
session_start();
require 'messageTemplate.php';
require 'htmlManager.php';
require 'sqlManager.php';
if(isset($_GET["top"]))
{
    $channel_top=
    $_GET["top"];
    $thread=
    $_GET["thread"];
}
elseif(isset($_POST["top"]))
{
    
    $channel_top=
    $_POST["top"];
    $thread=
    $_POST["thread"];
}
else {
    $channel_top="milan";
    $thread="t15420755835785";
}
//$here="top=".$channel_top."&thread=".$thread;

navbars($channel_top);

$conn= set_connection("threads");
generate_thread($conn, $thread);


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Thread - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<script>
function updateThread(top, thread, mess, user, avatar) {
	

       if (window.XMLHttpRequest) {
           xmlhttp = new XMLHttpRequest();
       } 
       
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               document.getElementById("messageArea").innerHTML = this.responseText;
               
           }
       };
      
          xmlhttp.open("POST","ajaxManager.php",true);
        
     	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //???
     	
      	xmlhttp.send("op=2&top="+top+"&thread="+thread+"&message="+mess+"&user="+user+"&avatar="+avatar); 

       
       

}
window.WHY=function(){
	document.getElementById("messageArea").innerHTML = "WHY";
}
</script>
</head>
<body>

<div style=" position:fixed; z-index: 1; top:100px; width:100%; background-color: var(--color-sub-bcg); border-style: none none solid none; padding: 10px;">
<form  autocomplete="off" >

    
    <textarea id= "message" name="message" rows="6" cols="180" ></textarea><br>
    <input type="button" value="Submit" onclick="updateThread(
    <?php print("'".$channel_top."', '".$thread."', '".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>
    , getElementById('message').value)">
  
</form>
</div>
<div id="messageArea" style="position:absolute; top:270px; width:88%;">

<?php 

    fetch_messages($conn, $thread, $channel_top);
?>

</div>
</body>
</html>
