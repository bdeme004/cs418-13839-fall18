

//just a shortcut since I kept doing the same three things over and over
function getPageInfo(_attribute)
{
	attribute="data-"+_attribute;
	return document.getElementById("pageinfo").getAttribute(attribute);
}


/*function addImage(){

	imgSrc=window.prompt('Enter the source of your image: ','image source...' );

	if(!(imgSrc == null || imgSrc == ""|| imgSrc=="image source..."))
	{
		document.getElementById("message").innerHTML = 
			"<img class=\"embed\" src=\""+imgSrc+"\" alt=\""+imgSrc+"\">";
	}
	}*/
	
function updateThread(user, avatar, mess, admin) {

		thread=getPageInfo("thread-id");
		channelTop=getPageInfo("channel-top");
	
       if (window.XMLHttpRequest) {
           xmlhttp = new XMLHttpRequest();
       } 
       
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               document.getElementById("message-area").innerHTML = this.responseText;
               }
       };
      
        xmlhttp.open("POST","ajaxManager.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     	xmlhttp.send("op=2&top="+channelTop+"&thread="+thread+"&message="+mess+"&user="+user+"&avatar="+avatar+"&admin="+admin); 
	}
 
 
/* function loadPage(page){
	thread=getPageInfo(thread-id);
	channel_top=getPageInfo(channel-top);
	
	 if (window.XMLHttpRequest) {
         xmlhttp = new XMLHttpRequest();
     } 

	 xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
             document.getElementById("message-area").innerHTML = this.responseText;
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

 	function delete_post($channel_top, $thread, $chkey, $admin)
{
    $conn=set_connection("threads");
    $sql="UPDATE ".$thread." SET user='admin', body= 'This post was deleted by an administrator.', avatar='default_img.png' WHERE chkey= ".$chkey;
    if($conn->query($sql))
    {fetch_messages($thread, $channel_top, 1, 10, 1);}
}

function kill_post($channel_top, $thread, $chkey)
{
    $conn=set_connection("threads");
    $sql="DELETE FROM ".$thread." WHERE chkey= ".$chkey;
    if($conn->query($sql))
    { fetch_messages($thread, $channel_top, 1, 10, 1);}
}
	
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

function archiveModeOn(){
	return (Boolean( document.getElementById("pageinfo").getAttributeNode("data-archive-mode").value ));
}

function toggleArchiveMode(){
	
	

	if(archiveModeOn())
		{
			document.getElementById("pageinfo").getAttributeNode("data-archive-mode").value = "";
			document.getElementById("archive-mode-toggle").innerHTML = "・Archive Threads";
			document.getElementById("archive-switch").getAttributeNode("style").value = "display: none;"
		}
			
	else
		{
		document.getElementById("pageinfo").getAttributeNode("data-archive-mode").value = "on";
		document.getElementById("archive-mode-toggle").innerHTML = " - Finish";
		document.getElementById("archive-switch").getAttributeNode("style").value = "display: inline-block;"

		}
}

function clickThread(thread){
	
	archived=Boolean(document.getElementById(thread).getElementsByClassName("thr-archived")[0].innerHTML);
	
	channelTop=getPageInfo("channel-top");
	
	if (archiveModeOn())
		{
		toggleThreadArchived(channelTop, thread, archived);
		}
	else 
		{
		target="thread.php?top="+channelTop+"&thread="+thread;
		
		window.location.assign(target);
		
		
		/*
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
 	 	xmlhttp.send("op=7&thread.php?top="+channelTop+"&thread="+thread+"&archived="+archived); 
 	 	*/
 	 	
			
		}
	}
	
function toggleThreadArchived(channelTop, thread, archiveSwitch){
	
	if(archiveSwitch==true)
		confirmText="This thread will be restored, allowing further edits. The thread can be archived again later. Restore thread?";
	else
		confirmText="This thread will be archived and no further edits will be allowed. The thread can be restored later. Archive thread?";
		
	
	if (confirm(confirmText)) {
	 	
		if (window.XMLHttpRequest) {
 	         xmlhttp = new XMLHttpRequest();
 	    } 

 		 xmlhttp.onreadystatechange = function() {
 	         if (this.readyState == 4 && this.status == 200) {
 	        	document.getElementById("message-area").innerHTML = this.responseText;
 	         }
 	     };
 	     
 		xmlhttp.open("POST","ajaxManager.php",true);
 	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	 	xmlhttp.send("op=6&top="+channelTop+"&thread="+thread+"&archive-switch="+Number(!archiveSwitch)); 
 	}
 	}
		 
function toggleImportDialog(){
	modal = document.getElementById('import-dialog');

	if(modal.style.display == "inline-block")
		{modal.style.display = "none";}
	else modal.style.display = "inline-block";
	
}




function hereGoes(){
	
	document.addEventListener('DOMContentLoaded', init, false);
	function init(){
	
	
	importForm = document.forms.namedItem("import-form");
	importForm.addEventListener('input', function(ev){
		document.getElementById("web-src-form").reset();
		ev.preventDefault();
		if (window.XMLHttpRequest) {
	        xmlhttp = new XMLHttpRequest();
	   } 

		 xmlhttp.onreadystatechange = function() {
			// window.alert(this.readyState+" "+this.status);
	        if (this.readyState == 4 && this.status == 200) {
	        	document.getElementById("img-img").setAttribute("src", this.responseText);
	        }
	    };
		
		xmlhttp.open("POST", "upload2.php", true);
	xmlhttp.send(new FormData(importForm));
	}, false);	
	
	}
}
	
function urlImage(){
	document.getElementById("import-form").reset();
	imgSrc=document.getElementById("web-img-src").value;
	if(imgSrc==""|| imgSrc==null)
		{imgSrc="add-img.png";}
	document.getElementById("img-img").setAttribute("src", imgSrc);
	document.getElementById("web-src-form").reset();
}
	
function submitWithImage(user, avatar){
	 admin=getPageInfo("user-admin");
	 
	 imgSrc=document.getElementById("img-img").getAttribute("src");
     
     body="<img class=\"embed\" src=\""+imgSrc+"\" alt=\""+imgSrc+"\">";
     body2=document.getElementById('img-comment').value;
     
     if (body2!= "" && body2 !=null)
    	 {
    	 body+=body2;
    	 }
     
     updateThread(user, avatar, body, admin);
     toggleImportDialog();
     clearImportDialog();
     
}

	function clearImportDialog(){
		document.getElementById("web-src-form").reset();
		document.getElementById("img-img").setAttribute("src", "add-img.png");
		document.getElementById("import-form").reset();
	}
	

