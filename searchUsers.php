<?php
session_start();
include 'htmlManager.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Search Users - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<script>
function searchUsers(str) {
     if (str == "") {
        document.getElementById("userResults").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } 
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("userResults").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxManager.php?op=1&q="+str,true);

        xmlhttp.send();
    } 
}
</script>
</head>
<body>
<?php navbars("monarchs");?>

<div style=" position:fixed; z-index: 1; top:100px; width:100%; background-color: var(--color-sub-bcg); border-style: none none solid none; padding: 10px;">
<form>
<input type="text" placeholder="Enter a username" oninput="searchUsers(this.value)">
</form>
</div>
<div id="userResults" style="position:absolute; top:150px; width:88%;">No matches found.</div>

</body>
</html>