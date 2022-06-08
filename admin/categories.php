<?php include "includes/header.php"; ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Admin panel
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php 
                            if (isset($_POST['submit'])) {
                                $cat_title = $_POST['cat_title'];
                                if ($cat_title == "" || empty($cat_title)) {
                                    echo "<p class='text-danger'>Category title should not be empty</p>";
                                } else {
                                    $query = "INSERT INTO categories(cat_title) VALUE('$cat_title')";

                                    $create_category_query = mysqli_query($connection, $query);

                                    if (!$create_category_query) {
                                        die("Query failed:" . mysqli_error($connection));
                                    }
                                }
                            }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat_title">Category title</label>
                                <input class="form-control" type="text" name="cat_title" id="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        $query = "SELECT * FROM categories";
                        $select_categories = mysqli_query($connection, $query);
                        ?>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($select_categories)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<tr><td>$cat_id</td><td>$cat_title</td></tr>";
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/footer.php"; ?>