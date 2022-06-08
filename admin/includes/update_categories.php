<?php
if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="cat_title_edit">Category title</label>
                <input class="form-control" type="text" name="cat_title" id="cat_title_edit" value="<?php if (isset($cat_title)) {
                                                                                                        echo $cat_title;
                                                                                                    } ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit" value="Edit category">
            </div>
        </form>
<?php }
} ?>
<?php if (isset($_POST['edit'])) {
    $cat_title = $_POST['cat_title'];
    $query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $cat_id";
    $edit_query = mysqli_query($connection, $query);

    if (!$edit_query) {
        die("Query failed:" . mysqli_error($connection));
    }
    header("Location: categories.php");
} ?>