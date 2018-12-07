//just a shortcut since I kept doing the same three things over and over

/* jshint browser:true */
/* jshint -W117 */
/* eslint-env browser*/
/* eslint no-unused-vars: "off" */ //temp--I got tired of it warning me about the dummyFunction.
/* eslint no-undef: "off" */


function getPageInfo(attribute) {
    attribute = "data-" + attribute;
    return document.getElementById("pageinfo").getAttribute(attribute);
}



function submitMessage(user, avatar, mess, admin) {

    document.getElementById("inputform").reset();
    updateThread(user, avatar, mess, admin);
}

function submitDirectMessage(mess) {

    var user=document.getElementById("topnav-user-id").innerHTML;
    var avatar=document.getElementById("topnav-icon").getAttribute("src");
    var admin=0;
    document.getElementById("inputform").reset();
    updateThread(user, avatar, mess, admin, "direct");
}

function updateThread(user, avatar, mess, admin, dbname) {

    dbname = (typeof dbname !== 'undefined') ?  dbname : "threads";
    
    var thread = getPageInfo("thread-id");
    var channelTop = getPageInfo("channel-top");
    var xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("message-area").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("POST", "ajaxManager.php", true);
    xmlhttp.setRequestHeader("Content-type",
        "application/x-www-form-urlencoded");
    xmlhttp.send("op=2&top=" + channelTop + "&thread=" + thread + "&message=" +
        mess + "&user=" + user + "&avatar=" + avatar + "&admin=" + admin+"&dbname="+dbname);
}

//this is seriously getting ridiculous, but it's easier to duplicate everything
//than to go through and change all the arguments

//gaaaaaaaaaaah I ended up fixing things properly anywaaaaaaaaaaay!
//serves me right for tying to cheat, I guess.
function updateDirect(user, avatar, mess, admin) {
    
   // window.alert(user+" "+avatar+" "+mess+" "+admin);}

   
    var recipient=getPageInfo("thread-id").replace(user, "");
    var xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("message-area").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("POST", "ajaxManager.php", true);
    xmlhttp.setRequestHeader("Content-type",
        "application/x-www-form-urlencoded");
    xmlhttp.send("op=13&message=" +
        mess + "&sender=" + user + "&avatar=" + avatar + "&recipient=" + recipient+"inbox=false");
}

