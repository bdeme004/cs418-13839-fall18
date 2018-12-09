<?php

class directm{
    
    protected $index;
    protected $user1;
    protected $avatar1;
    protected $user2;
    protected $avatar2;
    protected $newest;
    protected $modified;
    
    function __construct()
    {
        $a = func_get_args();
        if (func_num_args()==6) {
            call_user_func_array(array($this,"set_thread"),$a);
        }
        else if  (func_num_args()==1) {
            call_user_func_array(array($this,"new_from_data"),$a);
        }
        else
        {
            $this->user1="DNE";
            $this->avatar1 = DEFAULT_IMG;
            $this->user2="DNE";
            $this->avatar2 = DEFAULT_IMG;
            $this->newest="DNE";
            $this->modified=date_create();
        }
    }
    
    function set_thread($user10, $avatar10, $user20, $avatar20, $newest0, $modified0){
        $this->user1=$user10;
        $this->avatar1=$avatar10;
        $this->user2=$user20;
        $this->avatar2=$avatar20;
        $this->newest=$newest0;
        $this->modified=$modified0;
    }
    
    function new_from_data($newraw0){
        if((count($newraw0))>6)
        
        {
            $this->index=$newraw0[0];
            $this->user1=$newraw0[1];
            $this->avatar1=$newraw0[2];
            $this->user2=$newraw0[3];
            $this->avatar2=$newraw0[4];
            $this->newest=$newraw0[5];
            $this->modified=$newraw0[6];
            
        }
        else
        {
            $this->user1="DNE";
            $this->avatar1 = DEFAULT_IMG;
            $this->user2="DNE";
            $this->avatar2 = DEFAULT_IMG;
            $this->newest="DNE";
            $this->modified=date_create();
        }
    }
    
    
        
        function print_thread()
        {echo nl2br($this->user1 .": \"" . $this->avatar1 . "\" (". $this->avatar2 . ")\n");}
        
        function print_with_format()
        {
            $channel_top="monarchs";

            print( "
                    <a href=\"direct.php?user=".$this->index."\"style=\"text-decoration:none; color:#000000;\">
                    <div class=\"container thread\" id=\"".$this->index."\" style=\"border-color:var(--color-acc-".$channel_top.");\">
                    <span class=\"thr-archived\"><i class=\"material-icons\">forum</i></span>
                    <div class=\"thread-title\"><p>". $this->user1." &#8596 ".$this->user2. "</p> </div>
                    <span class=\"message-text\">".$this->newest."</span>
                    </div></a>");
        }
    
    
        
        //===================================
        //-----------------------------------
        function get_user1() {
            return $this->user1;
        }
        function get_avatar1() {
            return $this->avatar1;
        }
        function get_user2() {
            return $this->user2;
        }
        function get_avatar2() {
            return $this->avatar2;
        }
        function get_newest() {
            return $this->newest;
        }
        function get_modified() {
            return $this->modified;
        }
        //-----------------------------------
        function set_user1($new) {
            $this->user1=$new;
        }
        function set_avatar1($avatar1) {
            $this->avatar1=$avatar1;
        }
        function set_user2($new) {
            $this->user2=$new;
        }
        function set_avatar2($new) {
            $this->avatar2=$new;
        }
        function set_newest($new) {
            $this->newest=$new;
        }
        function set_modified($new) {
            $this->modified=$new;
        }
        //===================================
        
    }

    //=======================================================================
    ?>
