<?php

//=======================================================================
class thread{
    
    protected $index;
    protected $title;
    protected $private;
    protected $allowed_users;
    protected $replies;
    protected $updated;
    protected $archived;
    
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
            $this->title="DNE";
            $this->private=0;
            $this->allowed_users=array("8","0","3");
            $this->replies=803;
            $this->updated=date_create();
        }
    }
    
    function set_thread($title0, $private0, $allowed_users0, $replies0, $updated0, $archived0){
        $this->title=$title0;
        $this->private=$private0;
        $this->allowed_users=$allowed_users0;
        $this->replies=$replies0;
        $this->updated=$updated0;
        $this->archived=$archived0;
    }
    
    function new_from_data($newraw0){
        if((count($newraw0))>6)
        
        {
            $this->index=$newraw0[0];
            $this->title=$newraw0[1];
            $this->private=$newraw0[2];
            $this->allowed_users=$newraw0[3];
            $this->replies=$newraw0[4];
            $this->updated=$newraw0[5];
            $this->archived=$newraw0[6];
            
        }
        else
        {
            $this->title="error creating thread from data";
            $this->private=0;
            $this->allowed_users=array("8","0","3");
            $this->replies=803;
            $this->updated=date_create();
            $this->updated=1;
        }
    }
        
        function print_thread()
        {echo nl2br($this->title .": \"" . $this->private . "\" (". $this->replies . ")\n");}
        
        function print_with_format($odd, $channel_top, $admin)
        {
            if($this->archived==true)
                $archived="<i class=\"material-icons\">speaker_notes_off</i>";
            else $archived="";
            
            if($odd!=0)
            {
                print( "
                    <a href=\"javascript:clickThread('".$this->index."')\"style=\"text-decoration:none; color:#000000;\">
                    <div class=\"container thread\" id=\"".$this->index."\" style=\"border-color:var(--color-acc-".$channel_top.");\">
                    <span class=\"thr-archived\">".$archived."</span>
                    <div class=\"thread-title\"><p>". $this->title. "</p></div>
                    </div></a>");
            }
            else
            {
                print(  "
                    <a href=\"javascript:clickThread('".$this->index."')\"style=\"text-decoration:none; color:#000000;\">
                    <div class=\"container thread\" id=\"".$this->index."\" style=\"border-color:var(--color-acc-".$channel_top.");\">
                    <span class=\"thr-archived\">".$archived."</span>
                    <div class=\"thread-title\"><p>". $this->title. "</p></div>
                    </div></a>");
                  
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
        function get_archived() {
            return $this->archived;
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
        function set_archived($new) {
            $this->archived=$new;
        }
        //===================================
        
    }

    //=======================================================================
    ?>
