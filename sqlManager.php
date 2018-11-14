<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
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


function fetch_messages ($conn, $channel, $top) {
    $sql="SELECT * FROM " . $channel . " ORDER BY chKey DESC";
    if($result=$conn->query($sql)){
        $index=1;
        while($row= ($result->fetch_assoc())){
            $newraw=array();
            foreach ($row as $field){
                array_push($newraw, $field);
            }
            $newmess=new message($newraw);
            $index=$index+1;
            $newmess->print_with_format(($index%2), $top);
        }
    }
     else echo("Error executing ". $sql);
}

function post_message($conn, $channel){
    $stmt="INSERT INTO " . $channel . " (user, body, avatar) VALUES (?, ?,?)";
    $user=$body=$avatar="";    
    $sql = $conn->prepare($stmt);
    $sql->bind_param("sss", $user, $body, $avatar);
    echo $stmt;
    
    if(isset($_POST["message"])){
        $body=test_input($_POST["message"]);
        $user=$_SESSION["user"];}
        $avatar=$_SESSION["avatar"];
        
        if($sql->execute()){
            fetch_messages($conn, $channel);
        }
        else {
            echo "error: message not sent: \t". $conn->error;
        }
    }
    
function generate_thread($conn, $thread_index) {
    
    $conn->query("CREATE TABLE IF NOT EXISTS `".$thread_index."` (
  `user` varchar(10) NOT NULL,
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

//I actually have no idea why the parameters are coming in in this order.
//I'm busy, though, so rather than track it down I just rearranged them here.
function update_thread($user, $top, $thread, $avatar, $body){
    $conn=set_connection("threads");
    $stmt="INSERT INTO ". $thread." (user, body, avatar) VALUES (?,?,?)";
    $sql = $conn->prepare($stmt);
    

    $user=$user;
    $avatar=$avatar;
    $body=$body;
   
    $sql->bind_param("sss", $user, $body, $avatar);
    
    
    
    if($sql->execute()){
        fetch_messages($conn, $thread, $top);
        
    }
    else
    {echo ("Sorry, Message not sent.");
    echo $conn->error;
    print("<br> ".$stmt);
    
    }
}
    
?>
