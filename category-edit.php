<?php

    require "libs/vars.php" ;
    require "views/_messages.php" ;
    require "libs/functions.php" ;

    $id = $_GET["id"] ;
    $result= getCategoryById($id) ;
    $selectedMovie=mysqli_fetch_assoc($result) ;


    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $name = $_POST["name"] ;
        $isActive=isset($_POST["isActive"]) ? 1: 0 ;
        // $likes = $_POST["likes"] ;
        // $comments = $_POST["comments"] ;
        // $vizyon = $_POST["vizyon"] ;




        if(editCategory($id,$name,$isActive)) {
            $_SESSION["message"] = $name." blog guncellendi" ;
            $_SESSION["type"] = "warning" ;
            header('Location: admin-categories.php') ;
        }else{
            echo "ERROR" ;
        }
      
    }
    

?>
    <?php include "views/_header.php" ?>
    <?php include "views/_navbar.php" ?>

    <div class="container my-3">

        <div class="row">

            
            <div class="col-12">
                
                <div class="card">

                    <div class="card-body">
                        <form  method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="name" class="form-control" name="name" id="name" value="<?php echo $selectedMovie["name"] ?>">
                            </div>

                            

                            <div class="form-check mb-3">
                                <label for="isActive" class="form-check-label">is active</label>
                                <input type="checkbox" class="form-check-input" name="isActive" id="isActive" <?php if($selectedMovie["isActive"]) {
                                    echo "checked";
                                }?>>
                            </div>

                            <input type="submit" value="Submit" class="btn btn-primary">
                        </form>
                    </div>

                </div>

        
            </div>
        </div>
    </div>
    <?php include "views/_footer.php" ?>