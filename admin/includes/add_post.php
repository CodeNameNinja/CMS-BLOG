<?php
if (isset($_POST['create_post'])) {
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
    $query = "INSERT INTO posts(post_category_id,post_title,post_author,
    post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
    
    $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',
    now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}' )";
    $add_post_query = mysqli_query($connection, $query);
    confirmQuery($add_post_query);
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" id="post_title" class="form-control">
    </div>
    <div class="form-group">
    <select name="post_category_id" id="post_category_id" class="form-control">
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
        <input type="text" name="post_author" id="post_author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name="post_status" id="post_status" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" id="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" name="post_content" id="post_content" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit" name="create_post">Publish</button>
    </div>

</form>