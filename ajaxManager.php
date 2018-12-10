<?php
require_once 'sqlManager.php';
require_once 'directTemplate.php';
require_once 'messageTemplate.php';
require_once 'threadTemplate.php';

    $op = intval($_POST['op']);

switch ($op) {

    case 1:
        $q = test_input($_POST['q']);
        search_users($q);
        break;

    case 2:
        $body = test_input($_POST["message"]);
        update_thread($body, $_POST["thread"], $_POST["user"], $_POST["avatar"], $_POST["admin"], $_POST["top"], $_POST["dbname"]);
       // print $body;
        break;

    case 3:
        fetch_messages($_POST["thread"], $_POST["top"], "threads", $_POST["admin"]);
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
        add_reaction($_POST["thread"], $_POST["chKey"], $_POST["rxCode"], $_POST["userOP"], $_POST["userRX"], "direct");
        break;

    case 10:
        $body = test_input($_POST["message"]);
        new_message_json($_POST["user"], $body, $_POST["avatar"]);
        break;
        
    case 11:
        new_message_raw();
        break;
        
    case 12: //temp; stupid
        $q = test_input($_POST["q"]);
        user_exists($q);
        break;
        
    case 13: 
        $message = test_input($_POST["message"]);
        $recipient= test_input($_POST["recipient"]);
        send_direct_message($_POST["sender"], $recipient, $message, $_POST["avatar"]);
        update_direct_channel($_POST["sender"]);
        break;
        
    default:
        print "default";
        break;
} // end switch

?>
