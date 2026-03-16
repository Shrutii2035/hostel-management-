<?php
// receipt.php
include "db_connect.php";

/* ===============================
   VALIDATE BOOKING ID
================================ */
if (!isset($_GET['booking_id']) || !is_numeric($_GET['booking_id'])) {
    echo "<script>alert('No booking ID provided.'); window.location.href='form.php';</script>";
    exit;
}

$booking_id = (int) $_GET['booking_id'];

/* ===============================
   FETCH BOOKING + PAYMENT INFO
================================ */
$sql = "SELECT
            b.booking_id,
            b.booking_date,
            b.payment_status,

            pd.name,
            pd.dob,
            pd.age,
            pd.contact,
            pd.email,

            pr.fname AS parent_name,
            pr.fcontact AS parent_contact,

            r.room_number,

            p.amount,
            p.payment_date

        FROM bookings b
        JOIN personal_details pd ON b.personal_id = pd.personal_id
        JOIN parent_details pr ON pd.personal_id = pr.personal_id
        JOIN rooms r ON b.room_id = r.room_id
        LEFT JOIN payments p ON b.booking_id = p.booking_id
        WHERE b.booking_id = ?
        LIMIT 1";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Booking not found.'); window.location.href='bookingform.php';</script>";
    exit;
}

$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

/* ===============================
   SAFE VARIABLES
================================ */
function s($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

$display_booking_date = $row['booking_date']
    ? (new DateTime($row['booking_date']))->format('d M Y, h:i A')
    : '-';

$display_payment_date = $row['payment_date']
    ? (new DateTime($row['payment_date']))->format('d M Y, h:i A')
    : '-';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Roomify – Booking Receipt</title>

<style>
/* ===== RESET & STABILITY ===== */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

html,body{
  background:#f6f1f5;
  font-family:Arial, sans-serif;
  color:#2e1f29;
  overflow-x:hidden;
}

/* ===== FONT ===== */
@font-face{
  font-family:"fonts";
  src:url("fonts/Hello.otf");
  font-display:swap;
}

/* ===== RECEIPT CARD ===== */
.receipt-wrapper{
  max-width:760px;
  margin:40px auto;
  padding:20px;
}

.receipt{
  background:white;
  border-radius:22px;
  box-shadow:0 20px 45px rgba(0,0,0,0.1);
  padding:40px 35px;
}

.receipt h1{
  font-family:"fonts";
  font-size:36px;
  color:#6b4c5e;
  font-weight: 100;
  margin-bottom:5px;
}

.receipt p.sub{
  font-size:14px;
  color:#8b6a7d;
  margin-bottom:25px;
}

hr{
  border:none;
  border-top:2px solid #e6dbe3;
  margin:20px 0;
}

/* ===== TABLE ===== */
table{
  width:100%;
  border-collapse:collapse;
  font-size:15px;
}

td{
  padding:10px 6px;
  vertical-align:top;
}

tr:nth-child(even){
  background:#faf6f9;
}

td:first-child{
  font-weight:600;
  width:40%;
  color:#4a3743;
}

/* ===== PAYMENT STATUS ===== */
.status{
  display:inline-block;
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

/* ===== ACTIONS ===== */
.actions{
  margin-top:30px;
  text-align:center;
}

.actions button{
  background:#6b4c5e;
  color:white;
  border:none;
  padding:12px 26px;
  border-radius:14px;
  font-size:15px;
  cursor:pointer;
  margin:5px;
}

.actions button:hover{
  background:#b48fa8;
}

/* ===== PRINT ===== */
@media print{
  body{
    background:white;
  }
  .actions{
    display:none;
  }
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
  .receipt{
    padding:30px 22px;
  }
  .receipt h1{
    font-size:30px;
  }
}
</style>
</head>

<body>

<div class="receipt-wrapper">
  <div class="receipt">

    <h1>Roomify Hostel</h1>
    <p class="sub">Official Booking Receipt</p>

    <hr>
<table>
  <tr><td>Booking ID</td><td><?php echo s($row['booking_id']); ?></td></tr>
  <tr><td>Name</td><td><?php echo s($row['name']); ?></td></tr>
  <tr><td>Date of Birth</td><td><?php echo s($row['dob']); ?></td></tr>
  <tr><td>Age</td><td><?php echo s($row['age']); ?></td></tr>
  <tr><td>Contact</td><td><?php echo s($row['contact']); ?></td></tr>
  <tr><td>Email</td><td><?php echo s($row['email']); ?></td></tr>
  <tr><td>Parent Name</td><td><?php echo s($row['parent_name']); ?></td></tr>
  <tr><td>Parent Contact</td><td><?php echo s($row['parent_contact']); ?></td></tr>
  <tr><td>Room Number</td><td><?php echo s($row['room_number']); ?></td></tr>
  <tr><td>Booking Date</td><td><?php echo s($display_booking_date); ?></td></tr>

  <tr>
    <td>Payment Status</td>
    <td>
      <?php if($row['payment_status'] == 1){ ?>
          <span class="status paid">PAID</span>
      <?php } else { ?>
          <span class="status pending">PENDING</span>
      <?php } ?>
    </td>
  </tr>

  <tr><td>Amount Paid</td><td>₹<?php echo s($row['amount'] ?? '0'); ?></td></tr>
  <tr><td>Payment Date</td><td><?php echo s($display_payment_date); ?></td></tr>
</table>

    <div class="actions">
      <button onclick="window.print()">🖨️ Print Receipt</button>
      <button onclick="window.location.href='index.php'">🏠 Home</button>
    </div>

  </div>
</div>

</body>
</html>
