<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];

                $query = "SELECT * FROM posts WHERE post_id = $post_id LIMIT 1";
                $select_all_posts = mysqli_query($connection, $query);

                $row = mysqli_fetch_assoc($select_all_posts);
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];


            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php    } ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST['create_comment'])) {
                $the_post_id = $_GET['p_id'];
                $post_author = $_POST['comment_author'];
                $post_email = $_POST['comment_email'];
                $post_content = $_POST['comment_content'];

                $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,
                    comment_content,comment_status,comment_date) ";
                $query .= "VALUES('{$the_post_id}','{$post_author}','{$post_email}','{$post_content}','unapproved', now())";
                $add_comment_query = mysqli_query($connection, $query);
                //confirmQuery($add_comment_query);
            }

            ?>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action='' method='post' role="form">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input class="form-control" type="text" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <!-- Comment -->
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id={$post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);
            if (!$select_comment_query) {
                die("QUERY FAILED. " . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($select_comment_query)) {
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];
            ?>
                <div class="media">              

                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>

                        <!-- Nested Comment -->
                        <!-- <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div> -->
                        <!-- End Nested Comment -->
                    </div>

                </div>
            <?php } ?>
            <!-- Pager -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>
    </div>
    <!-- /.row -->

    <hr>


    <?php include 'includes/footer.php'; ?>