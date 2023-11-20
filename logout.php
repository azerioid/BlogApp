<?php
 include "libs/vars.php";
 setcookie("auth[username]",$user["username"], time() - (60 * 60)) ;
 setcookie("auth[name]",$user["name"], time() - (60 * 60)) ;
    header("Location: login.php") ;
 

?>