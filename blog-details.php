<?php

    require "libs/vars.php" ;
    require "views/_messages.php";
    require "libs/functions.php" ;
    //require "libs/ayar.php" ;

    if(!isset($_GET["id"]) or !is_numeric($_GET["id"])) {
        header('Location: admin-blogs.php') ;
    }

    $result=getBlogById($_GET["id"]) ;
    $film=mysqli_fetch_assoc($result) ;


    


?>

    <?php include "views/_header.php" ?>
    <?php include "views/_navbar.php" ?>

    <div class="container my-5">

        <div class="row">

            <div class="col-12">
               
            <div class="card p-1" >
            <div class="row g-0">
            <div class="col-md-3">
            <img class="img-fluid" src="img/<?php echo $film["imageUrl"] ?>" class="img-fluid rounded-start" alt="<?php echo $film["title"] ?>">
            </div>
            <div class="col-md-9">
            <div class="card-body">
                <h5 class="card-title"><?php echo $film["title"] ?></h5>
                <p class="card-text"><?php echo htmlspecialchars_decode($film["short_description"]) ?></p>
                <hr>
                <p class="card-text"><?php echo htmlspecialchars_decode($film["description"]) ?></p>
                
            </div>
            </div>
        </div>
        </div>
        
            </div>
        </div>
    </div>
    <?php include "views/_footer.php" ?>

    