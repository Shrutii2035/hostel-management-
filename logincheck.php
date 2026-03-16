<?php
session_start();
include 'db_connect.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = $_POST['name'];
    $password = $_POST['pass'];
    $sql = "SELECT pass, email FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_pass, $email);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_pass)) {
            $_SESSION['user'] = $username;
            $_SESSION['email'] = $email;
            header("Location: user_dashboard.php");
            exit;
        } else {
            header("Location: login.php?error=Invalid password");
            exit;
        }
    } else {
        header("Location: login.php?error=User not found");
        exit;
    }
}
?>