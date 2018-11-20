<?php

class message{
    
    protected $name;
    protected $avatar;
    protected $body;
    protected $time;
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
            $this->key=803;
        }
    }
    
    function set_message($_name, $_avatar, $_body, $_time, $_key){
        $this->name=$_name;
        $this->avatar=$_avatar;
            if (!(file_exists($this->avatar)))
                {$this->avatar="default_img.png";}
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
        if (!(file_exists($this->avatar)))
        {$this->avatar="default_img.png";
        }}
       else
       { 
       $this->name="ERROR";
       $this->body="ERROR";
       $this->time=803;
       $this->key=803;
       $this->avatar="default_img.png";
       }      
    }
    
    function print_message()
    {echo nl2br($this->name .": \"" . $this->body . "\" (". $this->time . ")\n");}
    
    function print_with_format($odd, $channel_top, $admin)
    {
        if($odd==0)
        {
            print( "<div class=\"container\" id=\"".$this->key."\" style=\"border-color:var(--color-acc-".$channel_top.");\">
                    <img class=\"a\" src=\"".$this->avatar."\" alt=\"Avatar\" style=\"border-color:var(--color-acc-".$channel_top.");\">
                    <span class=\"name-left\"><a href=\"userProfile.php?user=".$this->name."\">".$this->name."</a></span>
                    <div class=\"message-text\"><p>".$this->body. "</p></div>
                    <span class=\"right-corner\">".$this->time."</span>");
             if ($admin=="1")
            {print ("<br><span class=\"right-corner\" onclick=\"killPost(".$this->key.")\"> delete post </span>");}
            else
            {print ("<br><span class=\"right-corner\">   </span>");}
            print("</div>");
        }
        else 
        {
            print( "<div class=\"container b\" id=\"".$this->key."\" style=\"border-color:var(--color-con-".$channel_top.")\">
                    <img class=\"b\" src=\"".$this->avatar."\" alt=\"Avatar\" style=\"border-color:var(--color-con-".$channel_top.")\">
                    <span class=\"name-left\"><a href=\"userProfile.php?user=".$this->name."\">".$this->name."</a></span>
                    <div class=\"message-text\"><p>".$this->body. "</p></div>
                    <span class=\"right-corner\">".$this->time."</span>");
            if ($admin=="1")
            {print ("<br><span class=\"right-corner\" onclick=\"killPost(".$this->key.")\"> delete post </span>");}
            else
            {print ("<br><span class=\"right-corner\">   </span>");}
            print("</div>");
        }
        
    }
    
    function print_as_searchresult($odd, $channel_top)
    { 
        
        if(($odd%2)==0){
            
        
        print( "    <a href=\"userProfile.php?user=".$this->name."\" class=\"name-center-a\">
                    <div class=\"container\" style=\"border-color:var(--color-acc-".$channel_top.");\">
                    <img class=\"search-user\" src=\"".$this->avatar."\" alt=\"Avatar\" style=\"border-color:var(--color-acc-".$channel_top.");\">
                    <div class=\"name-center\">".$this->name."</div></div></a>"
                    );
    }
    else
    {
        print( "    <a href=\"userProfile.php?user=".$this->name."\" class=\"name-center-a\">
                    <div class=\"container b\" style=\"border-color:var(--color-con-".$channel_top.");\">
                    <img class=\"search-user\" src=\"".$this->avatar."\" alt=\"Avatar\" style=\"border-color:var(--color-con-".$channel_top.");\">
                    <div class=\"name-center\">".$this->name."</div></div></a>"
                    );
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
