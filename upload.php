<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Avatar- Lin Picked The Colors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<script src="lptcolors.js"></script>
</head>
<body>

    

<?php

require_once 'htmlManager.php';
require_once 'sqlManager.php';

$result="";
$target_dir="";



if(isset($_POST["default-img"])) {
    $_SESSION["avatar"]=$_POST["default-img"];
}
elseif (isset($_POST["submit"])) {
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check) {
        $uploadOk = 1;
    } else {
        $result= "File is not an image.";
        $uploadOk = 0;
    }
    

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $result= "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    $new_name=(microtime(true)*10000) .".". $imageFileType;
    $new_file= $target_dir . $new_name;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_file)) {
        
        
        $conn=set_connection("users");
        $sql="UPDATE usertable SET avatar=\"".$new_name."\" WHERE handle like \"".$_SESSION["user"]."\";";
               
        if($conn->query($sql))
        {
           $result= basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. Your avatar will be updated shortly.". nl2br("\n You can now leave this page.");
           $_SESSION["avatar"]=$new_name;
        }
        else
        {
            $result=nl2br("Your file was uploaded, but there was a problem with updating your avatar.\n
                           Your file will be deleted from the server. Please try again later.");
            unlink($new_name);
        }
      
       
       
    } else {
        $result= "Sorry, there was an error uploading your file.";
    }
}
}
navbars("monarchs");
?>

    <script src="lptcolors.js"></script>
    
<div class="container">
<h1>Change Avatar</h1>
<hr><br>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
    <input type="submit" value="Use Default" name="use-default" onclick="useDefault('<?php echo $_SESSION["user"]?>')">
    <span><br><br><?php echo $result;?></span>
</form>
</div>


</body>
</html>
