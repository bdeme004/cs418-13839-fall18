
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
return $data;}

function login_data($conn_type){
$servername = "localhost";
$username = "user";
$password = "Gm!kor10u%sJM";

//just to make it stop telling me these aren't used because it's driving me nuts:
if( !$servername || !$username || !$password)
{echo "red alert!!";}
//--------------------------------------------------
}

function fetch_messages ($conn) {
    $sql="SELECT * FROM channel1 ORDER BY chKey DESC";
    if($result=$conn->query($sql)){
        while($row= ($result->fetch_assoc())){ //Unless there's no more rows to fetch...
            foreach ($row as $field){                   //For each field in the row... (should probably just take "as" as の here)
                echo $field." ";                        //...print the field's contents followed by a space.
            }
            echo nl2br("\n");                   //...then move to the next line...
        }                                      //...and stop when there's no more rows.
    }
}




?>