/*
 * function loadPage(page){ thread=getPageInfo(thread-id);
 * channel_top=getPageInfo(channel-top);
 *
 * if (window.XMLHttpRequest) {xmlhttp = new XMLHttpRequest(); }
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
        var xmlhttp;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("message-area").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("POST", "ajaxManager.php", true);
        xmlhttp.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        xmlhttp.send("op=4&top=" + channelTop + "&thread=" + thread + "&chkey=" +
            chkey);
    }
}

function killPost(chkey) {
    if (confirm("This post will be totally deleted--This can't be undone! Really delete?")) {
        thread = getPageInfo("thread-id");
        channelTop = getPageInfo("channel-top");

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("message-area").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("POST", "ajaxManager.php", true);
        xmlhttp.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        xmlhttp.send("op=5&top=" + channelTop + "&thread=" + thread + "&chkey=" +
            chkey);
    }
}

function searchUsers(str) {
    if (str === "") {
        document.getElementById("userResults").innerHTML = "";
        return;
    } else {

        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("userResults").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "ajaxManager.php", true);
        xmlhttp.setRequestHeader("Content-type",
                                 "application/x-www-form-urlencoded");
        xmlhttp.send("op=1&q=" + str);

    }
}

function userExists(str) {
    
    var error_field = document.getElementById("recipient-error");
    
    if (str === "") {
        error_field.innerHTML = "";
        return;
    }
    var xmlhttp;
    if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // window.alert(this.responseText);
            if (this.responseText == false) //jshint ignore:line
            {
                error_field.innerHTML = "Sorry, user not found.";
            } else {
                error_field.innerHTML = "";
            }
        }
    };

    xmlhttp.open("POST", "ajaxManager.php", true);
    xmlhttp.setRequestHeader("Content-type",
                             "application/x-www-form-urlencoded");
    xmlhttp.send("op=12&q=" + str);
   
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
        document.getElementById("archive-switch").getAttributeNode("style").value = "display: none;";
    } else {
        document.getElementById("pageinfo").getAttributeNode(
            "data-archive-mode").value = "on";
        document.getElementById("archive-mode-toggle").innerHTML = "・Finish";
        document.getElementById("archive-switch").getAttributeNode("style").value = "display: inline-block;";

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
         * if (window.XMLHttpRequest) {xmlhttp = new XMLHttpRequest(); }
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

    if (archiveSwitch == true) { // jshint ignore:line
        confirmText = "This thread will be restored, allowing further edits. The thread can be archived again later. Restore thread?";
    } else {
        confirmText = "This thread will be archived and no further edits will be allowed. The thread can be restored later. Archive thread?";
    }

    if (confirm(confirmText)) {

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("message-area").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("POST", "ajaxManager.php", true);
        xmlhttp.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        xmlhttp.send("op=6&top=" + channelTop + "&thread=" + thread +
            "&archive-switch=" + Number(!archiveSwitch));
    }
}

function toggleDialog(dialog_id) {
    modal = document.getElementById(dialog_id);

    if (modal.style.display == "inline-block") {
        modal.style.display = "none";
    } else {
        modal.style.display = "inline-block";
    }

}



//I'd like to split up this giant chimera function, but I'm busy now.
function fileUploadStandby() {

    document.addEventListener('DOMContentLoaded', init, false);

    function init() {

        importForm = document.forms.namedItem("import-form");
        uploadForm = document.forms.namedItem("upload-form");

        importForm.addEventListener('input', function (ev) {
            document.getElementById("web-src-form").reset();
            ev.preventDefault();
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            }

            xmlhttp.onreadystatechange = function () {
                // window.alert(this.readyState+" "+this.status);
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "0") {
                        document.getElementById("import-error").innerHTML =
                            "Sorry, this filetype is not supported.";
                        document.getElementById("import-form").reset();
                    } else {
                        document.getElementById("import-error").innerHTML = "";
                        document.getElementById("img-img").setAttribute("src",
                            this.responseText);
                    }
                }
            };

            xmlhttp.open("POST", "upload.php", true);
            xmlhttp.send(new FormData(importForm));
        }, false);


        uploadForm.addEventListener('input', function (ev) {
            ev.preventDefault();
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            }

            xmlhttp.onreadystatechange = function () {
                // window.alert(this.readyState+" "+this.status);
                if (this.readyState == 4 && this.status == 200) {
                    window.alert(typeof (this.responseText));
                    if (this.responseText == "0") {
                        document.getElementById("upload-error").innerHTML =
                            "Sorry, this filetype is not supported.";
                        document.getElementById("upload-form").reset();
                    } else {
                        document.getElementById("upload-error").innerHTML = "";
                        if (isImage(this.responseText)) {
                            imgSrc = this.responseText;
                        } else {
                            imgSrc = "file-gen-95.png";
                        }

                        document.getElementById("file-pre").setAttribute("src", imgSrc);
                        document.getElementById("file-pre").setAttribute("title", this.responseText);
                        //window.alert(this.responseText);
                    }
                }
            };

            xmlhttp.open("POST", "upload.php", true);
            xmlhttp.send(new FormData(uploadForm));
        }, false);
    }
}

function toggleUploadDialog() {
    modal = document.getElementById('upload-dialog');

    if (modal.style.display == "inline-block") {
        modal.style.display = "none";
    } else {
        modal.style.display = "inline-block";
    }
}

function submitWithFile(user, avatar) {
    admin = getPageInfo("user-admin");

    filename = document.getElementById("file-pre").getAttribute("title");
    if (isImage(filename)) {
        imgSrc = filename;
    } else {
        imgSrc = "file-gen.png";
    }

    //window.alert(filename);




    body = "<div class=\"container file-display\" id=\"" + filename + "\">" +
        "<div class=\"thumb-frame\">" +
        "<img class=\"import-display\" id=\"file-pre2\" src=\"" + imgSrc + "\" alt=\"no preview available\">" +
        "</div>" +
        "<span class=\"filename-display\"><a href=\"" + filename + "\" download>" + filename + "</a></span>" +
        "</a></div>";
    body2 = document.getElementById('file-comment').value;

    if (body2 !== "" && body2 !== null) {
        body = body2 + "<hr>" + body;
    }

    updateThread(user, avatar, body, admin);

}

function newMessageJson() {
    user = document.getElementById("topnav-user-id").innerHTML;
    avatar = document.getElementById("topnav-icon").innerHTML;
    body = "PeNRFWFTRGjiofwrht03h2nwkfce c20fconvgkc sl";

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("message-area").innerHTML = this.responseText; //(JSON.parse(this.responseText));
        }
    };

    xmlhttp.open("POST", "ajaxManager.php", true);
    xmlhttp.setRequestHeader("Content-type",
        "application/x-www-form-urlencoded");
    xmlhttp.send("op=10&user=" + user + "&avatar=" + avatar + "&message=" + body);
}

function basicMessage(message0) {
    /* jshint -W107 */
    channel_top = getPageInfo("channel-top");
    admin = getPageInfo("user-admin");

    message = JSON.parse(message0);

    parent00 = document.createElement("DIV");
    parent00.setAttribute("class", "container");
    parent00.setAttribute("id", message.key);
    parent00.setAttribute("style", "border-color:var(--color-con-" + channel_top + ");");

    avatar = document.createElement("IMG");
    avatar.setAttribute("class", "a");
    avatar.setAttribute("src", message.avatar);
    avatar.setAttribute("alt", "Avatar");
    avatar.setAttribute("style", "border-color:var(--color-con-" + channel_top + ");");

    post_react00 = document.createElement("DIV");
    post_react00.setAttribute("class", "post-react");

    post_react_a0 = document.createElement("A");
    post_react_a0.setAttribute("class", "post-react-a");
    post_react_a0.setAttribute("href", "javascript:likePost('message.key')");

    post_react_i0 = document.createElement("I");
    post_react_i0.setAttribute("class", "material-icons post-react");
    post_react_i0.appendChild(document.createTextNode("expand_less"));

    post_react_tally = document.createElement("SPAN");
    post_react_tally.setAttribute("class", "post-react tally");
    post_react_tally.appendChild(document.createTextNode(message.tally));

    post_react_i1 = document.createElement("SPAN");
    post_react_i1.setAttribute("class", "post-react-a");
    post_react_i1.setAttribute("style", "display:none;");

    post_react_a2 = document.createElement("A");
    post_react_a2.setAttribute("class", "post-react-a");
    post_react_a2.setAttribute("href", "javascript:dislikePost('this->key')");

    post_react_i2 = document.createElement("I");
    post_react_i2.setAttribute("class", "material-icons post-react");
    post_react_i2.appendChild(document.createTextNode("expand_more"));

    username_a = document.createElement("A");
    username_a.setAttribute("href", "userProfile.php?user=" + message.name);

    username_disp = document.createElement("SPAN");
    username_disp.setAttribute("class", "name-left");
    username_disp.appendChild(document.createTextNode(message.name));

    message_disp = document.createElement("DIV");
    message_disp.setAttribute("class", "message-text");

    message_para = document.createElement("P");
    message_para.appendChild(document.createTextNode(message.body));

    time_disp = document.createElement("SPAN");
    time_disp.setAttribute("class", "right-corner");
    time_disp.appendChild(document.createTextNode(message.time));

    kill_disp = document.createElement("SPAN");
    kill_disp.setAttribute("class", "right-corner");
    //time_disp.appendChild(document.createTextNode("message.time"));

    if (admin) {
        kill_disp.appendChild(document.createTextNode("delete post"));
        kill_disp.addEventListener("click", killPost("this one"));
    } else {
        kill_disp.appendChild(document.createTextNode(" "));
    }

    username_a.appendChild(username_disp);

    post_react_a0.appendChild(post_react_i0);
    post_react_a2.appendChild(post_react_i2);

    post_react00.appendChild(post_react_a0);
    post_react00.appendChild(post_react_tally);
    post_react00.appendChild(post_react_i1);
    post_react00.appendChild(post_react_a2);

    message_disp.appendChild(message_para);

    parent00.appendChild(avatar);
    parent00.appendChild(post_react00);
    parent00.appendChild(username_a);
    parent00.appendChild(message_disp);
    parent00.appendChild(time_disp);
    parent00.appendChild(document.createElement("BR"));
    parent00.appendChild(kill_disp);

    // document.body.appendChild(parent00);

    return parent00;
}

