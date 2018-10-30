<?php

    //since it's all handled internally, shouldn't be a problem for now
    //though there may be a tidier way to handle it
function navbars($color) {
    
    print(
        "
        <div class=\"topnav\">
        <a href=\"index.php\">Lin Picked The Colors</a>"

        .login_info().

        "</div>
        <div class=\"topnav accent\" style=\"background-color: var(--color-acc-".$color.");\"></div>
        


    <div class=\"sidenav\">
        <br><br><br><br><br>
        <a href=".  test_permissions("channel.php?top=heliotrope").">Heliotrope</a>
        <a href=".  test_permissions("channel.php?top=tearose"). ">Tea Rose</a>
        <a href=".  test_permissions("channel.php?top=mint"). ">Mint</a>
        <a href=".  test_permissions("channel.php?top=milan"). ">Milan</a>
        <a href=".  test_permissions("channel.php?top=lightsky"). ">Light Sky</a>
       </div>
        "
        );
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function test_permissions($address){
        if(isset($_SESSION["user"]))
        {return $address;}
        else
            return "#";     
    }
    
    function login_info (){
        if(!isset($_SESSION["user"])){
            $output = "<form action=\"index.php\" method=\"post\" style=\" float: right;  margin-right:40px; margin-top:5px; \">
                        <input type=\"text\" placeholder=\"Username\" name=\"name\">
                        <input type=\"password\" placeholder=\"Password\" name=\"passcode\">
                        <button type=\"submit\">Login</button>
                        <a href=\"userRegistration.php\" style=\"font-size: 14px; margin-left: 2px;\">Sign up</a>
                        </form>
                        
";
                        
        }
        
        else {
            $output = "
                       <div class=\"dropdown\">
               
                       <img class= \"topnav-icon\" src=\"img/".$_SESSION["avatar"]."\" alt=\"Avatar\">
                                 <div class=\"dropdown-content\" >
                                <a href=\"upload.php\">Change Avatar</a>
                                <a href=\"logout.php\">Log out</a>
                              </div>
                           
                        </div>";
        }
        return $output;
    }
        