<?php
session_start();
require_once 'messageTemplate.php';
require_once 'htmlManager.php';
require_once 'sqlManager.php';

require_once 'upload2.php';

//----------------------------------------------------------


//----------------------------------------------------------

if(!isset($_SESSION["user"]))
{
    header("Location: index.php?login=0");
}

$channel_top=$_GET["top"];
$thread=$_GET["thread"];
$admin=$_SESSION["admin"];



$archived=isArchived($channel_top, $thread);



$conn= set_connection("threads");
generate_thread($conn, $thread);

navbars($channel_top);


if($archived){
    $input_form="display:none";
    $archive_notice = "";
}
else{
    $archive_notice = "display:none";
    $input_form = "";
}




?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Thread - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="lptcolors.js"></script>

</head>

<body>

<!-- comment box was here-ish -->
<script>
hereGoes();

</script>

<div class="thread-header" id="pageinfo" data-thread-id="<?php print($thread);?>" data-channel-top="<?php print($channel_top);?>" data-user-admin="<?php print $admin;?>"
	 data-thread-archived="<?php echo isArchived($channel_top, $thread);?>">

    <form id="inputform" autocomplete="off" style="<?php echo $input_form;?>">
        <textarea id= "message" name="message" rows="6" cols="180" style="margin-bottom: 5px;"></textarea><br>
        <input type="button" value="Submit" 
        	onclick="updateThread( <?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>, getElementById('message').value, <?php print $admin;?>)">
    	<input type="button" id="add-image" value="Add Image" onclick="toggleImportDialog()">
    </form>
    
    <div class="container archive-notice" id="archive-notice" style="<?php echo $archive_notice;?>">
         <i class="material-icons archived">lock</i>
         <span style= "font-size: 24px; position: relative; bottom: 18px;">
         	This post has been archived by an administrator and no new posts, comments, or edits can be made.
         </span>  
     </div>
     
</div>

<div class="container import-dialog" id="import-dialog" >
    <div style="font-size:21px; font-weight:bold;">Enter the address of an image or upload your own: 
    <a href="javascript:toggleImportDialog()"><span class="close"><i class=material-icons>close</i></span></a>
    </div>
    
    <hr>
    <div class="import-frame" >
    	<img class="import" id="img-img" src="add-img.png" alt="no image selected" >
    </div>
    <textarea rows="6" cols="56" id="img-comment" placeholder="Enter a comment (optional)" style="position:relative; vertical-align: top;"></textarea>
    <hr>
    
	   
	  
    	<form action="#" method="post" id="web-src-form" style="display:inline-block;">
        <input type="url" name="web-img-src" id="web-img-src" placeholder="Enter image URL...">
        <input type=button value="Fetch Image" name="submit-web-src" onclick="javascript:urlImage()">
        </form>
        or
        <form action="#" method="post" enctype="multipart/form-data" id="import-form" style="display:inline-block;">
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        </form>
        <input type="button" value="Send Message" name="submit-message" onclick="submitWithImage(<?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>)">
         <?php 
        
         
         ?>
         
         
         
         
         
         
         
         
</div>

<div class="page-count">
    <?php
        $num_pages=count_pages($thread);
        for ($i=1; $i<=$num_pages; $i++)
        {
            print("<strong> <a href=\"javascript:loadPage(".$i.")\">".$i." "."</a></strong>");
        }
    ?>
</div>

<div class="message-area" id="message-area">


	<?php echo fetch_messages($thread, $channel_top, 1, 10, $admin); ?>

</div>






</body>



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
