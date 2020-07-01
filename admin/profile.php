<?php include "includes/admin-header.php";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_profile = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($select_user_profile);
    $password = $row['user_password'];
    $firstname = $row['user_firstname'];
    $lastname = $row['user_lastname'];
    $email = $row['user_email'];
    $image = $row['user_image'];
    $user_role = $row['user_role'];
    
}
?>

<div id="wrapper">

    <?php include "includes/admin-navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome to admin <small><?php echo $username; ?></small></h1>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="<?php echo ($username) ?>">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="user_password" id="user_password" class="form-control" value="<?php echo ($password) ?>">
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" id="user_firstname" class="form-control" value="<?php echo ($firstname) ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" id="user_lastname" class="form-control" value="<?php echo ($lastname) ?>">
    </div>
    <div class="form-group">
        <label for="user_tags">Email</label>
        <input type="text" name="user_email" id="user_email" class="form-control" value="<?php echo ($email) ?>">
    </div>
    <div class="form-group">
        <img class="img-responsive" width="100" src="../images/<?php echo $image; ?>" alt="<?php echo $username; ?>">
        <input type="file" name="image" id="image">
    </div>
    <div class="form-group">
        <label for="Role">User Role</label>
        <select name="user_role" id="user_role" class="form-control">
            <option value="subscriber">Select Options</option>
            <option value="admin"  <?php echo ($user_role === 'admin') ? "selected" : " "?>>Admin</option>
            <option value="subscriber"  <?php echo ($user_role === 'subscriber') ? "selected" : " "?>>Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit" name="update_profile">Update Profile</button>
    </div>

</form>
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