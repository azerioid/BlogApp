<?php

    require "libs/vars.php" ;
    require "views/_messages.php" ;
    require "libs/functions.php" ;

    $id = $_GET["id"] ;
    $result= getBlogById($id) ;
    $selectedMovie=mysqli_fetch_assoc($result) ;

    $categories=getCategories() ;
    $selectedCategories=getCategoriesbyBlogId($id);
    $selectedcategoryid=mysqli_fetch_assoc($selectedCategories) ;


    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $title = $_POST["title"] ;
        $short_description=$_POST["sdescription"];
        $description = control_input($_POST["description"]) ;
        $image = $_POST["image"] ;
        $url = $_POST["url"] ;
        $categories = $_POST["categories"] ;
        $isActive=isset($_POST["is-active"]) ? 1: 0 ;
        $isHome=isset($_POST["isHome"]) ? 1: 0 ;
        
        //print_r($categories) ;
        if(editBlog($id,$title,$short_description,$description,$image,$url,$isActive,$isHome)) {

            clearBlogCategories($id) ; #clear blog categories
            header('Location: admin-blogs.php') ;

            $_SESSION["message"] = $title." blog guncellendi" ;
            $_SESSION["type"] = "warning" ;
            header('Location: admin-blogs.php') ;

             if(count($categories) > 0) {
             addBlogCategories($id, $categories);  #add blog to categories
             }

        }else{
            echo "ERROR" ;
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

?>
    <?php include "views/_header.php" ?>
    <?php include "views/_navbar.php" ?>

    <div class="container my-3">
    
    <div class="card">
        <div class="card-body">
        <form  method="POST" enctype="multipart/form-data">
        <div class="row">

            
            <div class="col-9">
                
                
                        <div id="edit-form">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $selectedMovie["title"] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="sdescription" class="form-label">Short Description</label>
                                <textarea type="text" class="form-control" name="sdescription" id="sdescription"><?php echo $selectedMovie["short_description"] ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="description" id="description"><?php echo $selectedMovie["description"] ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">Url</label>
                                <input type="text" class="form-control" name="url" id="url" value="<?php echo $selectedMovie["url"] ?>">
                            </div>

                            

                            <div class="mb-3">
                                <label for="categories" class="form-label">category</label>
                                <select name="categories" id="categories" class="form-select <?php echo (!empty($category_err)) ? 'is-invalid': '' ?>" > 
                                    <option selected value="0">secin</option>
                                    <?php foreach($categories as $c) : ?>
                                        <?php 
                                            if($selectedcategoryid['category_id']==$c['id']) {
                                                 echo "<option selected value='{$c["id"]}'>{$c["name"]}</option>";
                                            }else{
                                                echo "<option  value='{$c["id"]}'>{$c["name"]}</option>";
                                            }
                                        ?>
                                       
                                    <?php endforeach; ?>

                                </select>
                                <span class="invalid-feedback"><?php echo $category_err ?></span>

                            </div>
                            <script type="text/javascript">
                                document.getElementById("category").value="<?php echo $category ?>"
                            </script>

                            <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                    
            </div>
            <div class="col-3">
                <?php foreach ($categories as $c): ?>
                    <div class="form-check">
                    <label for="category_<?php echo $c["id"] ?>"><?php echo $c["name"] ?></label>
                    <input type="checkbox" name="categories[]" id="category_<?php echo $c["id"] ?>" class="form-check-input" value="<?php echo $c["id"] ?>" 
                    
                    <?php
                    $isChecked=false;

                    foreach ($selectedCategories as $s) {
                        if($s["id"]==$c["id"]) {
                            $isChecked=true;
                        }
                    }

                    if($isChecked) {
                        echo "checked" ;
                    }

                    ?>
                    >
                </div>
                <?php endforeach; ?>
                <hr>

                <div class="form-check mb-3">
                    <label for="is-active" class="form-check-label">is active</label>
                    <input type="checkbox" class="form-check-input" name="is-active" id="is-active" <?php if($selectedMovie["isActive"]) {
                        echo "checked";
                    }?>>
                </div>

                <div class="form-check mb-3">
                    <label for="isHome" class="form-check-label">is home</label>
                    <input type="checkbox" class="form-check-input" name="isHome" id="isHome" <?php if($selectedMovie["isHome"]) {
                        echo "checked";
                    }?>>
                </div>
                    <hr>
                <input type="hidden" name="image" value="<?php echo $selectedMovie["imageUrl"]?>">
                <img class="img-fluid" src="img/<?php echo $selectedMovie["imageUrl"]?>" alt="">

            </div>
        </div>
     </form>

    </div>
    </div>
    </div>

    <?php include "views/_ckeditor.php" ?>
    <?php include "views/_footer.php" ?>