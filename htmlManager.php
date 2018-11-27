<?php


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
    
    function test_permissions($address){
        if(isset($_SESSION["user"]))
        {return $address;}
        else
            return "index.php?login=0";     
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
               
                       <img class= \"topnav-icon\" id=\"topnav-icon\" src=\"".$_SESSION["avatar"]."\" alt=\"Avatar\">
                                 <div class=\"dropdown-content\" >
                                <a href=\"upload.php\">Change Avatar</a>
                                <a href=\"searchUsers.php\">Search Users</a>
                                <a href=\"pageNotFound.php\">Help</a>
                                <a href=\"logout.php\">Log out</a>
                              </div>
                           
                        </div>";
        }
        return $output;
    }
    
        