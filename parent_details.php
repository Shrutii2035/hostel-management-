<?php
session_start();
include("db_connect.php");

$error = "";

if (!isset($_SESSION['personal_id'])) {
  die("Session expired. Please start again.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $fname    = trim($_POST['father_name']);
  $mname    = trim($_POST['mother_name']);
  $fcontact = trim($_POST['father_contact']);
  $mcontact = trim($_POST['mother_contact']);
  $addr     = trim($_POST['address']);
  $city     = trim($_POST['city']);

  if (!preg_match('/^[0-9]{10}$/', $fcontact)) {
    $error = "❌ Father contact number must be exactly 10 digits.";
  }
  elseif (!preg_match('/^[0-9]{10}$/', $mcontact)) {
    $error = "❌ Mother contact number must be exactly 10 digits.";
  }
  else {

    $personal_id = $_SESSION['personal_id'];

    $stmt = $conn->prepare("
      INSERT INTO parent_details
      (personal_id, fname, mname, fcontact, mcontact, addr, city)
      VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("issssss", $personal_id, $fname, $mname, $fcontact, $mcontact, $addr, $city);

    if (!$stmt->execute()) {
      $error = "❌ Database error. Please try again.";
    } else {
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
* { margin: 0; padding: 0; box-sizing: border-box; }

html, body {
  background: #f6e8f0;
  background-image:
      radial-gradient(circle at 15% 15%, rgba(212, 83, 126, 0.35) 0%, transparent 40%),
      radial-gradient(circle at 85% 80%, rgba(179, 120, 200, 0.38) 0%, transparent 40%),
      radial-gradient(circle at 60% 10%, rgba(240, 180, 220, 0.4) 0%, transparent 35%),
      radial-gradient(circle at 30% 80%, rgba(200, 150, 210, 0.35) 0%, transparent 35%);
  color: #2e1f29;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  min-height: 100vh;
}

@font-face {
  font-family: "fonts";
  src: url("fonts/Hello.otf");
}

/* BUBBLES */
.bubble {
  position: fixed;
  border-radius: 50%;
  z-index: 0;
}

.b1 { width: 100px; height: 100px; background: rgba(212, 83, 126, 0.18);  top: 8%;     left: 5%;  }
.b2 { width: 60px;  height: 60px;  background: rgba(179, 120, 200, 0.2);  top: 15%;    right: 8%; }
.b3 { width: 80px;  height: 80px;  background: rgba(240, 160, 210, 0.2);  bottom: 10%; left: 8%;  }
.b4 { width: 50px;  height: 50px;  background: rgba(200, 140, 220, 0.22); bottom: 15%; right: 6%; }

/* HEADER */
header {
  position: fixed;
  top: 0;
  width: 100%;
  height: 90px;
  background: rgba(255,255,255,0.85);
  backdrop-filter: blur(8px);
  box-shadow: 0 4px 25px rgba(0,0,0,0.08);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 70px;
  z-index: 1000;
}

.logo h1 {
  font-family: "fonts";
  font-size: 42px;
  color: #6b4c5e;
  margin-bottom: -6px;
}

.logo p {
  font-size: 14px;
  color: #8b6a7d;
}

.page-title {
  font-family: "fonts";
  font-size: 30px;
  color: #6b4c5e;
}

/* PAGE */
.page-wrapper {
  margin-top: 90px;
  padding: 90px 20px;
  position: relative;
  z-index: 1;
}

/* FORM CARD */
.form-card {
  max-width: 560px;
  margin: auto;
  background: #fff;
  padding: 40px;
  border-radius: 22px;
  box-shadow: 0 8px 32px rgba(160, 90, 140, 0.13), 0 1.5px 4px rgba(160, 90, 140, 0.07);
  position: relative;
}

.form-card::before {
  content: '';
  position: absolute;
  border-radius: 50%;
  width: 120px;
  height: 120px;
  background: rgba(212, 83, 126, 0.15);
  top: -40px;
  left: -40px;
  z-index: -1;
}

.form-card::after {
  content: '';
  position: absolute;
  border-radius: 50%;
  width: 90px;
  height: 90px;
  background: rgba(179, 120, 200, 0.2);
  bottom: -30px;
  right: -30px;
  z-index: -1;
}

.form-card h2 {
  font-family: "fonts";
  font-size: 36px;
  color: #6b4c5e;
  font-weight: 100;
  text-align: center;
  margin-bottom: 25px;
}

/* ERROR */
.error-msg {
  background: #fdeaea;
  color: #a33;
  padding: 14px;
  border-radius: 12px;
  margin-bottom: 20px;
  text-align: center;
}

/* INPUTS */
.form-group { margin-bottom: 18px; }

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 14px;
  font-size: 16px;
  border-radius: 12px;
  border: 1px solid #ddd;
  background: #fafafa;
}

.form-group textarea {
  resize: none;
  height: 90px;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #b48fa8;
  outline: none;
  background: #fff;
}

/* BUTTON */
.submit-btn {
  width: 100%;
  padding: 14px;
  background: #6b4c5e;
  color: white;
  border: none;
  border-radius: 14px;
  font-size: 17px;
  cursor: pointer;
}

.submit-btn:hover { background: #5a3f4f; }
</style>
</head>

<body>

<!-- Bubbles -->
<div class="bubble b1"></div>
<div class="bubble b2"></div>
<div class="bubble b3"></div>
<div class="bubble b4"></div>

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