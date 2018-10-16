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

function fetch_messages ($conn) {
    $sql="SELECT * FROM channel1 ORDER BY chKey DESC";
    if($result=$conn->query($sql)){
        $index=1;
        while($row= ($result->fetch_assoc())){
            $newraw=array();
            foreach ($row as $field){
                array_push($newraw, $field);
            }
            $newmess=new message($newraw);
            $index=$index+1;
            $newmess->print_with_format(($index%2));
        }
    }
}

function post_message($conn, $channel){
    $stmt="INSERT INTO" . $channel . "(user, body, chKey) VALUES (?, ?, now(4))";
        
    $sql = $conn->prepare($stmt);
    $sql->bind_param("ss", $user, $body);
    
    if(isset($_POST["message"])){
        $body=test_input($_POST["message"]);
        $user="DNE";
        
        if($sql->execute()){
            fetch_messages($conn);
        }
        else {
            echo "error: message not sent: \t". $conn->error;
        }
    }
}

?>