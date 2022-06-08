<?php 
function insert_categories() {
    global $connection;

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
}

function find_all_categories() {
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>
                <td>$cat_id</td>
                <td>$cat_title</td>
                <td><a href='categories.php?delete=$cat_id'>Delete</a></td>
                <td><a href='categories.php?edit=$cat_id'>Edit</a></td>
            </tr>";
    }
}

function delete_categories(){
    global $connection;
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = $delete_id";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
?>