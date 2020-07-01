<?php
function confirmQuery($result){
    global $connection;
    if(!$result){
        echo("QUERY FAILED. " . mysqli_error($connection));
    }
}


function insert_categories() {
    global $connection;
    if (isset($_POST['submit'])) {
        $category_title = $_POST['cat_title'];
        if ($category_title == '' || empty($category_title)) {
            echo 'This field should not be empty';
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES ('$category_title')";

            $add_category_query = mysqli_query($connection, $query);
            if (!$add_category_query) {
                die('QUERY FAILED' . mysqli_error($connection, $query));
            }
        }
    }
}

function find_all_categories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr>";
        echo "<th scope='row'>{$cat_id}</th>";
        echo "<td>{$cat_title}</td> ";
        echo "<td><a href='categories.php?delete={$cat_id}'>
        <span class='glyphicon glyphicon-trash'></span>
      </a>
      <a href='categories.php?edit={$cat_id}' style='float:right'> Edit </a>
      </td>";

        echo "</tr>";
    }
   
   
}

function delete_category(){
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
        $delete_category_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
?>