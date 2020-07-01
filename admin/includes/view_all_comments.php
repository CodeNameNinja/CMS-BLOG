<table class="table table-bordered table-hover ">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_date = $row['comment_date'];
            $comment_status = $row['comment_status'];

            $query = "SELECT * FROM comments";
            $select_all_comments = mysqli_query($connection, $query);

            confirmQuery($select_all_comments);
            $row = mysqli_fetch_assoc($select_all_comments);
            $get_post_query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post = mysqli_query($connection, $get_post_query);
            $row = mysqli_fetch_assoc($select_post);
            $post_title = $row['post_title'];
            $post_id = $row['post_id'];
            echo ("<tr>
                                <td>{$comment_id}</td>
                                <td>{$comment_author}</td>
                                <td>{$comment_content}</td>
                                <td>{$comment_email}</td>
                                <td>{$comment_status}</td>                            
                                <td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>                                
                                <td>{$comment_date}</td>
                                <td><a href ='comments.php?approve=$comment_id'>Approve </></td>                            
                                <td><a href ='comments.php?unapprove=$comment_id'>Unapprove </></td>                                                  
                                <td style='vertical-align: middle !important;text-align: center'><a  href='comments.php?delete={$comment_id}'>
                                <span class='glyphicon glyphicon-trash'></span>
                              </a>
                                
                            </tr>");
        }
        ?>
    </tbody>
</table>

<?php

if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
    $update_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    confirmQuery($update_comment_query);
}
if (isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
    $update_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    confirmQuery($update_comment_query);
}
if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    confirmQuery($delete_comment_query);
}
?>