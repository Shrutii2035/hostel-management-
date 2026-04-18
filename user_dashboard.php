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
body {
    background: #f6e8f0;
    background-image:
        radial-gradient(circle at 15% 15%, rgba(212, 83, 126, 0.35) 0%, transparent 40%),
        radial-gradient(circle at 85% 80%, rgba(179, 120, 200, 0.38) 0%, transparent 40%),
        radial-gradient(circle at 60% 10%, rgba(240, 180, 220, 0.4) 0%, transparent 35%),
        radial-gradient(circle at 30% 80%, rgba(200, 150, 210, 0.35) 0%, transparent 35%);
    font-family: Arial;
    min-height: 100vh;
    overflow: hidden;
}

.bubble {
    position: fixed;
    border-radius: 50%;
    z-index: 0;
}

.b1 { width: 100px; height: 100px; background: rgba(212, 83, 126, 0.18); top: 8%; left: 5%; }
.b2 { width: 60px;  height: 60px;  background: rgba(179, 120, 200, 0.2); top: 15%; right: 8%; }
.b3 { width: 80px;  height: 80px;  background: rgba(240, 160, 210, 0.2); bottom: 10%; left: 8%; }
.b4 { width: 50px;  height: 50px;  background: rgba(200, 140, 220, 0.22); bottom: 15%; right: 6%; }

.card {
    max-width: 500px;
    margin: 120px auto;
    background: #fff;
    padding: 40px;
    border-radius: 22px;
    text-align: center;
    box-shadow: 0 8px 32px rgba(160, 90, 140, 0.13), 0 1.5px 4px rgba(160, 90, 140, 0.07);
    position: relative;
    z-index: 1;
}

.card::before {
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

.card::after {
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

.btn {
    display: block;
    margin: 12px 0;
    padding: 14px;
    border-radius: 14px;
    text-decoration: none;
    color: white;
    font-size: 16px;
}

.fill   { background: #6b4c5e; }
.status { background: #1565c0; }
.review { background: #b48fa8; }
.delete { background: #c62828; }

.btn:hover { opacity: 0.9; }

.logout {
    margin-top: 10px;
    display: inline-block;
    font-size: 15px;
    text-decoration: none;
    color: black;
}
</style>

</head>

<body>

<!-- Bubbles around the page corners -->
<div class="bubble b1"></div>
<div class="bubble b2"></div>
<div class="bubble b3"></div>
<div class="bubble b4"></div>

<div class="card">
    <h2>Welcome, <?= htmlspecialchars($username) ?></h2>
    <h3>Roomify Portal</h3>

    <!-- If form NOT filled -->
    <?php if(!$hasForm){ ?>
        <a class="btn fill" href="personal_details.php">
            📝 Fill Hostel Form
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

    <a class="logout" href="index.php">Logout</a>

</div>

</body>
</html>