function fileBox(data0) {

    data = JSON.parse(data0);

    parentf0 = document.createElement("DIV");
    parentf0.setAttribute("class", "container file-display");
    // parentf0.setAttribute("id", data.fpath.replace("files/",""));

    thumb_frame = document.createElement("DIV");
    thumb_frame.setAttribute("class", "thumb-frame");

    thumb_display = document.createElement("IMG");
    thumb_display.setAttribute("class", "import-display");
    thumb_display.setAttribute("src", data.fsrc);
    thumb_display.setAttribute("alt", "no preview available");
    //import_display.setAttribute("id", data.fpath);

    filename_display = document.createElement("SPAN");
    filename_display.setAttribute("class", "filename-display");

    filename_link = document.createElement("A");
    filename_link.setAttribute("href", data.fpath);
    filename_link.setAttribute("download", data.fpath.replace("files/", ""));
    filename_link.appendChild(document.createTextNode(data.fpath.replace("files/", "")));

    thumb_frame.appendChild(thumb_display);
    filename_display.appendChild(filename_link);

    comment = document.getElementById('file-comment').value;

    if (comment !== "" && comment !== null) {
        comment_disp = document.createTextNode(comment);
        parentf0.appendChild(comment_disp);
        parentf0.appendChild(document.createElement("HR"));
    }

    parentf0.appendChild(thumb_frame);
    parentf0.appendChild(filename_display);

    return parentf0;
}

