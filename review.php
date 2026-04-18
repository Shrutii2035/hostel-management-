<?php
session_start();
include("db_connect.php");

$success = "";
$error = "";

if (!isset($_SESSION['user']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

/* CHECK IF USER HAS COMPLETED BOOKING */
// STEP 1: Get personal_id using email
// echo "Session Email: " . $email;
// exit();
$stmt = $conn->prepare("SELECT personal_id FROM personal_details WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    $_SESSION['review_error'] = "User not found.";
    header("Location: user_dashboard.php");
    exit();
}

$row = $res->fetch_assoc();
$personal_id = $row['personal_id'];


// STEP 2: Check if booking exists
$stmt2 = $conn->prepare("SELECT * FROM bookings WHERE personal_id=?");
$stmt2->bind_param("i", $personal_id);
$stmt2->execute();
$res2 = $stmt2->get_result();

if ($res2->num_rows == 0) {
    $_SESSION['review_error'] = "Fill form and complete booking to share your review.";
    header("Location: user_dashboard.php");
    exit();
}


/* HANDLE REVIEW SUBMISSION */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $rating = $_POST['rating'];
    $review_text = trim($_POST['review_text']);

    if ($rating < 1 || $rating > 5) {
        $error = "Invalid rating.";
    } elseif (empty($review_text)) {
        $error = "Review cannot be empty.";
    } else {

        $stmt = $conn->prepare("
            INSERT INTO reviews (personal_id, rating, review_text)
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param("iis", $personal_id, $rating, $review_text);

        if ($stmt->execute()) {
            $success = "✅ Thank you for your review!";
        } else {
            $error = "Something went wrong.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Roomify – Give Review</title>

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

.card{
  max-width:600px;
  margin:80px auto;
  background:white;
  padding:40px;
  border-radius:22px;
  box-shadow:0 20px 45px rgba(0,0,0,0.1);
}

.card h2{
  font-family:"fonts";
  font-size:36px;
  color:#6b4c5e;
  margin-bottom:25px;
}

select, textarea{
  width:100%;
  padding:12px;
  margin-bottom:20px;
  border-radius:12px;
  border:1px solid #ddd;
  font-size:14px;
}

textarea{
  height:120px;
  resize:none;
}

button{
  width:100%;
  padding:12px;
  background:#6b4c5e;
  color:white;
  border:none;
  border-radius:12px;
  cursor:pointer;
}

button:hover{
  background:#b48fa8;
}

.success{
  color:#2e7d32;
  margin-bottom:15px;
}

.error{
  color:#c62828;
  margin-bottom:15px;
}
</style>
</head>

<body>

<div class="card">
  <h2>Give Your Review</h2>

  <?php if($success) echo "<div class='success'>$success</div>"; ?>
  <?php if($error) echo "<div class='error'>$error</div>"; ?>

  <form method="POST">

    <label>Rating (1-5)</label>
    <select name="rating" required>
        <option value="">Select Rating</option>
        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
        <option value="4">⭐⭐⭐⭐ Good</option>
        <option value="3">⭐⭐⭐ Average</option>
        <option value="2">⭐⭐ Poor</option>
        <option value="1">⭐ Very Poor</option>
    </select>

    <label>Your Review</label>
    <textarea name="review_text" placeholder="Write your experience..." required></textarea>

    <button type="submit">Submit Review</button>

  </form>

  <br>
  <a href="user_dashboard.php" style="color:#6b4c5e;">⬅ Back to Dashboard</a>
</div>

</body>
</html>
