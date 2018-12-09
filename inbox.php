<?php

session_start();
require_once 'directTemplate.php';
require_once 'htmlManager.php';
require_once 'sqlManager.php';

if(!isset($_SESSION["user"]))
{
    header("Location: index.php?login=0");
}


//$user_admin=$_SESSION["admin"];
$channel_top="direct";
$recipient_err="";
$recipient="";

$partner = "@mater";
$thread = get_DM_key($_SESSION["user"], $partner);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inbox - lptColors</title>
    <link rel="stylesheet" type="text/css" href="lptcolors.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="lptcolors.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
</head>

<body>
    
    <?php 
    $conn = set_connection("channels");

    $stmt = "INSERT INTO ". $channel_top." (chIndex, chTitle, chPrivate, chAllowedUsers) VALUES (?,?,?,?)";
    $sql = $conn->prepare($stmt);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["target-user"])) {
            $title_err = "Please enter a user to send to.";
        } else {
            $recipient = test_input($_POST["title"]);
        }

        if (empty($_POST["message"])) {
            $message_err = "Please enter a message.";
        } else {
            $message = test_input($_POST["message"]);
        }

       /* $id = get_DM_key();
        
        $sql->bind_param("ssis", $id, $title, $private, $allowed_users);
        if ( $sql->execute()) {
         //   header("Location: thread.php?top = ".$channel_top."&thread = ".$id."");
        }
        else echo($conn->error);*/
    }
    ?>

    <?php navbars("monarchs");?>

    <div class="container thread" id="pageinfo" data-archive-mode="" data-thread-id="<?php echo $thread;?>" data-channel-top="<?php echo $channel_top;?>" style="border-color:var(--color-acc-<?php echo $channel_top;?>); border-radius: 7px; color:#000000;">

        <!--      <div class="container archive-switch-notice" id="archive-switch" style="display:none;">
         <i class="material-icons archived">lock_open</i>
         <span style= "font-size: 24px; position: relative; bottom: 18px;">
         	You're now in Archive Mode. Click on a thread to archive or restore it (The system will ask for confirmation).
         	When you're done, click "Finish" to go back to Standard Mode.
        </span>
        </div>-->
        
        <!-- import-dialog-->
  
<div class="container import-dialog" id="new-message"><a
href="javascript:toggleDialog('new-message')"><span class="close"><i
class="material-icons">close</i></span></a>



    <form action="#" id="new-direct-message" method="post">
       
            <h1>New Message</h1>
            <hr>

            <label><b>Send to: </b>
                <input type="text" id="target-user" placeholder="@john" onKeyUp="userExists(this.value)">
                <span id="recipient-error"> </span>
            </label><br><br>

            <label><b>Message: </b>
                <textarea id="message" name="message" rows="6" cols="80"></textarea>
           <!-- <input type="text" name="message" id="message-contents" value="<?php echo $message; ?>" required>
-->
            <hr>
            </label>

            <button type="button" id="new-message-dialog" onclick="newDirectMessage()">Send Message</button>

        
    </form>
        </div>
<!-- import-dialog end -->
        

        <div class="message-text" style="display:inline-block;">
            <h2><a href="javascript:toggleDialog('new-message')">・Send a new message</a></h2>
        </div>


    </div>


    <div class="thread-area" id="message-area">

        <?php 
        update_direct_channel($_SESSION["user"]);
?>

    </div>

</body>

</html>
