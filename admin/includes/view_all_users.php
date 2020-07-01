<table class="table table-bordered table-hover ">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>            
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>User Image</th>
            <th>Role</th>
            <th>Date</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
            echo ("<tr>
                                <td>{$user_id}</td>
                                <td>{$username}</td>
                                <td>{$user_firstname}</td>
                                <td>{$user_lastname}</td>
                                <td>{$user_email}</td>                            
                                <td><img width='50' src='../images/$user_image' /></td>                                
                                <td>{$user_role}</td>                                             
                                <td>2020</td>                                             
                                <td style='vertical-align: middle !important;text-align: center'><a  href='users.php?delete={$user_id}'>
                                <span class='glyphicon glyphicon-trash'></span>
                              </td>
                              <td style='vertical-align: middle !important;text-align: center'> <a href='users.php?source=edit_user&p_id={$user_id}'>
                              <span class='glyphicon glyphicon-edit'></span>
                            </a></td>
                                
                            </tr>");
        }
        ?>
    </tbody>
</table>
<?php

if (isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
    confirmQuery($delete_user_query);
}
?>