//just a shortcut since I kept doing the same three things over and over
function getPageInfo(_attribute) {
	attribute = "data-" + _attribute;
	return document.getElementById("pageinfo").getAttribute(attribute);
}

function submitMessage(user, avatar, mess, admin) {

	document.getElementById("inputform").reset();
	updateThread(user, avatar, mess, admin);
}

function updateThread(user, avatar, mess, admin) {

	thread = getPageInfo("thread-id");
	channelTop = getPageInfo("channel-top");

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("message-area").innerHTML = this.responseText;
		}
	};

	xmlhttp.open("POST", "ajaxManager.php", true);
	xmlhttp.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	xmlhttp.send("op=2&top=" + channelTop + "&thread=" + thread + "&message="
			+ mess + "&user=" + user + "&avatar=" + avatar + "&admin=" + admin);
}

/*
 * function loadPage(page){ thread=getPageInfo(thread-id);
 * channel_top=getPageInfo(channel-top);
 *
 * if (window.XMLHttpRequest) { xmlhttp = new XMLHttpRequest(); }
 *
 * xmlhttp.onreadystatechange = function() { if (this.readyState == 4 &&
 * this.status == 200) { document.getElementById("message-area").innerHTML =
 * this.responseText; } };
 *
 * xmlhttp.open("POST","ajaxManager.php",true);
 * xmlhttp.setRequestHeader("Content-type",
 * "application/x-www-form-urlencoded");
 * xmlhttp.send("op=3&top="+top+"&thread="+thread+"&page="+page); }
 */
function showCommentBox() {
	document.getElementById("commentBox").style.display = "block";
}

function hideCommentBox() {
	document.getElementById("commentBox").style.display = "none";
}

function postComment(mess, user, avatar) {
	updateThread(mess, user, avatar);
	hideCommentBox();
}

function deletePost(chkey) {

	if (confirm("This post will be replaced with a delete notice--This can't be undone! Really delete?")) {
		thread = getPageInfo("thread-id");
		channelTop = getPageInfo("channel-top");

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("message-area").innerHTML = this.responseText;
			}
		};

		xmlhttp.open("POST", "ajaxManager.php", true);
		xmlhttp.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		xmlhttp.send("op=4&top=" + channelTop + "&thread=" + thread + "&chkey="
				+ chkey);
	}
}

function killPost(chkey) {
	if (confirm("This post will be totally deleted--This can't be undone! Really delete?")) {
		thread = getPageInfo("thread-id");
		channelTop = getPageInfo("channel-top");

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("message-area").innerHTML = this.responseText;
			}
		};

		xmlhttp.open("POST", "ajaxManager.php", true);
		xmlhttp.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		xmlhttp.send("op=5&top=" + channelTop + "&thread=" + thread + "&chkey="
				+ chkey);
	}
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
		xmlhttp.open("GET", "ajaxManager.php?op=1&q=" + str, true);

		xmlhttp.send();
	}
}

function archiveModeOn() {
	return (Boolean(document.getElementById("pageinfo").getAttributeNode(
			"data-archive-mode").value));
}

function toggleArchiveMode() {

	if (archiveModeOn()) {
		document.getElementById("pageinfo").getAttributeNode(
				"data-archive-mode").value = "";
		document.getElementById("archive-mode-toggle").innerHTML = "・Archive Threads";
		document.getElementById("archive-switch").getAttributeNode("style").value = "display: none;"
	}

	else {
		document.getElementById("pageinfo").getAttributeNode(
				"data-archive-mode").value = "on";
		document.getElementById("archive-mode-toggle").innerHTML = "・Finish";
		document.getElementById("archive-switch").getAttributeNode("style").value = "display: inline-block;"

	}
}

