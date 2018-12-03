<?php
require_once 'sqlManager.php';
require_once 'messageTemplate.php';
require_once 'threadTemplate.php';

if (isset($_GET['op']))
    $op = intval($_GET['op']);
else
    $op = intval($_POST['op']);

switch ($op) {

    case 1:
        $q = test_input($_GET['q']);
        search_users($q);
        break;

    case 2:
        $body = test_input($_POST["message"]);
        update_thread($body, $_POST["top"], $_POST["thread"], $_POST["user"], $_POST["avatar"], $_POST["admin"]);
        break;

    case 3:
        fetch_messages($_POST["thread"], $_POST["top"], $_POST["page"], 10, $_POST["admin"]);
        break;

    case 4:
        delete_post($_POST["top"], $_POST["thread"], $_POST["chkey"]);
        break;

    case 5:
        kill_post($_POST["top"], $_POST["thread"], $_POST["chkey"]);
        break;

    case 6:
        toggle_thread_archived($_POST["top"], $_POST["thread"], $_POST["archive-switch"]);
        break;

    case 7:
        use_default($_POST["user"]);
        break;

    case 8:
        add_reaction($_POST["thread"], $_POST["chKey"], $_POST["rxCode"], $_POST["userOP"], $_POST["userRX"]);
        break;

    case 9:
        remove_reaction($_POST["chKey"], $_POST["userRX"]);
        break;

    case 10:
        $body = test_input($_POST["message"]);
        new_message_json($_POST["user"], $body, $_POST["avatar"]);
        break;
} // end switch

?>
