<?php
session_start();
require_once 'messageTemplate.php';
require_once 'htmlManager.php';
require_once 'sqlManager.php';
require_once 'upload.php';
// ----------------------------------------------------------

if (! isset($_SESSION["user"])) {
    header("Location: index.php?login=0");
}

$channel_top = $_GET["top"];
$thread = $_GET["thread"];
$admin = $_SESSION["admin"];

$archived = isArchived($channel_top, $thread);

$conn = set_connection("threads");
generate_thread($conn, $thread);

navbars($channel_top);

if ($archived) {
    $input_form = "display:none";
    $archive_notice = "";
} else {
    $archive_notice = "display:none";
    $input_form = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<title>Thread - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
<script src="lptcolors.js"></script>

</head>

<body>

	<!-- comment box was here-ish -->
	<script>fileUploadStandby();</script>

    <!-- thread-header -->
	<div class="thread-header" id="pageinfo"
		data-thread-id="<?php print($thread);?>"
		data-channel-top="<?php print($channel_top);?>"
		data-user-admin="<?php print $admin;?>"
		data-thread-archived="<?php echo isArchived($channel_top, $thread);?>">

		<!-- inputform -->
		<form id="inputform" autocomplete="off" style="<?php echo $input_form;?>">
			<textarea id="message" name="message" rows="6" cols="180"
				style="margin-bottom: 5px;"></textarea>
			<br> <input type="button" value="Submit"
				onclick="submitMessage( <?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>, getElementById('message').value, <?php print $admin;?>)">

			<i class="material-icons import-share"><a
				href="javascript:toggleDialog('import-dialog')" id="add-image">add_photo_alternate</a></i>
			<i class="material-icons import-share"><a
				href="javascript:toggleUploadDialog()">attach_file</a></i>
		</form>

		<div class="container archive-notice" id="archive-notice" style="<?php echo $archive_notice;?>">
			<i class="material-icons archived">lock</i> <span
				style="font-size: 24px; position: relative; bottom: 18px;"> This
				post has been archived by an administrator and no new posts,
				comments, or edits can be made. </span>
		</div>

	</div>
	<!-- thread-header end-->

	<!-- import-dialog-->
	<div class="container import-dialog" id="import-dialog">
		<div style="font-size: 21px; font-weight: bold;">
			Enter the address of an image or upload your own: <a
				href="javascript:toggleDialog('import-dialog')"><span class="close"><i
					class="material-icons">close</i></span></a>
		</div>

		<hr>
		<div class="import-frame">
			<img class="import" id="img-img" src="<?php echo ADD_IMG_DEF;?>"
				alt="no image selected">
		</div>
		<textarea rows="6" cols="56" id="img-comment"
			placeholder="Enter a comment (optional)"
			style="position: relative; vertical-align: top;"></textarea>
		<hr>

		<form action="#" method="post" id="web-src-form"
			style="display: inline-block;">
			<input type="url" name="web-img-src" id="web-img-src"
				placeholder="Enter image URL..."> <input type="button"
				value="Fetch Image" name="submit-web-src"
				onclick="javascript:urlImage()">
		</form>
		or
		<form action="#" method="post" enctype="multipart/form-data"
			id="import-form" style="display: inline-block;">
			<input type="file" name="imgToUpload" id="imgToUpload"
				accept="image/*">
		</form>
		<input type="button" value="Send Message" name="submit-message"
			onclick="submitWithImage(<?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>)">
        <div id="import-error"> </div>
</div>
<!-- import-dialog end -->

	<!-- upload-dialog -->
	<div class="container import-dialog" id="upload-dialog">
		<div style="font-size: 21px; font-weight: bold;">
			Upload a file: <a href="javascript:toggleUploadDialog()"><span
				class="close"><i class="material-icons">close</i></span></a>
		</div>

		<hr>
		<div class="import-frame">
			<img class="import" id="file-pre" src="<?php echo ADD_FILE_DEF;?>"
				alt="no preview available">
		</div>
		<textarea rows="6" cols="56" id="file-comment"
			placeholder="Enter a comment (optional)"
			style="position: relative; vertical-align: top;"></textarea>
		<hr>

		<form action="#" method="post" enctype="multipart/form-data"
			id="upload-form" style="display: inline-block;">


			<input type="file" name="fileToUpload" id="fileToUpload">
		</form>
		<input type="button" value="Send Message" name="submit-message"
			onclick="submitWithFile(<?php print("'".$_SESSION["user"]."', '".$_SESSION["avatar"]."'"."")?>)">
        <div id="upload-error"> </div>
	</div>
	<!-- upload-dialog end -->

	<div class="page-count">
    <?php
    $num_pages = count_pages($thread);
    for ($i = 1; $i <= $num_pages; $i ++) {
        print("<strong> <a href=\"javascript:loadPage(" . $i . ")\">" . $i . " " . "</a></strong>");
    }
    ?>
</div>

	<div class="message-area" id="message-area">


	<?php echo fetch_messages($thread, $channel_top, "threads", $admin); ?>

</div>






</body>
</html>
