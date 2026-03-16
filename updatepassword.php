<?php
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['useremail'];
    $newpass = $_POST['newpass'];
    $cpass = $_POST['cpass'];

    if ($newpass === $cpass) {
        // encrypt password before storing (important for security)
        $hashed_pass = password_hash($newpass, PASSWORD_DEFAULT);

        $query = "UPDATE users SET pass='$hashed_pass' WHERE email='$user_email' OR username='$user_email'";
        if (mysqli_query($conn, $query)) {
            echo "Password updated successfully. <a href='login.php'>Login</a>";
        } else {
            echo "Error updating password.";
        }
    } else {
        echo "Passwords do not match. <a href='forgotpassword.php'>Try again</a>";
    }
}
?>
