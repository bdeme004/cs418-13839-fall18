<?php
session_start();
include 'htmlManager.php';
navbars("monarchs");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Page Not Found - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>
  
  
    <div class="container" style="border-color: var(--color-acc-monarchs);">

<img class="b" style="border-color: var(--color-acc-monarchs);" src="default_img.png" alt="Admin">
<span class="name-left">Admin</span>
<div style="margin-left:75px;">    
<p><b>Page Not Found</b></p>
<p>Sorry, that page doesn't seem to exist. Maybe the gnomes ate it?<br>
<span class="right-corner">Time is a myth</span>
</div>
</div>
    
    <?php
    function fetch_messages ($thread, $channel_top, $page, $cap, $admin) {
    $conn=set_connection("threads");
    $sql="SELECT * FROM `" . $thread . "` ORDER BY chKey DESC";
    if($result=$conn->query($sql)){
    $index=1;
    $first=1+(10*($page-1));
    $last=$first+9;
    while($row= ($result->fetch_assoc())){
    $newraw=array();
    foreach ($row as $field){
    array_push($newraw, $field);
    }
    $newmess=new message($newraw);

    if($index>=$first && $index<=$last )
                                      {
                                      $newmess->print_with_format(($index%2), $channel_top, $admin);
    $index=$index+1;
    }
    }
    }
    else echo("Error executing ". $sql. ": ".$conn->error);
    }
    ?>
    
    
    
    
    
    
    
</body>
</html>