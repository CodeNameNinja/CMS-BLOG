<?php

if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id={$post_id}";
    $select_posts_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
    }
}

if(isset($_POST['update_post'])){
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['category_id'];
    $the_post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_status = $_POST['post_status'];

    move_uploaded_file($post_image_temp, "../images/$the_post_image");

    if(empty($the_post_image)){
        $the_post_image = $post_image;
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$the_post_image}' ";
    $query .= "WHERE post_id = {$post_id}";

    $update_post = mysqli_query($connection, $query);
    confirmQuery($update_post);
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" id="post_title" class="form-control" value="<?php echo ($post_title) ?>">
    </div>
    <div class="form-group">
       <select name="category_id" id="category_id" class="form-control">
           <?php
            $query = "SELECT * FROM categories ";
            $select_categories_id = mysqli_query($connection, $query);
            
            confirmQuery($select_categories_id);
            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
           ?>           
       </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" id="post_author" class="form-control" value="<?php echo ($post_author) ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name="post_status" id="post_status" class="form-control" value="<?php echo ($post_status) ?>">
    </div>
    <div class="form-group">
        <img class="img-responsive" width="500" src="../images/<?php echo $post_image;?>" alt="">
        <input type="file" name="image" id="image" >
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" id="post_tags" class="form-control" value="<?php echo ($post_tags) ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" name="post_content" id="post_content" class="form-control" cols="30" rows="10"><?php echo($post_content) ?>
        </textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit" name="update_post">Publish</button>
    </div>

</form>