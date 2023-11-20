<?php

    require "libs/vars.php" ;
    require "libs/functions.php" ;
 

    // filmEkle($filmler,"yeni film 1","yeni film 1","1.jpeg",25) ;
    // filmEkle($filmler,"yeni film 2","yeni film 2","2.jpeg",25,69,true) ;

    if(isset($_POST["login"])) {
       $username=$_POST["username"] ;
       $password=$_POST["password"] ;

        $user = getUser($username) ;

       if(!is_null($user) and $username == $user["username"] and $password == $user["password"]) {
            setcookie("auth[username]",$user["username"], time() + (60 * 60)) ;
            setcookie("auth[name]",$user["name"], time() + (60 * 60)) ;
            header('Location: test-prod.php') ;
       }else {
            echo "<div class='alert alert-danger mb-0 text-center'>Yanlish Username ve Password</div>";
       }

    }

    //shuffle($filmler);

?>
    <?php include "views/_header.php" ?>
    <?php include "views/_navbar.php" ?>

    <div class="container my-3">

        <div class="row">

            <div class="col-12">
            <div class="card">

<div class="card-body">
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">username</label>
            <input type="text" class="form-control" name="username" id="username">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">password</label>
            <input type="text" class="form-control" name="password" id="password">
        </div>

        <input type="submit" name="login" value="login" class="btn btn-primary">
    </form>
</div>

</div>
            </div>
           
        </div>
    </div>
    <?php include "views/_footer.php" ?>