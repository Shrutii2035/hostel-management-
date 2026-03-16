<?php
session_start();
include 'db_connect.php';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = $_POST['name'];
    $email = trim($_POST['email']);
    $password = $_POST['pass'];
    $con_pass = $_POST['cpass'];

    if($password != $con_pass)
    {
        echo "<script>alert('Both passwords do not match!');
        window.location.href='signin.php';</script>";
        exit;
    }

    // Check if username or email exists
    $ch_sql = "SELECT 1 FROM users WHERE username = ? OR email = ?";
    $ch_stmt = $conn->prepare($ch_sql);
    $ch_stmt->bind_param("ss", $username, $email);
    $ch_stmt->execute();
    $result = $ch_stmt->get_result();

    if($result->num_rows > 0)
    {
        echo "<script>alert('Username or Email already exists!');
        window.location.href='signin.php';</script>";
        exit;
    }

    // Hash password
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO users (username,email,pass) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$username,$email,$hashed);

    if($stmt->execute())
    {
        // 🔥 THIS WAS MISSING
        $_SESSION['user'] = $username;
        $_SESSION['email'] = $email;

        header("Location: user_dashboard.php");
        exit;
    }
    else
    {
        header("Location: signin.php");
        exit;
    }
}
?>
