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


$conn= set_connection("channels");

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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
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
      
       <div class="message-text" style="display:inline-block;"><h2><a href="newthread.php?top=<?php echo $channel_top; ?>">・Create a New Thread</a></h2></div>

<?php


echo (
      "<div class=\"container thread\" id=\"infobox\" style=\"border-color:var(--color-acc-".$channel_top.");  color:#000000;\">
       <div class=\"message-text\" style=\"display:inline-block;\"><h2 ><a href=\"newthread.php?top=".$channel_top."\">・Create a New Thread</a></div>"
    );
    if($user_admin==1)
    {
    echo ("<div class=\"message-text\" style=\"display:inline-block;\"><a href=\"javascript:archiveThreads()\"><h2>・ Archive Threads</h2></a></div>");
    }
echo("</h2></div></div></a>");




<?php
if($user_admin==1)
{

    echo ("
<div class=\"message-text\" style=\"display:inline-block; color: #FF0000;\"><a href=\"javascript:toggleArchiveMode()\"><h2><span id=\"archive-mode-toggle\">・ Archive Threads</span></h2></a></div>");
}
=======
    $index=1;
    while($thread_list=$result->fetch_assoc()){
        $thread=array();
        foreach ($thread_list as $field){
            array_push($thread, $field);
        }
        $new_thread=new thread($thread);
        $index=$index+1;
        $new_thread->print_with_format(($index%2), $channel_top, $_SESSION["admin"]);
    }
}
else {
    echo "issue executing";
    error_log($conn->error .". SQL: ". $sql);
    //  echo (" ". $conn->error. " .SQL: ". $sql);
}

echo ("Hello, world!");


?>
</div>


<div class="thread-area" id="message-area">

<?php 
update_channel($channel_top, $user_admin);
?> 

</div>



</body>

</html>
