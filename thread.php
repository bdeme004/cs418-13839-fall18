<?php
session_start();
require_once 'messageTemplate.php';
require_once 'htmlManager.php';
require_once 'sqlManager.php';
//----------------------------------------------------------

//----------------------------------------------------------

if(!isset($_SESSION["user"]))
{
    header("Location: index.php?login=0");
}

$channel_top=$_GET["top"];
$thread=$_GET["thread"];
$admin=$_SESSION["admin"];



$conn= set_connection("threads");
generate_thread($conn, $thread);

navbars($channel_top);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Thread - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">


</head>

<body>
<span id="pageinfo" data-thread-id="<?php print($thread);?>" data-channel-top="<?php print($channel_top);?>" data-user-admin="<?php print $admin;?>"></span>

<div class="container" id="commentBox"
 style=" position:fixed; z-index: 2; display:none; width:100%;">
  <form autocomplete="off">
    <textarea placeholder="Type comment..." id="comment" required></textarea>

    <input type="button" class="btn" value="Submit" onclick="postComment(<?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>
	, getElementById('comment').value);">
    <input type="button" class="btn cancel" value="Close" onclick="hideCommentBox()">
  </form>
</div>



<div style=" position:fixed; z-index: 1; top:100px; width:100%; background-color: var(--color-sub-bcg); border-style: none none solid none; padding: 10px;">
<form  autocomplete="off">

    <textarea id= "message" name="message" rows="6" cols="180" ></textarea><br>
    <input type="button" value="Submit" 
    	onclick="updateThread( <?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>
    							, getElementById('message').value, <?php print $admin;?>)">
	<input type="button" value="Add Image" onclick="addImage()">
  
</form>
</div>
  -->
<div style="position:fixed; z-index: 1;top:254px; background-color: var(--color-sub-bcg);width:100%;text-align:center;">
<?php
$num_pages=count_pages($thread);
for ($i=1; $i<=$num_pages; $i++)
{
    print("<strong onclick=\"loadPage(".$i.")\">".$i." "."</strong>");
}

?>
</div>
<div id="messageArea" style="position:absolute; top:287px; width:88%;">


<?php fetch_messages($thread, $channel_top, 1, 10, $admin); ?>

</div>
</body>

<!-- --------------------------------------------------------------------- -->
<script>

function getThreadId(){
 return document.getElementById("pageinfo").getAttribute("data-thread-id");
	}

function getChannelTop(){

	return document.getElementById("pageinfo").getAttribute("data-channel-top");
	}


function addImage(){

	imgSrc=window.prompt('Enter the source of your image: ','image source...' );

	if(!(imgSrc == null || imgSrc == ""|| imgSrc=="image source..."))
	{
		document.getElementById("message").innerHTML = 
			"<img class=\"embed\" src=\""+imgSrc+"\" alt=\""+imgSrc+"\">";
	}
	}
	
function updateThread(user, avatar, mess, admin) {

		thread=getThreadId();
		channelTop=getChannelTop();
	
       if (window.XMLHttpRequest) {
           xmlhttp = new XMLHttpRequest();
       } 
       
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               document.getElementById("messageArea").innerHTML = this.responseText;
               }
       };
      
        xmlhttp.open("POST","ajaxManager.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     	xmlhttp.send("op=2&top="+channelTop+"&thread="+thread+"&message="+mess+"&user="+user+"&avatar="+avatar+"&admin="+admin); 
	}
 
 
/* function loadPage(page){
	thread=getThreadId();
	channel_top=getChannelTop();
	
	 if (window.XMLHttpRequest) {
         xmlhttp = new XMLHttpRequest();
     } 

	 xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
             document.getElementById("messageArea").innerHTML = this.responseText;
             }
     };

    xmlhttp.open("POST","ajaxManager.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	xmlhttp.send("op=3&top="+top+"&thread="+thread+"&page="+page); 
}
*/
 	function showCommentBox() {
 	    document.getElementById("commentBox").style.display = "block";
 	}

 	function hideCommentBox() {
 	    document.getElementById("commentBox").style.display = "none";
 	}

 	function postComment(mess, user, avatar){
 	 	updateThread(mess, user, avatar);
 	 	hideCommentBox();
 	} 

 	function deletePost(chkey){
 	 	
 		if (confirm("This post will be replaced with a delete notice--This can't be undone! Really delete?")) {
 	 	
 	 	thread=getThreadId();
 		 if (window.XMLHttpRequest) {
 	         xmlhttp = new XMLHttpRequest();
 	         
 	     } 

 		 xmlhttp.onreadystatechange = function() {
 	         if (this.readyState == 4 && this.status == 200) {
 	        	window.alert(this.responseText);
 	         }
 	     };
 	 	
 		xmlhttp.open("POST","ajaxManager.php",true);
 	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	 	xmlhttp.send("op=4&thread="+thread+"&chkey="+chkey); 

 	}
 	}
 	

 	function killPost(chkey){
 		if (confirm("This post will be totally deleted--This can't be undone! Really delete?")) {
 	
 		thread=getThreadId();
 		 if (window.XMLHttpRequest) {
 	         xmlhttp = new XMLHttpRequest();
 	     } 

 		 xmlhttp.onreadystatechange = function() {
 	         if (this.readyState == 4 && this.status == 200) {
 	        	window.alert(this.responseText);
 	         }
 	     };
 	     
 		xmlhttp.open("POST","ajaxManager.php",true);
 	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	 	xmlhttp.send("op=5&thread="+thread+"&chkey="+chkey); 
 	}
 	}
	
</script>
</html>
