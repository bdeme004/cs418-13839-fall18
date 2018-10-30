<?php

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
    $stmt="INSERT INTO" . $channel . "(user, body, avatar) VALUES (?, ?,?)";
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

function set_thread($conn, $thread_index) {
    
    $conn->query("CREATE TABLE IF NOT EXISTS `".$thread_index."` (
  `user` varchar(10) NOT NULL,
  `body` text NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chKey` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` text NOT NULL,
  PRIMARY KEY (`chKey`)
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;");
}
    



?>