function clickThread(thread) {

	archived = Boolean(document.getElementById(thread).getElementsByClassName(
			"thr-archived")[0].innerHTML);

	channelTop = getPageInfo("channel-top");

	if (archiveModeOn()) {
		toggleThreadArchived(channelTop, thread, archived);
	} else {
		target = "thread.php?top=" + channelTop + "&thread=" + thread;

		window.location.assign(target);

		/*
		 * if (window.XMLHttpRequest) { xmlhttp = new XMLHttpRequest(); }
		 *
		 * xmlhttp.onreadystatechange = function() { if (this.readyState == 4 &&
		 * this.status == 200) { window.alert(this.responseText); } };
		 *
		 * xmlhttp.open("POST","ajaxManager.php",true);
		 * xmlhttp.setRequestHeader("Content-type",
		 * "application/x-www-form-urlencoded");
		 * xmlhttp.send("op=7&thread.php?top="+channelTop+"&thread="+thread+"&archived="+archived);
		 */

	}
}

function toggleThreadArchived(channelTop, thread, archiveSwitch) {

	if (archiveSwitch == true)
		confirmText = "This thread will be restored, allowing further edits. The thread can be archived again later. Restore thread?";
	else
		confirmText = "This thread will be archived and no further edits will be allowed. The thread can be restored later. Archive thread?";

	if (confirm(confirmText)) {

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("message-area").innerHTML = this.responseText;
			}
		};

		xmlhttp.open("POST", "ajaxManager.php", true);
		xmlhttp.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		xmlhttp.send("op=6&top=" + channelTop + "&thread=" + thread
				+ "&archive-switch=" + Number(!archiveSwitch));
	}
}

function toggleImportDialog() {
	modal = document.getElementById('import-dialog');

	if (modal.style.display == "inline-block") {
		modal.style.display = "none";
	} else
		modal.style.display = "inline-block";

}

function fileUploadStandby() {

	document.addEventListener('DOMContentLoaded', init, false);
	function init() {

		importForm = document.forms.namedItem("import-form");
		uploadForm = document.forms.namedItem("upload-form");

		importForm.addEventListener('input', function(ev) {
			document.getElementById("web-src-form").reset();
			ev.preventDefault();
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}

			xmlhttp.onreadystatechange = function() {
				// window.alert(this.readyState+" "+this.status);
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("img-img").setAttribute("src",
							this.responseText);
				}
			};

			xmlhttp.open("POST", "upload.php", true);
			xmlhttp.send(new FormData(importForm));
		}, false);


		uploadForm.addEventListener('input', function(ev) {
			ev.preventDefault();
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}

			xmlhttp.onreadystatechange = function() {
				// window.alert(this.readyState+" "+this.status);
				if (this.readyState == 4 && this.status == 200) {
					if(isImage(this.responseText)){
						imgSrc=this.responseText;
					}
					else{
						imgSrc="file-gen-95.png";
					}

					document.getElementById("file-pre").setAttribute("src",	imgSrc);
					document.getElementById("file-pre").setAttribute("title", this.responseText);
					//window.alert(this.responseText);
				}
			};

			xmlhttp.open("POST", "upload.php", true);
			xmlhttp.send(new FormData(uploadForm));
		}, false);
	}
}

function toggleUploadDialog(){
	modal = document.getElementById('upload-dialog');

	if (modal.style.display == "inline-block") {
		modal.style.display = "none";
	} else
		modal.style.display = "inline-block";

}

function submitWithFile(user, avatar){
	admin = getPageInfo("user-admin");

	filename = document.getElementById("file-pre").getAttribute("title");
	if(isImage(filename)){
		imgSrc=filename;
	}
	else{
		imgSrc="file-gen.png";
	}

	//window.alert(filename);

	body = "<div class=\"container file-display\" id=\""+filename+"\">"+
           "<div class=\"thumb-frame\">"+
		   "<img class=\"import-display\" id=\"file-pre2\" src=\""+imgSrc+"\" alt=\"no preview available\">"+
		   "</div>"+
		   "<span class=\"filename-display\"><a href=\""+filename+"\">"+filename+"</a></span>"+
           "</a></div>"
	body2 = document.getElementById('file-comment').value;

	if (body2 != "" && body2 != null) {
		body=body2+"<hr>"+body;
	}

	updateThread(user, avatar, body, admin);
	//toggleImportDialog();
	clearImportDialog();

}

