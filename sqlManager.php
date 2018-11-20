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


function fetch_messages ($thread, $channel_top, $page, $cap, $admin) {
    $conn=set_connection("threads");
    $sql="SELECT * FROM " . $thread . " ORDER BY chKey DESC";
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
}

function generate_thread($conn, $thread_index) {
    
    $conn->query("CREATE TABLE IF NOT EXISTS `".$thread_index."` (
  `user` varchar(13) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` text NOT NULL,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;");
}

function search_users($q){

$conn=set_connection("users");
$sql="SELECT handle, avatar FROM usertable WHERE handle LIKE '%". $q . "%';";
$result = $conn->query($sql);

$odd=1;
while ($row=$result->fetch_assoc())
{
    $name=$row["handle"];
    $avatar=$row["avatar"];
    
    $user= new message($name, $avatar, "", 803, 803);
    $user->print_as_searchresult($odd, "monarchs");
    
    $odd++;
    }
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
}
}

//I actually have no idea why the parameters are coming in in this order.
//I'm busy, though, so rather than track it down I just rearranged them here.
//UPDATE: hey, I fixed it!
function update_thread($body, $channel_top, $thread, $user, $avatar, $admin){
    $conn=set_connection("threads");
    $stmt="INSERT INTO ". $thread." (user, body, avatar) VALUES (?,?,?)";
    $sql = $conn->prepare($stmt);
    
    $user=$user;
    $avatar=$avatar;
    $body=$body;
   
    $sql->bind_param("sss", $user, $body, $avatar);
    
    if($sql->execute()){
        fetch_messages($thread, $channel_top, 1, 10, $admin);   
      
    }
    else
    {echo ("Sorry, Message not sent.");
    echo $conn->error;
    print("<br> ".$stmt);
    }
}

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

function delete_post($thread, $chkey)
{
    $conn=set_connection("threads");
    $sql="UPDATE ".$thread." SET user='admin', body= 'This post was deleted by an administrator.', avatar='default_img.png' WHERE chkey= ".$chkey;
    if($conn->query($sql))
    {
        echo "Deleted";
    }
    else echo $sql;
}

function kill_post($thread, $chkey)
{
    $conn=set_connection("threads");
    $sql="DELETE FROM ".$thread." WHERE chkey= ".$chkey;
    if($conn->query($sql))
    {echo ("KILL IT WITH FIRE");
    echo $conn->error;
   // print("<br> ".$sql);
    }
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
    else  return $conn->error. $sql;
}
    
?>
