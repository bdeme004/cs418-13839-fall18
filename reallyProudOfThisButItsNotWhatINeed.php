<?php
$target_dir = "";
if ( (isset($_FILES["imgToUpload"])) || (isset($_FILES["fileToUpload"]) ) ) {
    if (isset($_FILES["imgToUpload"])){
        $file_src="imgToUpload";
    }
    else {
        $file_src="fileToUpload";
    }

    $target_file = $target_dir . basename($_FILES[$file_src]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($target_file != null) {
        $check = getimagesize($_FILES[$file_src]["tmp_name"]);
        if (!$check) {
            $file_op = 0;
        } else {
            $file_op = 1;
        }

        if ($file_op == 0) {
            $result = "add-img.png";
        } else {
            $new_name = uniqid() . "." . $imageFileType;
            $new_file = $target_dir . $new_name;
            if (move_uploaded_file($_FILES[$file_src]["tmp_name"], $new_file)) {

                $result = $new_file;
            } else {
                $result = "add-img.png";
            }
        }
        print $result;
    }

}
else{
    $result="add-img.png";
}

?>