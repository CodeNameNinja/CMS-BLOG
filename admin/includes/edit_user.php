<?php

if (isset($_GET['p_id'])) {
    $user_id = $_GET['p_id'];
    $query = "SELECT * FROM users WHERE user_id={$user_id}";
    $select_users_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users_by_id)) {
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
}

if (isset($_POST['update_user'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $the_user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];   

    move_uploaded_file($user_image_temp, "../images/$the_user_image");

    if (empty($the_user_image)) {
        $the_user_image = $user_image;
    }

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_password= '{$user_password}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_image = '{$the_user_image}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_id = {$user_id}";

    $update_user = mysqli_query($connection, $query);
    confirmQuery($update_user);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="<?php echo ($username) ?>">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="user_password" id="user_password" class="form-control" value="<?php echo ($user_password) ?>">
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" id="user_firstname" class="form-control" value="<?php echo ($user_firstname) ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" id="user_lastname" class="form-control" value="<?php echo ($user_lastname) ?>">
    </div>
    <div class="form-group">
        <label for="user_tags">Email</label>
        <input type="text" name="user_email" id="user_email" class="form-control" value="<?php echo ($user_email) ?>">
    </div>
    <div class="form-group">
        <img class="img-responsive" width="100" src="../images/<?php echo $user_image; ?>" alt="<?php echo $username; ?>">
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
        <button class="btn btn-primary" type="submit" name="update_user">Update User</button>
    </div>

</form>