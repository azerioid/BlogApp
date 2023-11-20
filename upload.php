<?php

    if(isset($_POST["btnSubmit"]) && $_POST["btnSubmit"]=="Submit") {
        
        echo "<pre>";
        print_r($_FILES) ;

        $fileTempPath=$_FILES["Upload"]["tmp_name"] ;
        $fileName=$_FILES["Upload"]["name"] ;

        $uploadFolder='./img/' ;

        $dest_path= $uploadFolder.$fileName;

        if(move_uploaded_file($fileTempPath,$dest_path)) {
            echo "Upload Successfull" ;
        }else{
            echo "No Upload Successfull";
        }
        
    }else{
        echo "no submitted";
    }


?>