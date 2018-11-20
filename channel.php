<?php

session_start();
require_once 'threadTemplate.php';
require_once 'htmlManager.php';
require_once 'sqlManager.php';
//

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
</head>
<body>

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



$sql="SELECT * FROM ". $channel_top .";";
if ($result=$conn->query($sql))
{
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



</body>
<script>
function archiveThreads(){
	window.alert("Hi!");
}
</script>
</html>
