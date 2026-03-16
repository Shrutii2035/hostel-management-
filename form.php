<?php
session_start();
include("db_connect.php");

/* ===============================
   SAFETY CHECKS
================================ */
if (!isset($_SESSION['personal_id']) || !isset($_POST['room_id'])) {
  die("Invalid booking request.");
}

/* ===============================
   GET REQUIRED DATA
================================ */
$personal_id = $_SESSION['personal_id'];
$room_id     = $_POST['room_id'];

/* ===============================
   INSERT INTO BOOKINGS TABLE
================================ */
$stmt = $conn->prepare("
  INSERT INTO bookings (personal_id, room_id, booking_date, payment_status)
  VALUES (?, ?, CURDATE(), 'PENDING')
");

$stmt->bind_param("ii", $personal_id, $room_id);
$stmt->execute();

/* ===============================
   GET BOOKING ID
================================ */
$booking_id = $conn->insert_id;

/* ===============================
   SAVE FOR PAYMENT PAGE
================================ */
$_SESSION['booking_id'] = $booking_id;
$_SESSION['room_id']    = $room_id;

/* ===============================
   REDIRECT TO PAYMENT
================================ */
header("Location: payment.php");
exit();
?>
