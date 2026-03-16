<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['user']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$sql = "SELECT 
            b.booking_id,
            pd.name,
            pd.dob,
            pd.age,
            pd.contact,
            pd.email,
            b.booking_date,
            b.payment_status AS booking_payment_status,
            r.room_number,
            p.amount,
            p.payment_status AS payment_status,
            p.payment_date
        FROM bookings b
        JOIN personal_details pd ON b.personal_id = pd.personal_id
        JOIN rooms r ON b.room_id = r.room_id
        LEFT JOIN payments p ON b.booking_id = p.booking_id
        WHERE pd.email = ?
        ORDER BY b.booking_date DESC
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('No booking found'); window.location='user_dashboard.php';</script>";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Roomify – Booking Status</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
  background:#f6f1f5;
  font-family:Arial,sans-serif;
  color:#2e1f29;
}

@font-face{
  font-family:"fonts";
  src:url("fonts/Hello.otf");
}

/* CARD */
.card{
  max-width:700px;
  margin:60px auto;
  background:white;
  padding:40px;
  border-radius:22px;
  box-shadow:0 20px 45px rgba(0,0,0,0.1);
}

.card h2{
  font-family:"fonts";
  font-size:36px;
  color:#6b4c5e;
  font-weight: 100;
  margin-bottom:25px;
}

table{
  width:100%;
  border-collapse:collapse;
}

td{
  padding:12px;
  font-size:15px;
}

tr:nth-child(even){
  background:#faf6f9;
}

.status{
  padding:6px 14px;
  border-radius:20px;
  font-size:13px;
  font-weight:600;
}

.paid{
  background:#e6f4ea;
  color:#2e7d32;
}

.pending{
  background:#fdecea;
  color:#c62828;
}

.btn{
  display:inline-block;
  margin-top:25px;
  padding:12px 24px;
  background:#6b4c5e;
  color:white;
  text-decoration:none;
  border-radius:12px;
  margin-right:10px;
}

.btn:hover{
  background:#b48fa8;
}
</style>
</head>

<body>

<div class="card">
  <h2>Booking Status</h2>

  <table>
    <tr><td><strong>Booking ID</strong></td><td><?= $row['booking_id'] ?></td></tr>
    <tr><td><strong>Name</strong></td><td><?= htmlspecialchars($row['name']) ?></td></tr>
    <tr><td><strong>Email</strong></td><td><?= htmlspecialchars($row['email']) ?></td></tr>
    <tr><td><strong>Contact</strong></td><td><?= $row['contact'] ?></td></tr>
    <tr><td><strong>Room Number</strong></td><td><?= $row['room_number'] ?></td></tr>
    <tr><td><strong>Booking Date</strong></td><td><?= $row['booking_date'] ?></td></tr>

    <tr>
      <td><strong>Payment Status</strong></td>
      <td>
        <?php if($row['booking_payment_status']==1){ ?>
            <span class="status paid">PAID</span>
        <?php } else { ?>
            <span class="status pending">PENDING</span>
        <?php } ?>
      </td>
    </tr>

    <tr><td><strong>Amount</strong></td><td>₹<?= $row['amount'] ?? 0 ?></td></tr>
    <tr><td><strong>Payment Date</strong></td><td><?= $row['payment_date'] ?? '-' ?></td></tr>

  </table>

  <?php if($row['booking_payment_status'] == 1){ ?>
    <a href="receipt.php?booking_id=<?= $row['booking_id'] ?>" class="btn">
        🖨️ View Receipt
    </a>
<?php } ?>

  <a href="user_dashboard.php" class="btn">⬅ Back</a>
</div>

</body>
</html>
