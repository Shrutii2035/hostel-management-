<?php
session_start();
include("db_connect.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name    = trim($_POST['name']);
  $dob     = $_POST['dob'];
  $age     = $_POST['age'];
  $contact = trim($_POST['contact']);
  $email   = trim($_POST['email']);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "❌ Please enter a valid email address.";
  }
  elseif (!preg_match('/^[0-9]{10}$/', $contact)) {
    $error = "❌ Contact number must be exactly 10 digits.";
  }
  else {

    $stmt = $conn->prepare("
      INSERT INTO personal_details (name, dob, age, contact, email)
      VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssiss", $name, $dob, $age, $contact, $email);

    if (!$stmt->execute()) {
      $error = "❌ Email already exists or database error.";
    } else {

      $_SESSION['personal_id'] = $conn->insert_id;
      $_SESSION['personal'] = $_POST;

      header("Location: parent_details.php");
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Roomify – Personal Details</title>

<style>
/* ========= RESET ========= */
*{margin:0;padding:0;box-sizing:border-box;}

html,body{
  background:#f6f1f5;
  color:#2e1f29;
  font-family:"Segoe UI",Tahoma,Geneva,Verdana,sans-serif;
}

/* ========= FONT ========= */
@font-face{
  font-family:"fonts";
  src:url("fonts/Hello.otf");
}

/* ========= HEADER ========= */
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
  margin-bottom:-6px;
}

.logo p{
  font-size:14px;
  color:#8b6a7d;
}

/* ===== CENTER TITLE ===== */
.page-title{
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  font-family:"fonts";
  font-weight: 100;
  font-size:30px;
  color:#6b4c5e;
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

/* ========= PAGE ========= */
.page-wrapper{
  margin-top:90px;
  padding:90px 20px;
}

/* ========= FORM CARD ========= */
.form-card{
  max-width:520px;
  margin:auto;
  background:#fff;
  padding:40px;
  border-radius:22px;
  box-shadow:0 18px 40px rgba(0,0,0,0.08);
}

.form-card h2{
  font-family:"fonts";
  font-size:36px;
  color:#6b4c5e;
  text-align:center;
  margin-bottom:25px;
  font-weight: 300;
}

/* ========= ERROR ========= */
.error-msg{
  background:#fdeaea;
  color:#a33;
  padding:14px;
  border-radius:12px;
  margin-bottom:20px;
  text-align:center;
}

/* ========= INPUTS ========= */
.form-group{margin-bottom:18px;}

.form-group input{
  width:100%;
  padding:14px;
  font-size:16px;
  border-radius:12px;
  border:1px solid #ddd;
  background:#fafafa;
}

.form-group input:focus{
  border-color:#b48fa8;
  outline:none;
  background:#fff;
}

/* ========= BUTTON ========= */
.submit-btn{
  width:100%;
  padding:14px;
  background:#6b4c5e;
  color:white;
  border:none;
  border-radius:14px;
  font-size:17px;
  cursor:pointer;
}

.submit-btn:hover{
  background:#5a3f4f;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
  header{padding:0 25px;}
  .page-title{font-size:24px;}
  .nav-right a{font-size:18px;}
}
</style>
</head>

<body>

<header>
  <div class="logo">
    <h1>Roomify</h1>
    <p>Girls Hostel</p>
  </div>

  <div class="page-title">Personal Details</div>

  <nav class="nav-right">
    <a href="index.php">Home</a>
  </nav>
</header>

<div class="page-wrapper">
  <div class="form-card">

    <h2>Enter Personal Details</h2>

    <?php if ($error != "") { ?>
      <div class="error-msg"><?= $error ?></div>
    <?php } ?>

    <form method="POST">

      <div class="form-group">
        <input type="text" name="name" placeholder="Full Name" required>
      </div>

      <div class="form-group">
        <input type="date" name="dob" required>
      </div>

      <div class="form-group">
        <input type="number" name="age" placeholder="Age" min="1" required>
      </div>

      <div class="form-group">
        <input type="text"
               name="contact"
               placeholder="Contact Number (10 digits only)"
               pattern="[0-9]{10}"
               maxlength="10"
               inputmode="numeric"
               required>
      </div>

      <div class="form-group">
        <input type="email" name="email" placeholder="Email Address" required>
      </div>

      <button class="submit-btn">Next</button>

    </form>
  </div>
</div>

</body>
</html>
