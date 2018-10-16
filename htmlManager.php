<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;}

function navbars() {
    
    print(
        "
        <div class=\"topnav\">
        <a href=\"index.php\"><h2>Lin Picked The Colors</h2></a>
        
        <form action=\"index.php\" method=\"post\" style=\"float: right; margin-right:40px;\">
        (To log out, use username \"logout\".)        
        <input type=\"text\" placeholder=\"Username\" name=\"name\">
        <input type=\"password\" placeholder=\"Password\" name=\"passcode\">
        <button type=\"submit\">Login</button>
        </form>
        </div>

    <div class=\"sidenav\">
        <br><br><br><br><br>
        <a href=".  test_permissions("heliotrope.php").">Heliotrope</a>
        <a href=".  test_permissions("teaRose.php"). ">Tea Rose<a>
        <a href=".  test_permissions("mint.php"). ">Mint<a>
        <a href=".  test_permissions("milan.php"). ">Milan<a>
        <a href=".  test_permissions("lightSky.php"). ">Light Sky<a>
       </div>
        "
        );
    }

    function test_permissions($address){
        if(isset($_SESSION["user"]))
        {
            return $address;
        }
        else
        {
            return "#";
            
        }
            
    }
