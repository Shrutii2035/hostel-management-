<?php
session_start();
include("db_connect.php");

$error = "";

/* ===== SAFETY CHECK ===== */
if (!isset($_SESSION['personal_id'])) {
  die("Session expired. Please start again.");
}

/* ===== HANDLE FORM SUBMISSION ===== */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $fname    = trim($_POST['father_name']);
  $mname    = trim($_POST['mother_name']);
  $fcontact = trim($_POST['father_contact']);
  $mcontact = trim($_POST['mother_contact']);
  $addr     = trim($_POST['address']);
  $city     = trim($_POST['city']);

  /* ===== CONTACT VALIDATION (STRICT 10 DIGITS) ===== */
  if (!preg_match('/^[0-9]{10}$/', $fcontact)) {
    $error = "❌ Father contact number must be exactly 10 digits.";
  }
  elseif (!preg_match('/^[0-9]{10}$/', $mcontact)) {
    $error = "❌ Mother contact number must be exactly 10 digits.";
  }
  else {

    $personal_id = $_SESSION['personal_id'];

    /* ===== INSERT INTO parent_details (FINAL COLUMN NAMES) ===== */
    $stmt = $conn->prepare("
      INSERT INTO parent_details
      (personal_id, fname, mname, fcontact, mcontact, addr, city)
      VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
      "issssss",
      $personal_id,
      $fname,
      $mname,
      $fcontact,
      $mcontact,
      $addr,
      $city
    );

    if (!$stmt->execute()) {
      $error = "❌ Database error. Please try again.";
    } else {

      // optional
      $_SESSION['parent'] = $_POST;

      header("Location: select_room.php");
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
<title>Roomify – Parent Details</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;}
html,body{
  background:#f6f1f5;
  color:#2e1f29;
  font-family:"Segoe UI",Tahoma,Geneva,Verdana,sans-serif;
}
@font-face{
  font-family:"fonts";
  src:url("fonts/Hello.otf");
}
header{
  position:fixed;top:0;width:100%;height:90px;
  background:rgba(255,255,255,0.85);
  backdrop-filter:blur(8px);
  box-shadow:0 4px 25px rgba(0,0,0,0.08);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 70px;z-index:1000;
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
.page-title{
  font-family:"fonts";
  font-size:30px;
  color:#6b4c5e;
}
.page-wrapper{
  margin-top:90px;
  padding:90px 20px;
}
.form-card{
  max-width:560px;
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
    font-weight: 100;

  text-align:center;
  margin-bottom:25px;
}
.error-msg{
  background:#fdeaea;
  color:#a33;
  padding:14px;
  border-radius:12px;
  margin-bottom:20px;
  text-align:center;
}
.form-group{margin-bottom:18px;}
.form-group input,
.form-group textarea{
  width:100%;
  padding:14px;
  font-size:16px;
  border-radius:12px;
  border:1px solid #ddd;
  background:#fafafa;
}
.form-group textarea{
  resize:none;
  height:90px;
}
.form-group input:focus,
.form-group textarea:focus{
  border-color:#b48fa8;
  outline:none;
  background:#fff;
}
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
.submit-btn:hover{background:#5a3f4f;}
</style>
</head>

<body>

<header>
  <div class="logo">
    <h1>Roomify</h1>
    <p>Girls Hostel</p>
  </div>
  <div class="page-title">Parent Details</div>
</header>

<div class="page-wrapper">
  <div class="form-card">

    <h2>Enter Parent Details</h2>

    <?php if ($error != "") { ?>
      <div class="error-msg"><?= $error ?></div>
    <?php } ?>

    <form method="POST">

      <div class="form-group">
        <input type="text" name="father_name" placeholder="Father's Name" required>
      </div>

      <div class="form-group">
        <input type="text" name="mother_name" placeholder="Mother's Name" required>
      </div>

      <div class="form-group">
        <input type="text" name="father_contact"
               placeholder="Father's Contact (10 digits)"
               pattern="[0-9]{10}" maxlength="10" required>
      </div>

      <div class="form-group">
        <input type="text" name="mother_contact"
               placeholder="Mother's Contact (10 digits)"
               pattern="[0-9]{10}" maxlength="10" required>
      </div>

      <div class="form-group">
        <textarea name="address" placeholder="Full Address" required></textarea>
      </div>

      <div class="form-group">
        <input type="text" name="city" placeholder="City" required>
      </div>

      <button class="submit-btn">Next</button>

    </form>

  </div>
</div>

</body>
</html>
