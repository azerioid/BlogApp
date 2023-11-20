<?php

    require "libs/vars.php" ;
    require "views/_messages.php";
    require "libs/functions.php" ;
    $categoryname="";
    $categoryname_err="";

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $input_categoryname = trim($_POST["categoryname"]) ;

        if(empty($input_categoryname)) {
            $categoryname_err= "name bos olmaz!";
        }elseif(strlen($input_categoryname) > 150){
            $categoryname_err= "Baslik ucun cox yazi var" ;
        }else{
            $categoryname=control_input($input_categoryname);
        }

    
        


        if(empty($categoryname_err)) {
            if(createCategory($categoryname)){
                $_SESSION["message"] = $categoryname. " adli category eklendi!" ;
                $_SESSION["type"] = "success" ;
                header('Location: admin-categories.php') ;
                
            }else{
                echo "error" ;
            } 
            
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
                        <form action="category-create.php" method="POST">
                            <div class="mb-3">
                                <label for="categoryname" class="form-label">categoryname</label>
                                <input type="categoryname" class="form-control <?php echo (!empty($categoryname_err)) ? 'is-invalid': '' ?>" name="categoryname" id="categoryname" value="<?php echo $categoryname ?>">
                                <span class="invalid-feedback"><?php echo $categoryname_err ?></span>
                            </div>

                            

                            <input type="submit" value="Submit" class="btn btn-primary">
                        </form>
                    </div>

                </div>

        
            </div>
        </div>
    </div>
    <?php include "views/_footer.php" ?>