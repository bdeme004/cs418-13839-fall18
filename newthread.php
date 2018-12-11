<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>New Thread- lptColors</title>
    <link rel="stylesheet" type="text/css" href="lptcolors.css">
</head>

<body>

    <?php

    require_once 'htmlManager.php';
    require_once 'sqlManager.php';

navbars("monarchs");

$channel_top = $_GET["top"];

$title_err = $allowed_users_err = "";
$title = $private = "";

$conn = set_connection("channels");
$id = "t".(microtime(true)*10000);

$stmt = "INSERT INTO ". $channel_top." (chIndex, chTitle, chPrivate, chAllowedUsers) VALUES (\"".$id."\",?,?,?)";
$sql = $conn->prepare($stmt);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["title"])) {
$title_err = "Title is required";
} else {
$title = test_input($_POST["title"]);
}
$private = test_input($_POST["private"]);

if (empty($_POST["allowed_users"])) {
$allowed_users = "ALL";
} else {
$allowed_users = test_input($_POST["allowed_users"]);
}


$sql->bind_param("sis", $title, $private, $allowed_users);
if ( $sql->execute()) {
header("Location: thread.php?top=".$channel_top."&thread=".$id."");
}
else echo($conn->error);
}
?>

    <form action="#" method="post">
        <div class="container" style="border-color: var(--color-acc-<?php echo $channel_top?>);">
            <h1>New Thread</h1>
            <hr>

            <label><b>Title: </b>
                <input type="text" name="title" value="<?php echo $title; ?>" required>

            </label><span>
                <?php echo $title_err;?></span><br><br>
            <label><b>Privacy:</b>
                <input type="radio" name="private" value="0" checked> open
                <input type="radio" name="private" value="1"> private

            </label><br><br>
            <label><b>Invite Users: </b>
                <input type="text" name="allowed_users" placeholder="@john, @jane, @justin...">
                <span>
                    <?php echo $allowed_users_err;?></span>
            </label><br><br>

            <hr>

            <button type="submit" class="registerbtn">Create Thread</button>

        </div>
    </form>

</body>

</html>
