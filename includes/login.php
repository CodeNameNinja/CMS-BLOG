<?php include "db.php"; ?>
<?php session_start(); ?>
<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("QUERY FAILED. " . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($select_user_query);
    $db_id = $row['user_id'];
    $db_username = $row['username'];
    $db_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];

    if ($username !== $db_username || $password !== $db_password) {
        header("Location: ../index.php ");
    } else {
        $_SESSION["userId"] = $db_id;
        $_SESSION["username"] = $db_username;
        $_SESSION["firstname"] = $user_firstname;
        $_SESSION["lastname"] = $user_lastname;
        $_SESSION["userRole"] = $user_role;
        header("Location: ../admin");
    }
}