function generateWithFile(message0) { //, data0){
    base = basicMessage(message0);
    data0 = JSON.stringify({
        "fpath": "files/nope.py",
        "fsrc": "file-gen.png"
    });
    file = fileBox(data0);

    base.getElementsByClassName("message-text")[0].appendChild(file);
    return base;
}

function fetchJson() { //badly named function ><
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.body.appendChild(generateWithFile(this.responseText));
        }

    };

    xmlhttp.open("POST", "ajaxManager.php", true);
    xmlhttp.setRequestHeader("Content-type",
        "application/x-www-form-urlencoded");
    xmlhttp.send("op=11");
}



function urlImage() {
    document.getElementById("import-form").reset();
    imgSrc = document.getElementById("web-img-src").value;
    if (imgSrc === "" || imgSrc === null) {
        imgSrc = "add-img.png";
    }
    document.getElementById("img-img").setAttribute("src", imgSrc);
    document.getElementById("web-src-form").reset();
}

function submitWithImage(user, avatar) {
    admin = getPageInfo("user-admin");

    imgSrc = document.getElementById("img-img").getAttribute("src");

    body = "<img class=\"embed\" src=\"" + imgSrc + "\" alt=\"" + imgSrc +
        "\">";
    body2 = document.getElementById('img-comment').value;

    if (body2 !== "" && body2 !== null) {
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

        xmlhttp.onreadystatechange = function () {
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

    //  greca // <---??????? Pretty sure I fell asleep while I was working... ><
    // I'm sure it's meant to be "grecaptcha" but I have no idea what came next.
    singlePOST(name, value, "https://www.google.com/recaptcha/api/siteverify");

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
    var thread = getPageInfo("thread-id");
    var post = document.getElementById(chKey);
    var userOP = post.getElementsByClassName("name-left")[0].innerHTML;
    var userRX = document.getElementById("topnav-user-id").innerHTML;
    var rxCode = (-(index - 1));
    var channelTop = getPageInfo("channel-top");
    var op=8;
    if(channelTop==="direct"){
        op=9;
    }
   // window.alert(rxCode);

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            post.getElementsByClassName("post-react tally")[0].innerHTML = this.responseText;
            // post.getElementsByClassName("post-react-a")[index].setAttribute("style",
            // "color:#f1f1f1;")
        }

    };
    
    xmlhttp.open("POST", "ajaxManager.php", true);
    xmlhttp.setRequestHeader("Content-type",
        "application/x-www-form-urlencoded");
    xmlhttp.send(    longString="op="+op+"&thread=" + thread + "&chKey=" + chKey + "&rxCode=" +
                 (rxCode) + "&userOP=" + userOP + "&userRX=" + userRX);
}



//this function assumes nobody is trying to trick it and is NOT intended for validation!
//this is only for the purpose of handling display.
function isImage(filename) {
    return ((filename.endsWith(".png")) ||
        (filename.endsWith(".jpg")) ||
        (filename.endsWith(".gif")) ||
        (filename.endsWith(".bmp")));
}

function sendDirectMessage(){
    
    var recipient=document.getElementById("target-user").value;
    var message=document.getElementById("message").value;
    var sender=document.getElementById("topnav-user-id").innerHTML;
    var avatar=document.getElementById("topnav-icon").getAttribute("src");
    
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("message-area").innerHTML=this.responseText;
        }

    };
    
    xmlhttp.open("POST", "ajaxManager.php", true);
    xmlhttp.setRequestHeader("Content-type",
                             "application/x-www-form-urlencoded");
    xmlhttp.send("op=13&sender="+sender+"&recipient="+recipient+"&message="+message+"&avatar="+avatar+"inbox=true");

}


function dummyFunction() {
    window.alert("Hello, World!");

}

/*function removeReaction(chKey) {
    var userRX = document.getElementById("topnav-user-id").innerHTML;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.alert(this.responseText);
        }

    };

    xmlhttp.open("POST", "ajaxManager.php", true);
    xmlhttp.setRequestHeader("Content-type",
        "application/x-www-form-urlencoded");
    xmlhttp.send("op=9&chKey=" + chKey + "&userRX=" + userRX);
}*/