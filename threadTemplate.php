<?php

//=======================================================================
class thread{
    
    protected $index;
    protected $title;
    protected $private;
    protected $allowed_users;
    protected $replies;
    protected $updated;
    
    function __construct()
    {
        $a = func_get_args();
        if (func_num_args()==5) {
            call_user_func_array(array($this,"set_thread"),$a);
        }
        else if  (func_num_args()==1) {
            call_user_func_array(array($this,"new_from_data"),$a);
        }
        else
        {
            $this->title="DNE";
            $this->private=0;
            $this->allowed_users=array("8","0","3");
            $this->replies=803;
            $this->updated=date_create();
        }
    }
    
    function set_thread($title0, $private0, $allowed_users0, $replies0, $updated0){
        $this->title=$title0;
        $this->private=$private0;
        $this->allowed_users=$allowed_users0;
        $this->replies=$replies0;
        $this->updated=$updated0;
    }
    
    function new_from_data($newraw0){
        if((count($newraw0))>5)
        
        {
            $this->index=$newraw0[0];
            $this->title=$newraw0[1];
            $this->private=$newraw0[2];
            $this->allowed_users=$newraw0[3];
            $this->replies=$newraw0[4];
            $this->updated=$newraw0[5];
            
        }
        else
        {
            $this->title="error creating thread from data";
            $this->private=0;
            $this->allowed_users=array("8","0","3");
            $this->replies=803;
            $this->updated=date_create();
        }
    }
        
        function print_thread()
        {echo nl2br($this->title .": \"" . $this->private . "\" (". $this->replies . ")\n");}
        
        function print_with_format($odd, $channel_top)
        {
            if($odd==0)
            {
                print( "<a href=\"thread.php?top=".$channel_top."&thread=".$this->index."\"style=\"text-decoration:none; color:#000000;\">
                        <div class=\"container thread\"style=\"border-color:var(--color-acc-".$channel_top.");\">
                    
                    <div class=\"message-text\"><p>". $this->title. "</p></div>
                    <span class=\"time-right\">".$this->replies."</span>
                    </div></a>");
            }
            else
            {
                print( "<a href=\"thread.php?top=".$channel_top."&thread=".$this->index."\"style=\"text-decoration:none; color:#000000;\">
                        <div class=\"container thread-b\" style=\"border-color:var(--color-con-".$channel_top.");\">
                    <div class=\"message-text\"><p>". $this->title. "</p></div>
                    <span class=\"time-right\">".$this->replies."</span>
                    </div>");
                  
            }
            
            
        }
        
        //===================================
        //-----------------------------------
        function get_title() {
            return $this->title;
        }
        function get_allowed_users() {
            return $this->allowed_users;
        }
        function get_replies() {
            return $this->replies;
        }
        function get_updated() {
            return $this->updated;
        }
        //-----------------------------------
        function set_title($new) {
            $this->title=$new;
        }
        function set_allowed_users($new) {
            $this->allowed_users=$new;
        }
        function set_replies($new) {
            $this->replies=$new;
        }
        function set_updated($new) {
            $this->updated=$new;
        }
        //===================================
        
    }

    //=======================================================================
    ?>
