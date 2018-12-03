<?php

class message{

    protected $name;
    protected $avatar;
    protected $body;
    protected $time;
    protected $tally;
    protected $key;

    function __construct()
    {
        $a = func_get_args();
        if (func_num_args()==5) {
            call_user_func_array(array($this,"set_message"),$a);
        }
        else if  (func_num_args()==1) {
            call_user_func_array(array($this,"new_from_data"),$a);
        }
        else
        {
            $this->name="DNE";
            $this->body="DNE";
            $this->avatar="default_img.png";
            $this->time=803;
            $this->tally=803;
            $this->key=803;

        }
    }

    function set_message($_name, $_avatar, $_body, $_time, $_key){
        $this->name=$_name;
        $this->avatar=test_image($_avatar);
        $this->body=$_body;
        $this->time=$_time;
        $this->tally=803;
        $this->key=$_key;
    }

    function new_from_data($_newraw){
       if((count($_newraw))>4)
       {
        $this->name=$_newraw[0];
        $this->body=$_newraw[1];
        $this->time=$_newraw[2];
        $this->key=$_newraw[3];
        $this->avatar=test_image($_newraw[4]);
        $this->tally=$_newraw[5];
       }
       else
       {
       $this->name="ERROR";
       $this->body="ERROR";
       $this->time=803;
       $this->tally=803;
       $this->key=803;
       $this->avatar="default_img.png";
       }
    }

    function print_message()
    {echo nl2br($this->name .": \"" . $this->body . "\" (". $this->time . ")\n");}

    function print_with_format($odd, $channel_top, $admin)
    {
        if($admin=="1")
            $killPost_display=" onclick=\"killPost(".$this->key.")\"> delete post";
        else
            $killPost_display="> ";

        if ($odd==0)
            $color="--color-acc-".$channel_top;
        else
            $color="--color-con-".$channel_top;

          //  $tally=40;



            print("<div class=\"container\" id=\"".$this->key."\" style=\"border-color:var(".$color.");\">
                    <img class=\"a\" src=\"".$this->avatar."\" alt=\"Avatar\" style=\"border-color:var(".$color.");\">
                    <div class=\"post-react\">
                    <a class=\"post-react-a\" href=\"javascript:likePost(".$this->key.")\"> <i class=\"material-icons post-react\">expand_less</i></a>
                    <span class=\"post-react tally\">".$this->tally."</span>
                    <span class=\"post-react-a\" style=\"display:none\";></span>
                    <a class=\"post-react-a\" href=\"javascript:dislikePost(".$this->key.")\"> <i class=\"material-icons post-react\">expand_more</i></a>
                    </div>
                    <a href=\"userProfile.php?user=".$this->name."\"><span class=\"name-left\">".$this->name."</span></a>
                    <div class=\"message-text\"><p>".$this->body."</p></div>
                    <span class=\"right-corner\">".$this->time."</span>
                    <br><span class=\"right-corner\"".$killPost_display."</span></div>");



    }

    function print_as_searchresult($odd, $channel_top)
    {

        if (($odd%2)==0)
            $color="--color-acc-".$channel_top;
        else
            $color="--color-con-".$channel_top;

        print( "    <a href=\"userProfile.php?user=".$this->name."\" class=\"name-center-a\">
                    <div class=\"container\" style=\"border-color:var(".$color.");\">
                    <img class=\"search-user\" src=\"".$this->avatar."\" alt=\"Avatar\" style=\"border-color:var(".$color.");\">
                    <div class=\"name-center\">".$this->name."</div></div></a>"
                    );
    }

    function get_json(){ //there may have been a better way to do this. but I got fed up.
        $array=array();
        $array["name"] = $this->name;
        $array["body"] = $this->body;
        $array["avatar"] = $this->avatar;
        $array["time"] = $this->time;
        $array["tally"] = $this->tally;
        $array["key"] = $this->key;
        return json_encode($array);
    }

//===================================
  //-----------------------------------
    function get_name() {
        return $this->name;
    }
    function get_body() {
        return $this->body;
    }
    function get_time() {
        return $this->time;
    }
    function get_key() {
        return $this->key;
    }
  //-----------------------------------
    function set_name($new) {
        $this->name=$new;
    }
    function set_body($new) {
        $this->body=$new;
    }
    function set_time($new) {
        $this->time=$new;
    }
    function set_key($new) {
        $this->key=$new;
    }
//===================================

}
//=======================================================================
?>
