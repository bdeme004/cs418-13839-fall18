<?php

//=======================================================================
class message{
    
    protected $name;
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
            call_user_func_array(array($this,"new_from_raw"),$a);
        }
        else
        {
            $this->name="DNE";
            $this->body="DNE";
            $this->time=803;
            $this->key=803;
        }
    }
    
    function set_message($_name, $_body, $_time, $_key){
        $this->name=$_name;
        $this->body=$_body;
        $this->time=$_time;
        $this->key=$_key;
    }
    
    function new_from_raw($_newraw){
       if((count($_newraw))>3)
       {
        $this->name=$_newraw[0];
        $this->body=$_newraw[1];
        $this->time=$_newraw[2];
        $this->key=$_newraw[3];
       }
       else
       { 
       $this->name="ERROR";
       $this->body="ERROR";
       $this->time=803;
       $this->key=803;
       }      
    }
    
    function print_message()
    {echo nl2br($this->name .": \"" . $this->body . "\" (". $this->time . ")\n");}
    
    function print_with_format($index)
    {
        if($index==0)
        {
            print( "<div class=\"container\">
                    <img src=\"round_account_circle_black_48dp.png\" alt=\"Avatar\">
                    <span class=\"name-left\">".$this->name."</span>
                    <p>". $this->body. "</p>
                    <span class=\"time-right\">".$this->time."</span>
                    </div>");
        }
        else 
        {
            print( "<div class=\"container b\">
                    <img class=\"b\" src=\"round_account_circle_black_48dp.png\" alt=\"Avatar\">
                    <span class=\"name-left\">".$this->name."</span>    
                    <p>". $this->body. "</p>
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
