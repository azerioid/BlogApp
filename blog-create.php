<?php

    require "libs/vars.php" ;
    require "views/_messages.php";
    require "libs/functions.php" ;
    $title=$description=$sdescription=$image="";
    $title_err=$description_err=$sdescription_err=$image_err="";

    $categories=getCategories() ;
    

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $input_title = trim($_POST["title"]) ;

        if(empty($input_title)) {
            $title_err= "title bos olmaz!";
        }elseif(strlen($input_title) > 150){
            $title_err= "Baslik ucun cox yazi var" ;
        }else{
            $title=control_input($input_title);
        }

    
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            $input_description = trim($_POST["description"]) ;
    
            if(empty($input_description)) {
                $description_err= "description bos olmaz!";
            }elseif(strlen($input_description) < 10){
                $description_err= "Description ucun cox az yazi var" ;
            }else{
                $description=control_input($input_description);
            }
        }

        if($_SERVER["REQUEST_METHOD"]=="POST") {
            $input_sdescription = trim($_POST["short_description"]) ;
    
            if(empty($input_sdescription)) {
                $sdescription_err= "Short description bos olmaz!";
            }elseif(strlen($input_sdescription) < 10){
                $sdescription_err= "Short Description ucun cox az yazi var" ;
            }else{
                $sdescription=control_input($input_sdescription);
            }
        }

        if(empty($_FILES["image"]["name"])) {
            $image_err= "File Secilmedi!";
        }else{
            $result= saveImage($_FILES["image"]) ;
            if($result["isSuccess"]==0) {
                $image_err=$result["message"] ;
            }else{
                $image = $result["image"] ;
            }
        }
        $url = $_POST["url"] ;
        //$likes = $_POST["likes"] ;
        //$comments = $_POST["comments"] ;
        //$vizyon = $_POST["vizyon"] ;

        if(empty($title_err) && empty($description_err) && empty($sdescription_err) && empty($image_err)) {
            if(createBlog($title,$sdescription,$description,$image,$url)){
                $_SESSION["message"] = $title. " basliqli blog elave edildi!" ;
                $_SESSION["type"] = "success" ;
                header('Location: index.php') ;
                
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
                        <form action="blog-create.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid': '' ?>" name="title" id="title" value="<?php echo $title ?>">
                                <span class="invalid-feedback"><?php echo $title_err ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="sdescription" class="form-label">Short Description</label>
                                <textarea type="text" class="form-control <?php echo (!empty($sdescription_err)) ? 'is-invalid': '' ?>" name="short_description" id="sdescription"><?php echo $sdescription ?></textarea>
                                <span class="invalid-feedback"><?php echo $sdescription_err ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid': '' ?>" name="description" id="description"><?php echo $description ?></textarea>
                                <span class="invalid-feedback"><?php echo $description_err ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid': '' ?>" name="image" id="image">
                                <span class="invalid-feedback"><?php echo $image_err ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">Url</label>
                                <input type="text" class="form-control" name="url" id="url">
                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </form>
                    </div>

                </div>

        
            </div>
        </div>
    </div>
    <?php include "views/_ckeditor.php" ?>
    <?php include "views/_footer.php" ?>