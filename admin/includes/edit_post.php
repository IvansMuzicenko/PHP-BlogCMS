<?php
if (isset($_GET['p_id'])) {
    $edit_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
    $select_post_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_post_id)) {
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_content = $row['post_content'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
    }
}

if (isset($_POST['edit_post'])) {
    $post_id = $_GET['p_id'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "UPDATE posts SET post_category_id = '$post_category_id', post_title = '$post_title', post_author = '$post_author', post_date = now(), post_image = '$post_image', post_content = '$post_content', post_tags = '$post_tags', post_comment_count = '$post_comment_count', post_status = '$post_status' WHERE post_id = $post_id";

    $update_post_query = mysqli_query($connection, $query);

    confirmQuery($update_post_query);
    header("Location: posts.php");
}
?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="category">Category</label>

        <select name="post_category_id" id="category">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Post author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="title">Post status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width='100px' class='img-responsive' src='../images/<?php echo $post_image;?>'>
        <input type="file" name="image" value="<?php echo $post_image; ?>">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
    </div>
</form>