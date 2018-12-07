<?php
$target_dir = "";
$result= "Failed from the getgo, huh?";

$whitelist=array("txt", "pdf", "doc", "docx", "rtf", "odt", "pptx", "ppt", "odp", "gif", "png", "jpg", ".bmp", "svg", "xlsx", "xlsx", "mp3", "ogg", "wav", "m4a");


if ( (isset($_FILES["imgToUpload"])) || (isset($_FILES["fileToUpload"]) ) ) {
    if (isset($_FILES["imgToUpload"])){

    //--------------------------------------------------------
       // $target_dir="img/"
        $target_file = $target_dir . basename($_FILES["imgToUpload"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        if(!(in_array($imageFileType, $whitelist, TRUE)))
        {
            $result=0;
        }
        else{

        if ($target_file != null) {
            $check = getimagesize($_FILES["imgToUpload"]["tmp_name"]);
            if ($check) {
                $upload_ok = 1;
            } else {
                $upload_ok = 0;
            }

            if ($upload_ok == 0) {
                $result = "add-img.png";

            } else {
                $new_name = uniqid() . "." . $imageFileType;
                $new_file = $target_dir . $new_name;
                if (move_uploaded_file($_FILES["imgToUpload"]["tmp_name"], $new_file)) {

                    $result = $new_file;
                } else {
                    $result = "add-img.png";

                }
            }
        }
        }
    //--------------------------------------------------------



    }
    else {
        $target_dir="files/";
        //temp- assumes users don't break things (LOL)

        $target_file = basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        if(!(in_array($imageFileType, $whitelist, TRUE)))
        {
            $result=0;
        }
        
        else{

        if ($target_file != null) {
            $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check) {
                $upload_ok = 1;
            } else {
               // $upload_ok = 0;
               $upload_ok=1;
            }

            if ($upload_ok == 0) {
                $result = "add-img.png";
                $result= "upload_ok == 0";
            } else {
                $new_name = uniqid() . "__".$target_file;//.".". $imageFileType;
                $new_file = $target_dir . $new_name;
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_file)) {

                    $result = $new_file;
                } else {
                    $result = "add-img.png";
                    $result= "move_uploaded_file == 0";
                }
              }
        }
    }
    }
}
else{
    $result="add-img.png";
   // $result= "完全失敗";
}
print $result;

?>