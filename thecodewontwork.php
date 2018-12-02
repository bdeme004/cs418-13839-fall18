<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Testing - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php

include "sqlManager.php";


?>

<!-- Moved from thread.php for storage because I'm not using it yet and it's cluttering the page. 
<div class="container" id="commentBox" style=" position:fixed; z-index: 2; display:none; width:100%;">
<!--   <form autocomplete="off" > 
<!--     <textarea placeholder="Type comment..." id="comment" required></textarea> 

    <input type="button" class="btn" value="Submit" onclick="postComment(<?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>	, getElementById('comment').value);">
    <input type="button" class="btn cancel" value="Close" onclick="hideCommentBox()">
<!--   </form> 
<!-- </div> -->

     <div class="container" id="this-key" style="border-color:var(--color-acc-monarchs);">
                <img class="a" src="this-avatar" alt="Avatar" style="border-color:var(--color-acc-monarchs);">
                <div class="post-react">
                    <a href="javascript:likePost('this-key')"> <i class="material-icons post-react">expand_less</i></a>
                    <span class="post-react tally">2</span>   
                    <a href="javascript:dislikePost('this-key')"> <i class="material-icons post-react">expand_more</i></a>
                </div>
                <a href="userProfile.php?user=this-name"><span class="name-left">this-name</span></a>
                <div class="message-text"><p>のはいいけど、このままじゃテキストの量を増やせば問題になるんじゃないかと。なるの？ならないの？っていうか、どっちがいいんだろうね。まあ、こっちくらいは大丈夫みたいね。KILLPOSTDISPLAYは何やってるかわあかんないけど。</p></div>
                <span class="right-corner">"this-time"</span>
                <br><span class="right-corner">killPost_display</span></div>

        <div class="container" id="$this->key" style="border-color:var($color);">
                <img class="a" src="$this->avatar" alt="Avatar" style="border-color:var($color);">
                <span class="post-react">
                    <a class="post-react-a" href="javascript:likePost($this->key)"> <i class="material-icons"> keyboard_arrow_up </i> </a>
                    <a class="post-react-a" href="javascript:dislikePost($this->key)"> <i class="material-icons"> keyboard_arrow_down </i> </a>
                </span>
                <a href="userProfile.php?user=$this->name"><span class="name-left">$this->name</span></a>
                <div class="message-text"><p>$this->body</p></div>
                <span class="right-corner">$this->time</span>
                <br><span class="right-corner">$killPost_display</span></div>


</body>



</html>