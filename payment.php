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
<title>Roomify – Payment</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

html, body {
  font-family: Arial, sans-serif;
  background: #f6e8f0;
  background-image:
      radial-gradient(circle at 15% 15%, rgba(212, 83, 126, 0.35) 0%, transparent 40%),
      radial-gradient(circle at 85% 80%, rgba(179, 120, 200, 0.38) 0%, transparent 40%),
      radial-gradient(circle at 60% 10%, rgba(240, 180, 220, 0.4) 0%, transparent 35%),
      radial-gradient(circle at 30% 80%, rgba(200, 150, 210, 0.35) 0%, transparent 35%);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #2e1f29;
}

/* BUBBLES */
.bubble {
  position: fixed;
  border-radius: 50%;
  z-index: 0;
}

.b1 { width: 100px; height: 100px; background: rgba(212, 83, 126, 0.18);  top: 8%;     left: 5%;  }
.b2 { width: 60px;  height: 60px;  background: rgba(179, 120, 200, 0.2);  top: 15%;    right: 8%; }
.b3 { width: 80px;  height: 80px;  background: rgba(240, 160, 210, 0.2);  bottom: 10%; left: 8%;  }
.b4 { width: 50px;  height: 50px;  background: rgba(200, 140, 220, 0.22); bottom: 15%; right: 6%; }

/* BOX */
.box {
  background: white;
  width: 420px;
  padding: 44px 38px;
  border-radius: 22px;
  box-shadow: 0 8px 32px rgba(160, 90, 140, 0.13), 0 1.5px 4px rgba(160, 90, 140, 0.07);
  position: relative;
  z-index: 1;
  text-align: center;
}

.box::before {
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

.box::after {
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

.box .icon {
  font-size: 46px;
  margin-bottom: 14px;
}

.box h2 {
  font-size: 24px;
  color: #6b4c5e;
  margin-bottom: 10px;
  font-weight: 500;
}

.box .amount {
  font-size: 32px;
  font-weight: 700;
  color: #4a3743;
  margin: 16px 0 24px;
}

.box p.note {
  font-size: 13px;
  color: #9e7a8e;
  margin-bottom: 28px;
  line-height: 1.6;
}

button {
  width: 100%;
  padding: 14px;
  background: #6b4c5e;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 12px;
  font-size: 16px;
  transition: 0.3s;
}

button:hover {
  background: #b48fa8;
}
</style>
</head>

<body>

<!-- Bubbles -->
<div class="bubble b1"></div>
<div class="bubble b2"></div>
<div class="bubble b3"></div>
<div class="bubble b4"></div>

<div class="box">
  <div class="icon">💳</div>
  <h2>Complete Payment</h2>
  <div class="amount">₹5,000</div>
  <p class="note">Your room is reserved. Complete the payment below to confirm your booking.</p>

  <form method="POST" action="payment_success.php">
    <button type="submit">Confirm Payment →</button>
  </form>
</div>

</body>
</html>