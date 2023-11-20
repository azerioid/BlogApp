<?php

if(isset($_GET["categoryid"]) && is_numeric($_GET["categoryid"])) {
    $selectedCategory=$_GET["categoryid"] ;
}
//echo $selectedCategory;
?>



<ul class="list-group">
<a href='index.php' class="list-group-item list-group-item-action">Butun Kategoriler</a>
 <?php $result=getCategories(); while($kategori=mysqli_fetch_assoc($result)) : ?>
    <?php if($kategori["isActive"]) : ?>
        <a href='<?php echo "index.php?categoryid=".$kategori["id"] ?>' class="list-group-item list-group-item-action 
        
        <?php 
        
        if($selectedCategory==$kategori["id"]) {
            echo "active";
        }
        
        ?>
        
        ">
            <?php echo ucfirst($kategori["name"]) ?>
        </a>
        <?php endif; ?>
    <?php endwhile; ?>


</ul>