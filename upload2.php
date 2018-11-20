<?php


//require_once 'htmlManager.php';
//require_once 'sqlManager.php';



//$result2="";
$target_dir="";
if(!isset($_FILES["fileToUpload"]))
{  // $result= "really?! again?!?";
    $result= "add-img.png";}
else{



$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if ($target_file!=null)
{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check) {
        $uploadOk = 1;
    } else {
     //   $result= "File is not an image.";
        $uploadOk = 0;
    }
    

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // $result2= "Sorry, your file was not uploaded.";
    $result= "add-img.png";
    // if everything is ok, try to upload file
} else {
    $new_name=(microtime(true)*10000) .".". $imageFileType;
    $new_file= $target_dir . $new_name;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_file)) {
        
        //echo "Success";
        $result= $new_file;
       
   /*      else
        {
            $result2=nl2br("Your file was uploaded, but there was a problem with updating your avatar.\n
                           Your file will be deleted from the server. Please try again later.");
            unlink($new_name);
        } */
      
       
       
    } else {
      ///  $result2= "Sorry, there was an error uploading your file.";
        $result= "add-img.png";
    }
}


print $result;


}
}
?>