<?php

session_start();
require_once 'threadTemplate.php';
require_once 'htmlManager.php';
require_once 'sqlManager.php';

if(!isset($_SESSION["user"]))
{
    header("Location: index.php?login=0");
}


$user_admin=$_SESSION["admin"];
$channel_top=$_GET["top"];
navbars($channel_top);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $channel_top;?> - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="lptcolors.js"></script>

</head>
<body>



<div class="container thread" id="pageinfo" data-archive-mode="" data-channel-top="<?php echo $channel_top;?>"
style="border-color:var(--color-acc-<?php echo $channel_top;?>); border-radius: 7px; color:#000000;">
      
      <div class="container archive-switch-notice" id="archive-switch" style="display:none;">
         <i class="material-icons archived">lock_open</i>
         <span style= "font-size: 24px; position: relative; bottom: 18px;">
         	You're now in Archive Mode. Click on a thread to archive or restore it (The system will ask for confirmation).
         	When you're done, click "Finish" to go back to Standard Mode.
        </span>
        </div>
      
    <div class="message-text" style="display:inline-block;"><h2><a href="newthread.php?top=<?php echo $channel_top; ?>">&#5867;  Create a New Thread</a></h2></div>

<?php
if($user_admin==1)
{
    echo ("
<div class=\"message-text\" style=\"display:inline-block; color: #FF0000;\"><a href=\"javascript:toggleArchiveMode()\"><h2><span id=\"archive-mode-toggle\">&#5867; Archive Threads</span></h2></a></div>");
}
?>
</div>


<div class="thread-area" id="message-area">

<?php 
update_channel($channel_top, $user_admin);
?> 

</div>

</body>

</html>
