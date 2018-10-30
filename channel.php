<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Heliotrope - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>

<?php
require 'threadTemplate.php';
require 'htmlManager.php';
require 'sqlManager.php';

$channel_top=$_GET["top"];
navbars($channel_top);

echo ("<a href=\"newthread.php?top=".$channel_top."\">
                        <div class=\"container thread\"style=\"border-color:var(--color-acc-".$channel_top.");  color:#000000;\">
    
                    <div class=\"message-text\"><h2 >Create a New Thread<h2></div>
                    </div></a>");

$conn= set_connection("channels");

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
        $new_thread->print_with_format(($index%2), $channel_top);
}
}
else {echo "issue executing";
error_log($conn->error .". SQL: ". $sql);
}
?>

</body>
</html>