function urlImage() {
	document.getElementById("import-form").reset();
	imgSrc = document.getElementById("web-img-src").value;
	if (imgSrc == "" || imgSrc == null) {
		imgSrc = "add-img.png";
	}
	document.getElementById("img-img").setAttribute("src", imgSrc);
	document.getElementById("web-src-form").reset();
}

function submitWithImage(user, avatar) {
	admin = getPageInfo("user-admin");

	imgSrc = document.getElementById("img-img").getAttribute("src");

	body = "<img class=\"embed\" src=\"" + imgSrc + "\" alt=\"" + imgSrc
			+ "\">";
	body2 = document.getElementById('img-comment').value;

	if (body2 != "" && body2 != null) {
		body += body2;
	}

	updateThread(user, avatar, body, admin);
	//toggleImportDialog();
	clearImportDialog();

}

function clearImportDialog() {
	document.getElementById("web-src-form").reset();
	document.getElementById("img-img").setAttribute("src", "add-img.png");
	document.getElementById("import-form").reset();
}

function useDefault(user) {
	if (confirm("Your current avatar will be deleted from the server and your default image will be used instead. Are you sure?")) {

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				singlePOST("default-img", this.responseText, "setAvatar.php");
				document.getElementById("topnav-icon").setAttribute("src",
						this.responseText);

			}

		};

		xmlhttp.open("POST", "ajaxManager.php", true);
		xmlhttp.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		xmlhttp.send("op=7&user=" + user);
	}

}

function singlePOST(name, value, target) {

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}

	xmlhttp.open("POST", target, true);
	xmlhttp.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	xmlhttp.send(name + "=" + value);

}

function handleCAPTCHA() {

	greca // <---??????? Pretty sure I fell asleep while I was working... ><
	// I'm sure it's meant to be "grecaptcha" but I have no idea what came next.
	singlePOST(name, value, "https://www.google.com/recaptcha/api/siteverify")

}

function likePost(chKey) {

	addReaction(0, chKey);
	// document.getElementById(chKey).getElementsByClassName("post-react-a")[0].setAttribute("href",
	// "javascript:removeReaction("+chKey+")");//not finished!
}

function dislikePost(chKey) {
	addReaction(2, chKey);
	// document.getElementById(chKey).getElementsByClassName("post-react-a")[1].setAttribute("href",
	// "javascript:removeReaction("+chKey+")");//not finished!
}

function addReaction(index, chKey) {

	// rxCode--;
	thread = getPageInfo("thread-id");
	post = document.getElementById(chKey)
	userOP = post.getElementsByClassName("name-left")[0].innerHTML;
	userRX = document.getElementById("topnav-user-id").innerHTML;
	rxCode = (-(index - 1));
	window.alert(rxCode);

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			post.getElementsByClassName("post-react tally")[0].innerHTML = this.responseText;
			// post.getElementsByClassName("post-react-a")[index].setAttribute("style",
			// "color:#f1f1f1;")
		}

	};

	xmlhttp.open("POST", "ajaxManager.php", true);
	xmlhttp.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	xmlhttp.send("op=8&thread=" + thread + "&chKey=" + chKey + "&rxCode="
			+ (rxCode) + "&userOP=" + userOP + "&userRX=" + userRX);
}

function removeReaction(chKey) {
	userRX = document.getElementById("topnav-user-id").innerHTML;

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			window.alert(this.responseText);
		}

	};

	xmlhttp.open("POST", "ajaxManager.php", true);
	xmlhttp.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	xmlhttp.send("op=9&chKey=" + chKey + "&userRX=" + userRX);
}

//this function assumes nobody is trying to trick it and is NOT intended for validation!
//this is only for the purpose of handling display.
function isImage(filename){
	return ( (filename.endsWith(".png")) ||
			 (filename.endsWith(".jpg")) ||
			 (filename.endsWith(".gif")) ||
			 (filename.endsWith(".bmp")) );
}

function dummyFunction() {
	window.alert("Hello, World!");

}