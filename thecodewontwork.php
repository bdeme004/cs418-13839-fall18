


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Thread - lptColors</title>
<link rel="stylesheet" type="text/css" href="lptcolors.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
<script src="lptcolors.js"></script>

</head>
    
    <?php
session_start();
require_once 'messageTemplate.php';
require_once 'htmlManager.php';
require_once 'sqlManager.php';
require_once 'upload.php';
// ----------------------------------------------------------

/*if (! isset($_SESSION["user"])) {
header("Location: index.php?login=0");
}*/

$channel_top = "lightsky";
$thread = "TCWW";
$admin = 1;

$archived = isArchived($channel_top, $thread);

$conn = set_connection("threads");
generate_thread($conn, $thread);

navbars($channel_top);

if ($archived) {
$input_form = "display:none";
} else {
$input_form = "";
}
?>

    <div id="file-comment">mdkicvnebik</div>

<?php 
$newmess=new message();
    $newmess=$newmess->get_json();
    
    ?>    
    
<body>
	
<div class="thread-header" id="pageinfo" style="display:none;"
		data-thread-id="<?php print($thread);?>
		data-channel-top="<?php print($channel_top);?>"
		data-user-admin="<?php print $admin;?>"
		data-thread-archived="<?php echo isArchived($channel_top, $thread);?>"></div>


    
    <a href="direct.php?cat=cat" style="text-decoration:none; color:#000000;">
        <div class="container thread" id="$this->index" style="border-color:var(--color-acc-$channel_top);">
            <span class="thr-archived"><i class="material-icons">forum</i></span>
            <div class="thread-title"><p> $this->user1 &#8596 $this->user2. "</p> </div>
            <span class="message-text">$this->newest</span>
        </div></a>
    
<!--
	<div class="container" id="1" style="border-color: var(- -color-con-lightsky);">

		<img class="a" src="default-img.png" alt="Avatar" style="border-color: var(- -color-con-lightsky);">

		<div class="post-react">

			<a class="post-react-a" href="javascript:likePost(1)">
				<i class="material-icons post-react">expand_less</i>
			</a>

			<span class="post-react tally">0</span>

			<span class="post-react-a" style="display:none"></span>

			<a class="post-react-a"	href="javascript:dislikePost(1)">
				<i class="material-icons post-react">expand_more</i>
			</a>

		</div>

		<a href="userProfile.php?user=bdemerch">
			<span class="name-left">bdemerch</span>
		</a>

		<div class="message-text">
			BODY
		</div>

		<span class="right-corner">2018-12-03 01:28:42</span>
		<br>
		<span class="right-corner" onclick="killPost(1)"> delete post</span>

	</div>
-->
    
    <?php
    function update_direct_channel(){
        $conn=set_connection("channels");

        $sql="SELECT * FROM `direct` ORDER BY modified DESC;";
        if ($result=$conn->query($sql))
        {
            while($direct_list=$result->fetch_assoc()){
                $direct=array();
                foreach ($direct_list as $field){
                    array_push($direct, $field);
                }
                $new_thread=new direct($direct);
                $new_thread->print_with_format();
            }
        }
        else {
            echo "issue executing";
            error_log($conn->error .". SQL: ". $sql);
            echo $conn->error .". SQL: ". $sql;
        }
    }
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

</body>
</html>
