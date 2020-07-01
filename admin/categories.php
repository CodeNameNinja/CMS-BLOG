<?php include "includes/admin-header.php" ?>
<div id="wrapper">

    <?php include "includes/admin-navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to the dashboard
                        <small>Author name</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php insert_categories(); ?>

                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title" id="cat_title">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit" id="submit">Add Category</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];
                            include 'includes/update_categories.php';
                        }
                        ?>
                    </div><!-- Add Category Form -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Category Title</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thread>
                            <tbody>
                                <?php
                                    find_all_categories();
                                    delete_category();
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

</div>
<!-- /#wrapper -->

<?php include "includes/admin-footer.php" ?>