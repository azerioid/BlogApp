<?php 

    

    // function createUser(string $name, string $email,string $username,string $password) {
    //     $db=getData() ;
    //     array_push($db["users"], array(
    //         "id" => count($db["users"]) + 1,
    //         "name" => $name,
    //         "email" => $email,
    //         "username" => $username,
    //         "password" => $password
    //     ));
    //     $myfile = fopen("db.json","w");
    //     fwrite($myfile, json_encode($db, JSON_PRETTY_PRINT));
    //     fclose($myfile) ;
    // }


    function createBlog(string $title,string $sdescription,string $description,string $image, string $url, int $isActive=1) {
       
    include "libs/ayar.php" ;

    $query = "INSERT INTO blogs(title,short_description,description,imageUrl,url, isActive) VALUES( ?, ?,?,?,?,?)" ;

    $result = mysqli_prepare($connection,$query) ;

    mysqli_stmt_bind_param($result,'sssssi',$title,$sdescription,$description,$image,$url,$isActive) ;
    mysqli_stmt_execute($result) ;
   // mysqli_stmt_close($connection) ;

    return $result;
        
}

function createCategory(string $categoryname) {
       
    include "libs/ayar.php" ;

    $query = "INSERT INTO categories(name) VALUES( ? )" ;

    $result = mysqli_prepare($connection,$query) ;

    mysqli_stmt_bind_param($result,'s',$categoryname) ;
    mysqli_stmt_execute($result) ;
   // mysqli_stmt_close($connection) ;

    return $result;
        
}

    function getBlogs() {
         include "libs/ayar.php" ;

         $query = "SELECT * FROM blogs" ;

         $result = mysqli_query($connection,$query) ;
         
         return $result ;
    }


    function getHomePageBlogs() {
        include "libs/ayar.php" ;

        $query = "SELECT * FROM blogs WHERE isActive=1 and isHome=1 order by timeDate DESC" ;

        $result = mysqli_query($connection,$query) ;
        
        return $result ;

   }

    function getBlogsByKeyword($q) {
        include "libs/ayar.php" ;

        $search = "SELECT * FROM blogs WHERE title like '%$q%'" ;

        $result = mysqli_query($connection,$search) ;
        
        return $result ;

   }

    function getBlogById($movieId) {
        include "libs/ayar.php" ;

        $query = "SELECT * FROM blogs WHERE id='$movieId'" ;

        $result = mysqli_query($connection,$query) ;
         
        return $result ;
    }

    function getCategories() {
        include "libs/ayar.php" ;

        $query = "SELECT * FROM categories" ;

        $result = mysqli_query($connection,$query) ;
         
        return $result ;


    }

    function editBlog(int $id, string $title,string $short_description,string $description,string $image,string $url,$isActive,$isHome) {
        include "libs/ayar.php" ;

       $update = "UPDATE blogs SET title='$title',short_description='$short_description',description='$description',imageUrl='$image',url='$url',isActive=$isActive,isHome=$isHome WHERE id='$id'" ;

       $result=mysqli_query($connection,$update) ;
       echo mysqli_error($connection) ;

       return $result ;

    }

    function saveImage($file) {
        $message="";
        $uploadOk=1;
        $fileTempPath=$file["tmp_name"] ;
        $fileName=$file["name"];
        $fileSize=$file["size"] ;
        $maxFileSize=(1024 * 1024) * 3 ;
        $fileUzantilari=array("jpg","PNG","png","jpeg") ;
        $uploadFolder="./img/";


        if($fileSize > $maxFileSize) {
            $message= "File in olcusu cox boyukdur<br>" ;
            $uploadOk=0;
        }

        $fileAdi_Arr=explode(".",$fileName) ;
        $fileAdi_Uzantisiz=$fileAdi_Arr[0] ;
        $fileAdiUzantisi=$fileAdi_Arr[1] ;


        if(!in_array( $fileAdiUzantisi, $fileUzantilari)) {
            $message.="File tipi Qebul edilmir!<br>" ;
            $message.="Qebul edilen file tipi : ".implode(".",$fileUzantilari)."<br>" ;
            $uploadOk=0;

        }

        $yeniFileAdi=md5(time().$fileAdi_Uzantisiz).".".$fileAdiUzantisi ;
        $dest_path=$uploadFolder.$yeniFileAdi ;

        if($uploadOk==0) {
            $message.="File Yuklenmedi." ;
        }else {
            if(move_uploaded_file($fileTempPath,$dest_path)) {
            $message.="File Yuklendi." ;
        }
    }

        return array(
            "isSuccess"=> $uploadOk,
            "message"=> $message,
            "image"=>$yeniFileAdi,
        );
    }

    function clearBlogCategories(int $blogid) {
        include "libs/ayar.php" ;

       $delete = "DELETE  FROM blog_category WHERE blog_id=$blogid" ;

       $result=mysqli_query($connection,$delete) ;

       return $result ;
    }

    function addBlogCategories(int $blogid, array $categories) {
        include "libs/ayar.php" ;

        $query= "";

        foreach ($categories as $catid) {
           $query.="INSERT INTO blog_category(blog_id,category_id) VALUES ($blogid, $catid);" ;
        }
        
        $result=mysqli_multi_query($connection,$query) ;
 
        return $result ;
    }

    function getCategoryById($movieId) {
        include "libs/ayar.php" ;

        $query = "SELECT * FROM categories WHERE id='$movieId'" ;

        $result = mysqli_query($connection,$query) ;
         
        return $result ;
    }

    function getCategoriesbyBlogId($id) {
        include "libs/ayar.php" ;
        $query = "SELECT * FROM blog_category INNER JOIN categories on blog_category.category_id=categories.id WHERE blog_category.blog_id=$id" ;

        $result = mysqli_query($connection,$query) ;
         
        return $result ;
    }

    function getBlogbyCategoriesId($id) {
        include "libs/ayar.php" ;
        $query = "SELECT * FROM blog_category INNER JOIN blogs on blog_category.blog_id=blogs.id WHERE blog_category.category_id=$id" ;

        $result = mysqli_query($connection,$query) ;
         
        return $result ;
    }

    function editCategory(int $id, string $name, $isActive) {
        include "libs/ayar.php" ;

       $update = "UPDATE categories SET name='$name',isActive=$isActive WHERE id='$id'" ;

       $result=mysqli_query($connection,$update) ;
       echo mysqli_error($connection) ;

       return $result ;

    }

    function deleteBlog(int $id) {
        include "libs/ayar.php" ;
        $delete="DELETE FROM blogs WHERE id='$id'";
        $result=mysqli_query($connection,$delete) ;
        return $result;
    }

    function deleteCategory(int $id) {
        include "libs/ayar.php" ;
        $delete="DELETE FROM categories WHERE id='$id'";
        $result=mysqli_query($connection,$delete) ;
        return $result;
    }

    function control_input($data) {
        $data=htmlspecialchars($data);
        $data=stripslashes($data);
        $data=strip_tags($data) ;

        return $data;

    }

   


    // function filmleriGetir() {
    //     $myfile= fopen("veriler.txt","r") ;
    //     $liste=[] ;
    //     while (($setir=fgets($myfile)) !== false) {
    //         $dilimler= explode("|",$setir) ;
    //         array_push($liste,array(
    //             "baslik" =>$dilimler[0],
    //             "aciklama" =>$dilimler[1],
    //             "resim" =>$dilimler[2],
    //             "url" =>$dilimler[3],
    //             "yorumSayisi" =>$dilimler[4],
    //             "begeniSayisi" =>$dilimler[5],
    //             "vizyon" =>$dilimler[6],

    //         ));
    //     }
    //     fclose($myfile) ;
    //     return $liste;
    // }


    function kisaAciklama($aciklama,$limit) {
        if(strlen($aciklama) > $limit) {
            echo substr($aciklama,0,$limit)."..." ;
          }else{
              echo $aciklama ;
          } ;
    }


?>