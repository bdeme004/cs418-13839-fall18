<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Page Not Found - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>
<?php

$c="CAT";
print( "    <a href=\"userProfile.php?user=".$c."\">
                        <div class=\"container\" style=\"border-color:var(--color-acc-".$c.");\">
                     <img src=\"".$c."\" alt=\"Avatar\" style=\"border-color:var(--color-acc-".$c.");\">
                     <div><h2>".$c."</h2></div></div></a>"
    );

print("<br><br>");


    print( "   
 <a href=\"userProfile.php?user=".$c."\">
                    <div class=\"container b\"style=\"border-color:var(--color-con-".$c.");\">
                    <img class=\"b\" src=\"".$c."\" alt=\"Avatar\" style=\"border-color:var(--color-con-".$c.");\">
                    <div class=\"message-text\">".$c."</div></div></a>"
        );

?>
</body>
</html>