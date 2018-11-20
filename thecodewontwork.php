<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Testing - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>
<body>
<?php

include "sqlManager.php";

echo count_pages("t15409236916362"). " pages' worth of posts!";

?>

<!-- Moved from thread.php for storage because I'm not using it yet and it's cluttering the page. 
<div class="container" id="commentBox" style=" position:fixed; z-index: 2; display:none; width:100%;">
<!--   <form autocomplete="off" > 
<!--     <textarea placeholder="Type comment..." id="comment" required></textarea> 

    <input type="button" class="btn" value="Submit" onclick="postComment(<?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>	, getElementById('comment').value);">
    <input type="button" class="btn cancel" value="Close" onclick="hideCommentBox()">
<!--   </form> 
<!-- </div> 

<!-- <h2>Modal Example</h2> 

<!-- Trigger/Open The Modal -->
<button id="myBtn">Open Modal</button>

<!-- The Modal -->

 


<script>
// Get the modal
var modal = document.getElementById('import-dialog');

modal.style.display = "inline-block";
// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


</body>



</html>