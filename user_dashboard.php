<?php
session_start();
include("db_connect.php");

/* Show review popup if exists */
if(isset($_SESSION['review_error'])) {
    echo "<script>alert('{$_SESSION['review_error']}');</script>";
    unset($_SESSION['review_error']);
}

/* Check login */
if (!isset($_SESSION['user']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];
$email = $_SESSION['email'];

/* ===============================
   CHECK IF USER HAS BOOKING
================================ */
$stmt = $conn->prepare("
    SELECT b.booking_id 
    FROM bookings b
    JOIN personal_details p ON b.personal_id = p.personal_id
    WHERE p.email = ?
");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$hasBooking = $result->num_rows > 0;

/* ===============================
   CHECK IF FORM IS FILLED
================================ */
$hasForm = false;

$stmt = $conn->prepare("
    SELECT pd.personal_id
    FROM personal_details pd
    JOIN parent_details pr ON pd.personal_id = pr.personal_id
    WHERE pd.email = ?
");
$stmt->bind_param("s", $email);
$stmt->execute();
$formResult = $stmt->get_result();

if($formResult->num_rows > 0){
    $hasForm = true;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>

<style>
body{
    background:#f6f1f5;
    font-family:Arial;
}

.card{
    max-width:500px;
    margin:120px auto;
    background:#fff;
    padding:40px;
    border-radius:22px;
    text-align:center;
    box-shadow:0 20px 40px rgba(0,0,0,0.1);
}

.btn{
    display:block;
    margin:12px 0;
    padding:14px;
    border-radius:14px;
    text-decoration:none;
    color:white;
    font-size:16px;
}

/* Button Colors */
.fill{background:#6b4c5e;}
.book{background:#2e7d32;}
.status{background:#1565c0;}
.review{background:#b48fa8;}
.delete{background:#c62828;}

.btn:hover{opacity:0.9;}

.logout{
    margin-top:10px;
    display:inline-block;
    font-size:15px;
    text-decoration:none;
    color:black;
}
</style>

</head>

<body>

<div class="card">
    <h2>Welcome, <?= htmlspecialchars($username) ?></h2>

    <!-- If form NOT filled -->
    <?php if(!$hasForm){ ?>
        <a class="btn fill" href="personal_details.php">
            📝 Fill Hostel Form
        </a>
    <?php } ?>

    <!-- If form filled but NO booking -->
    <?php if($hasForm && !$hasBooking){ ?>
        <a class="btn book" href="select_room.php">
            🏨 Select Room
        </a>
    <?php } ?>

    <!-- If booking exists -->
    <?php if($hasBooking){ ?>
        <a class="btn status" href="booking_status.php">
            📄 View Booking Status
        </a>

        <a class="btn delete"
           href="delete_booking_user.php"
           onclick="return confirm('Are you sure you want to cancel your booking? This action cannot be undone.');">
           ❌ Cancel Booking
        </a>
    <?php } ?>

    <!-- Always available -->
    <a class="btn review" href="review.php">
        ⭐ Give Review
    </a>

    <a class="logout" href="userlogout.php">Logout</a>

</div>

</body>
</html>
