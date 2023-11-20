<?php

require "libs/functions.php" ;
require "libs/vars.php" ;
require "views/_messages.php" ;

$id = $_GET["id"] ;

if(deleteBlog($id)) {
    $_SESSION["message"] = $id. " nomreli blog silindi!" ;
    $_SESSION["type"] = "danger" ;
    header('Location: admin-blogs.php') ;
}else {
    echo "error" ;
}



?>