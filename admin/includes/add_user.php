<?php
if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../images/$user_image");
    $query = "INSERT INTO users(username,user_password,user_firstname,user_lastname,
    user_email,user_image, user_role) ";
    
    $query .= "VALUES('{$username}','{$password}','{$user_firstname}','{$user_lastname}',
    '{$user_email}','{$user_image}','{$user_role}')";
    $add_user_query = mysqli_query($connection, $query);
    confirmQuery($add_user_query);
}

?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="form-control" >
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="text" name="password" id="password" class="form-control" >
</div>
<div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" name="user_firstname" id="user_firstname" class="form-control" >
</div>
<div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" name="user_lastname" id="user_lastname" class="form-control" >
</div>
<div class="form-group">
    <label for="user_tags">Email</label>
    <input type="text" name="user_email" id="user_email" class="form-control" >
</div>
<div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
<div class="form-group">
        <label for="Role">User Role</label>
        <select name="user_role" id="user_role" class="form-control">
           <option value="subscriber">Select Options</option>  
           <option value="admin">Admin</option>  
           <option value="subscriber">Subscriber</option>  
       </select>
    </div>
<div class="form-group">
    <button class="btn btn-primary" type="submit" name="create_user">Create User</button>
</div>

</form>