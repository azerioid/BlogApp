<?php

require "libs/functions.php" ;
require "libs/vars.php" ;
require "views/_messages.php" ;

$id = $_GET["id"] ;

if(deleteCategory($id)) {
    $_SESSION["message"] = $id. " nomreli category silindi!" ;
    $_SESSION["type"] = "danger" ;
    header('Location: admin-categories.php') ;
}else {
    echo "error" ;
}



?>