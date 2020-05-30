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
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title" id="cat_title">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit" id="submit">Add Category</button>
                            </div>
                        </form>
                    </div><!-- Add Category Form -->
                    <div class="col-xs-6">
                        <table class= "table table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Category Title</th>
                                </tr>
                            </thread>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Soccer</td>

                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Baseball</td>
                                </tr>
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