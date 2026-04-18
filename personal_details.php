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
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  font-family: "fonts";
  font-weight: 100;
  font-size: 30px;
  color: #6b4c5e;
}

.nav-right { margin-left: auto; }

.nav-right a {
  font-family: "fonts";
  font-size: 22px;
  text-decoration: none;
  color: #6b4c5e;
  padding: 8px 18px;
  border-radius: 20px;
  transition: background 0.3s ease;
}

.nav-right a:hover {
  background: rgba(107,76,94,0.1);
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
  max-width: 520px;
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
  text-align: center;
  margin-bottom: 25px;
  font-weight: 300;
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

.form-group input {
  width: 100%;
  padding: 14px;
  font-size: 16px;
  border-radius: 12px;
  border: 1px solid #ddd;
  background: #fafafa;
}

.form-group input:focus {
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

@media (max-width: 768px) {
  header      { padding: 0 25px; }
  .page-title { font-size: 24px; }
  .nav-right a{ font-size: 18px; }
}
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