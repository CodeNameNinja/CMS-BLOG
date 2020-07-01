<table class="table table-bordered table-hover ">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Content</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = substr($row['post_content'], 0, 50);
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];

            $query = "SELECT * FROM categories WHERE cat_id = $post_category_id LIMIT 1";
            $select_categories_id = mysqli_query($connection, $query);

            confirmQuery($select_categories_id);
            $row = mysqli_fetch_assoc($select_categories_id);
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

            echo ("<tr>
                                <td>{$post_id}</td>
                                <td>{$post_author}</td>
                                <td>{$post_title}</td>
                                
                                <td>{$cat_title}</td>

                                <td>{$post_status}</td>
                                <td><img class = 'img-responsive' width = '100' src = '../images/$post_image' alt = {$post_title} /></td>
                                <td>{$post_tags}</td>
                                <td>{$post_comment_count}</td>
                                <td>{$post_date}</td>
                                <td>{$post_content}...</td>
                                <td style='vertical-align: middle !important;text-align: center'><a  href='posts.php?delete={$post_id}'>
                                <span class='glyphicon glyphicon-trash'></span>
                              </a></td>
                                <td style='vertical-align: middle !important;text-align: center'> <a href='posts.php?source=edit_post&p_id={$post_id}'>
                                <span class='glyphicon glyphicon-edit'></span>
                              </a></td>
                                
                            </tr>");
        }
        ?>
    </tbody>
</table>

<?php

if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_post_query = mysqli_query($connection, $query);
    header("Location: posts.php");
    confirmQuery($delete_post_query);
}
?>