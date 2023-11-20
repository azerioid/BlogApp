<?php

    require "libs/vars.php" ;
    require "views/_messages.php";
    require "libs/functions.php" ;
    

?>
    <?php include "views/_header.php" ?>
    <?php include "views/_navbar.php" ?>

    <div class="container my-5">

        <div class="row">

            <div class="col-12">
              <div class="card mb-1">
                    <div class="card-body">
                        <a href="category-create.php" class="btn btn-primary">New categories</a>
                    </div>
              </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 120px;">Id</th>
                            <th>Category name</th>
                            <th style="width: 120px;">is active</th>
                            <th style="width: 130px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $result=getCategories() ; while ($film=mysqli_fetch_assoc($result)) : ?>
                                <tr> 
                                    <td><?php echo $film["id"] ?></td>
                                    <td><?php echo $film["name"] ?></td>
                                    <td>
                                        <?php if($film["isActive"]) : ?>
                                            <i class="fas fa-check"></i>
                                        <?php else: ?>
                                            <i class="fas fa-times"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="category-edit.php?id=<?php echo $film["id"] ?>">edit</a>
                                        <a class="btn btn-danger btn-sm" href="category-delete.php?id=<?php echo $film ["id"] ?>">delete</a>
                                    </td>
                                </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <?php include "views/_footer.php" ?>

    