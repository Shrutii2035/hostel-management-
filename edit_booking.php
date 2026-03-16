<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.php");
  exit();
}

if (!isset($_GET['booking_id'])) {
  die("Invalid request");
}

$booking_id = (int)$_GET['booking_id'];

/* ===== FETCH DATA ===== */
$sql = "
SELECT 
  b.booking_id,
  b.room_id,
  b.booking_date,
  pd.personal_id,
  pd.name,
  pd.age,
  pd.contact,
  pd.email
FROM bookings b
JOIN personal_details pd ON b.personal_id = pd.personal_id
WHERE b.booking_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

/* ===== UPDATE DATA ===== */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name    = $_POST['name'];
  $age     = $_POST['age'];
  $contact = $_POST['contact'];
  $email   = $_POST['email'];
  $room_id = $_POST['room_id'];

  /* UPDATE personal_details */
  $stmt1 = $conn->prepare("
    UPDATE personal_details
    SET name=?, age=?, contact=?, email=?
    WHERE personal_id=?
  ");
  $stmt1->bind_param(
    "sissi",
    $name, $age, $contact, $email, $data['personal_id']
  );
  $stmt1->execute();

  /* UPDATE bookings */
  $stmt2 = $conn->prepare("
    UPDATE bookings
    SET room_id=?
    WHERE booking_id=?
  ");
  $stmt2->bind_param("ii", $room_id, $booking_id);
  $stmt2->execute();

  header("Location: admin_dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Booking</title>
<style>
body{
  background:#f6f1f5;
  font-family:Arial;
}
.form-card{
  max-width:500px;
  margin:120px auto;
  background:white;
  padding:35px;
  border-radius:20px;
  box-shadow:0 20px 40px rgba(0,0,0,0.1);
}
.form-card h2{
  text-align:center;
  color:#6b4c5e;
}
input{
  width:100%;
  padding:12px;
  margin:12px 0;
  border-radius:10px;
  border:1px solid #ccc;
}
button{
  width:100%;
  padding:12px;
  background:#6b4c5e;
  color:white;
  border:none;
  border-radius:10px;
  font-size:16px;
}
button:hover{background:#b48fa8;}
</style>
</head>

<body>

<div class="form-card">
<h2>Edit Booking</h2>

<form method="POST">
  <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required>
  <input type="number" name="age" value="<?= $data['age'] ?>" required>
  <input type="text" name="contact" value="<?= htmlspecialchars($data['contact']) ?>" required>
  <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
  <input type="number" name="room_id" value="<?= $data['room_id'] ?>" required>

  <button>Update</button>
</form>
</div>

</body>
</html>
