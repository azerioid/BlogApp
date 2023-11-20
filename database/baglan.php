<?php


$baglan = mysqli_connect("localhost","root","","blogapp") ;

mysqli_set_charset($baglan,"UTF8") ;

if(mysqli_connect_errno()>0) {
    die("ERROR".mysqli_connect_errno()) ;
}

echo "mysql connect!!!" ;

//mysqli_close($baglan) ;

echo "mysql closed" ;

?>