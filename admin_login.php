<?php
session_start();
include("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Roomify – Admin Login</title>

<style>
/* ===== RESET ===== */
*{margin:0;padding:0;box-sizing:border-box;}

html,body{
  width:100%;
  height:100%;
  background:#f6f1f5;
  font-family:Arial, sans-serif;
  color:#2e1f29;
}

/* ===== FONT ===== */
@font-face{
  font-family:"fonts";
  src:url("fonts/Hello.otf");
  font-display:swap;
}

/* ===== HEADER ===== */
header{
  position:fixed;
  top:0;
  width:100%;
  height:90px;
  background:rgba(255,255,255,0.85);
  backdrop-filter:blur(8px);
  box-shadow:0 4px 25px rgba(0,0,0,0.08);
  display:flex;
  align-items:center;
  padding:0 70px;
  z-index:1000;
}

.logo h1{
  font-family:"fonts";
  font-size:42px;
  color:#6b4c5e;
  font-weight:400;
}

.logo p{
  font-size:14px;
  color:#8b6a7d;
  margin-top:-6px;
}

/* ===== CENTER TITLE ===== */
.nav-title{
  position:absolute;
  left:50%;
  transform:translateX(-50%);
}

.nav-title h1{
  font-family:"fonts";
  font-size:30px;
  color:#6b4c5e;
  font-weight:400;
}

/* ===== RIGHT NAV ===== */
.nav-right{
  margin-left:auto;
}

.nav-right a{
  font-family:"fonts";
  font-size:22px;
  text-decoration:none;
  color:#6b4c5e;
  padding:8px 18px;
  border-radius:20px;
  transition:background 0.3s ease;
}

.nav-right a:hover{
  background:rgba(107,76,94,0.1);
}

/* ===== MAIN ===== */
main{
  margin-top:120px;
  height:calc(100vh - 120px);
  display:flex;
  justify-content:center;
  align-items:center;
  padding:20px;
}

/* ===== LOGIN CARD ===== */
.admin-box{
  background:white;
  padding:45px 40px;
  border-radius:24px;
  width:100%;
  max-width:420px;
  box-shadow:0 20px 45px rgba(0,0,0,0.1);
  text-align:center;
}

.admin-box h2{
  font-family:"fonts";
  font-size:34px;
  color:#6b4c5e;
  margin-bottom:25px;
}

.admin-box input{
  width:100%;
  padding:12px 14px;
  margin-bottom:18px;
  border-radius:10px;
  border:1px solid #ddd;
  font-size:15px;
}

.admin-box input:focus{
  outline:none;
  border-color:#b48fa8;
  box-shadow:0 0 0 3px rgba(180,143,168,0.2);
}

.admin-box button{
  width:100%;
  padding:14px;
  background:#6b4c5e;
  color:white;
  border:none;
  border-radius:12px;
  font-size:16px;
  cursor:pointer;
}

.admin-box button:hover{
  background:#b48fa8;
}

.error{
  color:#c62828;
  margin-bottom:15px;
  font-size:14px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
  header{
    padding:0 25px;
  }

  .nav-title h1{
    font-size:24px;
  }

  .nav-right a{
    font-size:18px;
  }
}
</style>
</head>

<body>

<header>
  <div class="logo">
    <h1>Roomify</h1>
    <p>Girls Hostel</p>
  </div>

  <div class="nav-title">
    <h1>Admin Panel</h1>
  </div>

  <nav class="nav-right">
    <a href="index.php">Home</a>
  </nav>
</header>

<main>
  <form method="POST" class="admin-box">
    <h2>Admin Login</h2>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Login</button>
  </form>
</main>

</body>
</html>
