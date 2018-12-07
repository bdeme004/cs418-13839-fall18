<?php

require 'htmlpurifier-4.10.0-standalone/HTMLPurifier.standalone.php';



function test_input($data) {
/*      $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);  */

    //------------------------------------------------------------------------
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $data=$purifier->purify($data);

    //-------------------------------------------------------------------------

    return $data;
}

function set_connection($_dbname){
    $servername = "localhost";
    $username = "admin";
    $password = "monarchs";
    $dbname = $_dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


/*function fetch_messages ($thread, $channel_top, $page, $cap, $admin) {
    $conn=set_connection("threads");
    $sql="SELECT * FROM `" . $thread . "` ORDER BY chKey DESC";
    if($result=$conn->query($sql)){
        $index=1;
        $first=1+(10*($page-1));
        $last=$first+9;
        while($row= ($result->fetch_assoc())){
            $newraw=array();
            foreach ($row as $field){
                array_push($newraw, $field);
            }
            $newmess=new message($newraw);

            if($index>=$first && $index<=$last )
            {
            $newmess->print_with_format(($index%2), $channel_top, $admin);
            $index=$index+1;
        }
    }
    }
     else echo("Error executing ". $sql. ": ".$conn->error);
}*/

function fetch_messages ($thread, $channel_top, $db_name, $admin) {
    $conn=set_connection($db_name);
    $sql="SELECT * FROM `" . $thread . "` ORDER BY chKey DESC";
    if($result=$conn->query($sql)){
        $index=2;
      /*  
        $first=1+(10*($page-1));
        $last=$first+9;*/
        while($row= ($result->fetch_assoc())){
            $newraw=array();
            foreach ($row as $field){
                array_push($newraw, $field);
            }
            $newmess=new message($newraw);

       /*     if($index>=$first && $index<=$last )
            {*/
                $newmess->print_with_format(($index%2), $channel_top, $admin);
         /*       $index=$index+1;
            }*/
        }
    }
    else echo("Error executing ". $sql. ": ".$conn->error);
}

/*function fetch_direct_messages ($thread, $channel_top, $page, $cap, $admin) {
    $conn=set_connection("direct");
    $sql="SELECT * FROM `" . $thread . "` ORDER BY chKey DESC";
    if($result=$conn->query($sql)){
        while($row= ($result->fetch_assoc())){
            $newraw=array();
            foreach ($row as $field){
                array_push($newraw, $field);
            }
            $newmess=new message($newraw);
            
            $newmess->print_with_format(0, $channel_top, $admin);
        
          
        }
    }
    else echo("Error executing ". $sql. ": ".$conn->error);
}*/

function generate_thread($conn, $thread_index) {

  $conn->query("CREATE TABLE IF NOT EXISTS `".$thread_index."` (
  `user` varchar(13) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` text NOT NULL,
  `tally` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;");
}

/*
function generate_direct($thread_index) {

    $conn=set_connection("direct");
    
$conn->query("CREATE TABLE IF NOT EXISTS `".$thread_index."` (
`user` varchar(13) NOT NULL,
`body` text NOT NULL,
`creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`chKey` int(11) NOT NULL AUTO_INCREMENT,
`avatar` text NOT NULL,
`tally` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;");
    
    $conn->close();    
    
    $conn=set_connection("channels");
    
    $conn->query("INSERT ")
}
*/

function get_DM_key($user1, $user2){
    $user1=($user1);
    if((strcmp($user1, $user2))>0){
        return $user1.$user2;
    }
    else{
        return $user2.$user1;
    }
}


function post_to_dm_channel($user, $user2, $avatar, $newest){
    //messy function ><
    $index=get_DM_key($user, $user2);
    
    $conn=set_connection("channels");
    $stmt="INSERT INTO `direct` (thIndex, user, avatar, user2, newest) VALUES(?,?,?,?,?)";
    $stmt.=" ON DUPLICATE KEY UPDATE newest=VALUES(newest), avatar=VALUES(avatar), chKey=NOW()";
    
    $sql=$conn->prepare($stmt);
    
   // print($conn->error."<br> ".$stmt);
    
    $sql->bind_param("sssss", $index, $user, $avatar, $user2, $newest);

    if(!$sql->execute())
        {echo ("Sorry, Message not sent.");
         print($conn->error."<br> ".$stmt);
        }

    $conn->close();
        
        $conn=set_connection("direct");
        $stmt="INSERT INTO `".$index."` (user, body, avatar) VALUES(?,?,?)";
       // $stmt.=" ON DUPLICATE KEY UPDATE newest=VALUES(newest), avatar=VALUES(avatar), chKey=NOW()";

        $sql=$conn->prepare($stmt);

        // print($conn->error."<br> ".$stmt);

        $sql->bind_param("sss", $user, $newest, $avatar);

        if(!$sql->execute()){
           echo ("Sorry, Message not sent.");
             print($conn->error."<br> ".$stmt);
            }

        $conn->close();
}


function search_users($q){

$conn=set_connection("users");
$sql="SELECT handle, avatar FROM usertable WHERE handle LIKE '%". $q . "%';";
$result = $conn->query($sql);

while ($row=$result->fetch_assoc()){
$name=$row["handle"];
$avatar=$row["avatar"];

$user= new message($name, $avatar, "", 803, 803);
$user->print_as_searchresult(1, "monarchs");

$odd++;
}
}

function user_exists($q){

$conn=set_connection("users");
$sql="SELECT (EXISTS(SELECT handle FROM usertable WHERE handle LIKE '". $q . "%')) AS 'userExists'";
if($result = $conn->query($sql)){
print $result->fetch_assoc()["userExists"];
}
$conn->close();
}

function user_exists_strict($q){

$conn=set_connection("users");
$sql="SELECT (EXISTS(SELECT handle FROM usertable WHERE handle = '". $q . "')) AS 'userExists'";

if($result = $conn->query($sql)){
return $result->fetch_assoc()["userExists"];
}
$conn->close();
}

function update_channel($channel_top, $admin){
    $conn=set_connection("channels");

    $sql="SELECT * FROM ". $channel_top .";";
    if ($result=$conn->query($sql))
    {
        $index=1;
        while($thread_list=$result->fetch_assoc()){
            $thread=array();
            foreach ($thread_list as $field){
                array_push($thread, $field);
            }
            $new_thread=new thread($thread);
            $index=$index+1;
            $new_thread->print_with_format(($index%2), $channel_top, $admin);
        }
    }
    else {
        echo "issue executing";
        error_log($conn->error .". SQL: ". $sql);
        echo $conn->error .". SQL: ". $sql;
}
}

function update_direct_channel($user){
    $conn=set_connection("channels");

    $sql="SELECT * FROM `direct` WHERE user='".$user."' OR user2='".$user."' ORDER BY chKey DESC;";
    if ($result=$conn->query($sql))
    {
        while($direct_list=($result->fetch_assoc())){
            $direct=array();
            foreach ($direct_list as $field){
                array_push($direct, $field);
            }
            $new_thread=new directm($direct);
            $new_thread->print_with_format();
        }
    }
    else {
        echo "issue executing";
        error_log($conn->error .". SQL: ". $sql);
        echo $conn->error .". SQL: ". $sql;
    }
   // echo $sql;
}


//I actually have no idea why the parameters are coming in in this order.
//I'm busy, though, so rather than track it down I just rearranged them here.
//UPDATE: hey, I fixed it!
function update_thread($body, $thread, $user, $avatar, $admin, $channel_top="monarchs", $db_name="threads" ){
    $conn=set_connection($db_name);
    $stmt="INSERT INTO `". $thread."` (user, body, avatar) VALUES (?,?,?)";
    $sql = $conn->prepare($stmt);

  //  echo $conn->error;
    //print("<br> ".$stmt);
    
  /*  $user=$user;
    $avatar=$avatar;
    $body=$body;*/

    $sql->bind_param("sss", $user, $body, $avatar);

    if($sql->execute()){
        fetch_messages($thread, $channel_top, $db_name, $admin);

    }
    else
    {echo ("Sorry, Message not sent.");
    echo $conn->error;
    print("<br> ".$stmt);
    }
    $conn->close();
}

/*function update_thread($body, $channel_top, $thread, $user, $avatar, $admin){
    $conn=set_connection("threads");
    $stmt="INSERT INTO `". $thread."` (user, body, avatar) VALUES (?,?,?)";
    $sql = $conn->prepare($stmt);

    //  echo $conn->error;
    //print("<br> ".$stmt);

    /*  $user=$user;
    $avatar=$avatar;
    $body=$body;

    $sql->bind_param("sss", $user, $body, $avatar);

    if($sql->execute()){
        fetch_messages($thread, $channel_top, "threads", $admin);

    }
    else
    {echo ("Sorry, Message not sent.");
     echo $conn->error;
     print("<br> ".$stmt);
    }
}*/



/*function update_direct($body, $thread, $user, $avatar, $admin, $channel_top="monarchs"){
    $conn=set_connection("direct");
    $stmt="INSERT INTO `". $thread."` (user, body, avatar) VALUES (?,?,?)";
    $sql = $conn->prepare($stmt);

    print($conn->error."<br> ".$stmt);

    $sql->bind_param("sss", $user, $body, $avatar);

    if($sql->execute()){
                
        fetch_messages($thread, $channel_top, "direct", $admin);

    }
    else
    {echo ("Sorry, Message not sent.");
     echo $conn->error;
     print("<br> ".$stmt);
    }
}*/


function count_pages($thread)
{
    $conn=set_connection("threads");
    $sql="SELECT CEILING(COUNT(chKey)/10) AS numPosts FROM ".$thread;
    if($result = $conn->query($sql))
    {
        return ($result->fetch_assoc()["numPosts"]);
    }
    else return 0;
}

function delete_post($channel_top, $thread, $chkey, $admin)
{
    $conn=set_connection("threads");
    $sql="UPDATE ".$thread." SET user='admin', body= 'This post was deleted by an administrator.', avatar='default_img.png' WHERE chkey= ".$chkey;
    if($conn->query($sql))
    {fetch_messages($thread, $channel_top, "threads", 1);}
}

function kill_post($channel_top, $thread, $chkey)
{
    $conn=set_connection("threads");
    $sql="DELETE FROM `".$thread."` WHERE chkey= ".$chkey;
    if($conn->query($sql))
    { fetch_messages($thread, $channel_top, "threads", 1);}
}

function toggle_thread_archived($channel_top, $thread, $new_archive_setting)
{
     $conn=set_connection("channels");
    $sql="UPDATE ".$channel_top." SET chArchived=".$new_archive_setting." WHERE chIndex='".$thread."'";
    if($conn->query($sql))
    {
        if ($new_archive_setting==true)
       {
        update_channel($channel_top, 1);
       }
       else
       update_channel($channel_top, 1);
    }
    else echo $conn->error . $sql;
}

////i'm sure there's a better way to do this @_@
function isArchived($channel_top, $thread){
    $conn=set_connection("channels");
    $sql= "SELECT chArchived from ".$channel_top." WHERE chIndex='".$thread."'";

    if($result=$conn->query($sql))
    {
        return $result->fetch_assoc()["chArchived"];

    }
    else  return $conn->error."<br>". $sql;
}

function test_image($src){
    if (!strpos($src, "gravatar.com/")){ //if it's not a gravatar image...
        if (!(file_exists($src))) //...and it doesn't exist...
        {
            return "default_img_inf.png"; //...return the "image not found" fallback.
        }
    }
    return $src; // just return it as-is.
}

function use_default($user){
    return get_gravatar($user);
}

function get_gravatar($user){
    $conn=set_connection("users");
    $sql="SELECT email FROM usertable WHERE handle=\"".$user."\"";
    if($result=$conn->query($sql))
    {
        $email=$result->fetch_assoc()["email"];
        $email=md5( strtolower( trim( $email ) ) ) ;
        $avatar= "https://www.gravatar.com/avatar/" . $email. "?d=identicon&s=50";
        $sql="UPDATE usertable SET avatar=\"".$avatar."\" WHERE handle=\"".$user."\"";
        if($result=$conn->query($sql))
        {
        print $avatar;
        }
    }
   // print $conn->error. $sql; // this is seriously bad error handling @_@

}

function add_reaction($thread, $chKey, $rxCode, $userOP, $userRX, $db="threads"){
    // this could be SERIOUSLY simplified with the [INSERT... ON DUPLICATE KEY UPDATE] syntax
    // that I literally JUST found out exists. Busy now, though. 

    $conn=set_connection($db);

   $tally=0;
   $no_effect=true;
   $sql0="SELECT (EXISTS (SELECT * FROM reactions WHERE chKey='".$chKey."' AND userRX='".$userRX."')) AS 'recordExists'";

    if ($result=$conn->query($sql0)){
        $record_exists=(bool)$result->fetch_assoc()['recordExists'];
        if($record_exists)
        {
            $sql= "UPDATE reactions SET rxCode=".$rxCode." WHERE chKey=\"".$chKey."\" AND userRX=\"".$userRX."\"";
            if($conn->query($sql))
            {
                if($conn->affected_rows){
                    $no_effect=false;
                    $sql= "SELECT SUM(rxCode) as 'total' FROM reactions WHERE chKey=".$chKey;
                    if($result=$conn->query($sql))
                    {
                        $total=($result->fetch_assoc()["total"]);
                        $sql2="UPDATE `".$thread."` SET tally=(".$total.") WHERE chKey=".$chKey;
                    }


                }

                if($no_effect || $conn->query($sql2))
                {
                    if($result=$conn->query("SELECT tally FROM `".$thread."` WHERE chKey=".$chKey))
                    {
                        $tally= $result->fetch_assoc()["tally"];
                        print $tally;
                    }
                }
            }
          //  else print "nope: ". $conn->error. ": ".$sql;
        }

   // if(0==1){}
        else {
            $stmt="INSERT INTO reactions (thIndex, chKey, rxCode, userOP, userRX) VALUES (?,?,?,?,?)";
            $sql = $conn->prepare($stmt);

            $sql->bind_param("siiss", $thread, $chKey, $rxCode, $userOP, $userRX);

            if($sql->execute()){
                $sql2="UPDATE `".$thread."` SET tally=(tally+".$rxCode.") WHERE chKey=".$chKey;

                if($conn->query($sql2))
                {
                    if($result=$conn->query("SELECT tally FROM `".$thread."` WHERE chKey=".$chKey))
                    {
                        $tally= $result->fetch_assoc()["tally"];
                        print $tally;
                    }
                }
                else {
                    print "nope: ". $conn->error. ": ".$sql2;;
                }
            }
            else{ print "nope: ". $conn->error;
            }
        }
    }
   else { print "nope: ". $conn->error.": ".$sql0;
   }


}


function remove_reaction($chKey, $userRX){
    $conn=set_connection("threads");
    $sql="DELETE FROM reactions WHERE chKey=\"".$chKey."\" AND userRX=\"".$userRX."\"";
    if($conn->query($sql))
    {
       print "Removed user ".$userRX."'s reaction to post #".$chKey;
    }
    else print "nope: ". $conn->error. ": ".$sql;
}

function tally_reactions($chKey){

    $conn=set_connection("threads");
    $sql= "SELECT SUM(rxCode) as 'total' FROM reactions WHERE chKey=".$chKey;
    if($result=$conn->query($sql))
    {
        print ($result->fetch_assoc()["total"]);
    }
    else print "nope: ". $conn->error. ": ".$sql;
}

function new_message_json($user, $body, $avatar){
    $new1= new message($user, $body, $avatar, 803, 803);

    echo $new1->get_json();

}

function new_message_raw(){
    $new1=new message();
echo $new1->get_json();
}

function send_direct_message($sender, $recipient, $message, $avatar="default_img.png"){
    $conn=set_connection("direct");
    if(user_exists_strict($recipient)){
        
        $id=get_DM_key($sender, $recipient);
        generate_thread($conn, $id);
        post_to_dm_channel($sender, $recipient, $avatar, $message);
        //update_direct_channel($sender);
        
       // update_direct($message, $id, $sender, $avatar, 0);
    }
    
    else {
        $id="admin".$sender;
        $mess2="Your message could not be delivered: User \"".$recipient."\" was not found.";
        generate_thread($conn, $id);
        post_to_dm_channel("admin", $sender, $avatar, $mess2);
        //update_direct_channel($sender);
    }
}



?>
