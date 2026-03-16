<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['user']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

/* Get personal_id */
$stmt = $conn->prepare("SELECT personal_id FROM personal_details WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    header("Location: user_dashboard.php");
    exit();
}

$row = $result->fetch_assoc();
$personal_id = $row['personal_id'];

/* DELETE EVERYTHING */

/* Delete booking (payments will auto delete if CASCADE is set) */
$stmt = $conn->prepare("DELETE FROM bookings WHERE personal_id=?");
$stmt->bind_param("i", $personal_id);
$stmt->execute();

/* Delete parent details */
$stmt = $conn->prepare("DELETE FROM parent_details WHERE personal_id=?");
$stmt->bind_param("i", $personal_id);
$stmt->execute();

/* Delete personal details */
$stmt = $conn->prepare("DELETE FROM personal_details WHERE personal_id=?");
$stmt->bind_param("i", $personal_id);
$stmt->execute();

/* Logout user */
session_destroy();

/* Success popup */
echo "<script>
alert('Booking successfully cancelled. You will get your refund soon.');
window.location.href='index.php';
</script>";
exit();
?>
