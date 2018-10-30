<?php

//=======================================================================
class message{
    
    protected $name;
    protected $avatar;
    protected $body;
    protected $time;
    protected $key;
    
    function __construct()
    {
        $a = func_get_args();
        if (func_num_args()==4) {
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
            $this->key=803;
        }
    }
    
    function set_message($_name, $_avatar, $_body, $_time, $_key){
        $this->name=$_name;
        $this->avatar=$_avatar;
        $this->body=$_body;
        $this->time=$_time;
        $this->key=$_key;
    }
    
    function new_from_data($_newraw){
       if((count($_newraw))>4)
       {
        $this->name=$_newraw[0];
        $this->body=$_newraw[1];
        $this->time=$_newraw[2];
        $this->key=$_newraw[3];
        $this->avatar=$_newraw[4];
        if (!(file_exists("img/".$this->avatar)))
        {$this->avatar="default_img.png";
        }}
       else
       { 
       $this->name="ERROR";
       $this->body="ERROR";
       $this->time=803;
       $this->key=803;
       $this->avatar="round_account_circle_black_48dp.png";
       }      
    }
    
    function print_message()
    {echo nl2br($this->name .": \"" . $this->body . "\" (". $this->time . ")\n");}
    
    function print_with_format($odd, $channel_top)
    {
        if($odd==0)
        {
            print( "<div class=\"container\" style=\"border-color:var(--color-acc-".$channel_top.");\">
                    <img src=img/".$this->avatar." alt=\"Avatar\">
                    <span class=\"name-left\"><a href=\"userProfile?user=".$this->name."\">".$this->name."</a></span>
                    <div class=\"message-text\"><p>". $this->body. "</p></div>
                    <span class=\"time-right\">".$this->time."</span>
                    </div>");
        }
        else 
        {
            print( "<div class=\"container b\"style=\"border-color:var(--color-con-".$channel_top.");\">
                    <img class=\"b\" src=img/".$this->avatar." alt=\"Avatar\">
                    <span class=\"name-left\">".$this->name."</span>    
                    <div class=\"message-text\"><p>". $this->body. "</p></div>
                    <span class=\"time-right\">".$this->time."</span>
                    </div>");
        }
        
       
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