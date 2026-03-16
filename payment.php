<?php
session_start();
if (!isset($_SESSION['booking_id'])) {
    header("Location: bookingform.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment</title>
<style>
body{
  font-family: Arial;
  background:#f6f1f5;
  text-align:center;
  padding-top:120px;
}
.box{
  background:white;
  width:400px;
  margin:auto;
  padding:30px;
  border-radius:12px;
}
button{
  padding:12px 25px;
  background:#6b4c5e;
  color:white;
  border:none;
  cursor:pointer;
  border-radius:8px;
}
</style>
</head>
<body>

<div class="box">
  <h2>Complete Payment</h2>
  <p>Amount: ₹5000</p>

  <form method="POST" action="payment_success.php">
    <button type="submit">Pay Now</button>
  </form>
</div>

</body>
</html>
