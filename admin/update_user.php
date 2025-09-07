<?php

include '../config.php';

if ($_SESSION['user']['user_type'] !== 'admin') {
    die("Access denied");
}

if (isset($_POST['update_user'])) {
    $id        = intval($_POST['user_id']);
    $username  = mysqli_real_escape_string($con, $_POST['username']);
    $email     = mysqli_real_escape_string($con, $_POST['email']);
    $phone     = mysqli_real_escape_string($con, $_POST['phone']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);

    // Optional password change
    $update_password_sql = "";
    if (!empty($_POST['new_password'])) {
        $new_password = md5($_POST['new_password']);
        $update_password_sql = ", password='$new_password'";
    }

    $query = "UPDATE users SET 
                username='$username',
                email='$email',
                phone='$phone',
                user_type='$user_type'
                $update_password_sql
              WHERE id=$id";

    if (mysqli_query($con, $query)) {
        echo "User updated successfully.";
        echo "<br><a href='view_users'>Go Back</a>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
