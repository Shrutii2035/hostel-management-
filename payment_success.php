<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['booking_id'])) {
    header("Location: user_dashboard.php");
    exit;
}

$booking_id = $_SESSION['booking_id'];
$amount = 5000;

/* Insert payment */
$stmt = $conn->prepare("
    INSERT INTO payments (booking_id, amount, payment_status)
    VALUES (?, ?, 'SUCCESS')
");
$stmt->bind_param("ii", $booking_id, $amount);
$stmt->execute();

/* Update booking */
$update = $conn->prepare("
    UPDATE bookings 
    SET payment_status = 1 
    WHERE booking_id = ?
");
$update->bind_param("i", $booking_id);
$update->execute();

/* Clear session */
unset($_SESSION['booking_id']);

/* Redirect to receipt */
header("Location: reciept.php?booking_id=" . $booking_id);
exit;
?>
