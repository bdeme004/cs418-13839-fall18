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
<script src="lptcolors.js"></script>
</head>
<body>
<?php navbars("monarchs");?>

<div style=" position:fixed; z-index: 1; top:100px; width:100%; background-color: var(--color-sub-bcg); border-style: none none solid none; padding: 10px;">
<form>
<input type="text" placeholder="Enter a username" oninput="searchUsers(this.value)">
</form>
</div>
    <div id="userResults" style="position:absolute; top:150px; color:#818181; font-size: 18px; width:88%;">No matches found.</div>
   </body>
</html>