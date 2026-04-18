<?php
session_start();
include("db_connect.php");

$_SESSION['parent'] = $_POST;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Roomify – Select Room</title>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

html, body {
  background: #f6e8f0;
  background-image:
      radial-gradient(circle at 15% 15%, rgba(212, 83, 126, 0.35) 0%, transparent 40%),
      radial-gradient(circle at 85% 80%, rgba(179, 120, 200, 0.38) 0%, transparent 40%),
      radial-gradient(circle at 60% 10%, rgba(240, 180, 220, 0.4) 0%, transparent 35%),
      radial-gradient(circle at 30% 80%, rgba(200, 150, 210, 0.35) 0%, transparent 35%);
  color: #2e1f29;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  min-height: 100vh;
}

@font-face {
  font-family: "fonts";
  src: url("fonts/Hello.otf");
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

/* HEADER */
header {
  position: fixed;
  top: 0;
  width: 100%;
  height: 90px;
  background: rgba(255,255,255,0.85);
  backdrop-filter: blur(8px);
  box-shadow: 0 4px 25px rgba(0,0,0,0.08);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 70px;
  z-index: 1000;
}

.logo h1 {
  font-family: "fonts";
  font-size: 42px;
  color: #6b4c5e;
  margin-bottom: -6px;
}

.logo p {
  font-size: 14px;
  color: #8b6a7d;
  letter-spacing: 1px;
}

.nav-title {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}

.nav-title h1 {
  font-family: "fonts";
  font-size: 40px;
  color: #6b4c5e;
  font-weight: 200;
}

/* PAGE */
main {
  margin-top: 90px;
  padding: 70px 30px 60px;
  position: relative;
  z-index: 1;
}

.details {
  font-family: "fonts";
  font-size: 30px;
  color: #6b4c5e;
  text-align: center;
  margin-bottom: 30px;
  font-weight: 300;
}

/* ROOM GRID */
.room-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 18px;
  max-width: 900px;
  margin: auto;
}

/* ROOM CARD */
.room-card {
  padding: 20px 18px;
  border-radius: 16px;
  text-align: center;
  cursor: pointer;
  transition: 0.25s;
  position: relative;
  background: #fff;
  box-shadow: 0 4px 16px rgba(160, 90, 140, 0.08);
}

/* AVAILABLE */
.room-card.available {
  border: 1.5px solid #a8d5b5;
}

.room-card.available:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 28px rgba(107, 76, 94, 0.13);
  border-color: #6b4c5e;
}

/* FULL */
.room-card.full {
  border: 1.5px solid #e8b4b4;
  cursor: not-allowed;
  opacity: 0.7;
}

/* SELECTED */
.room-card.selected {
  border: 2px solid #6b4c5e;
  box-shadow: 0 0 0 3px rgba(107, 76, 94, 0.12);
}

/* CARD TEXT */
.room-card h4 {
  font-size: 16px;
  font-weight: 600;
  color: #4a3743;
  margin-bottom: 6px;
}

.room-card p {
  font-size: 13px;
  color: #7a5f6e;
  margin-bottom: 12px;
}

/* BADGES */
.badge {
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  display: inline-block;
}

.available .badge {
  background: #eaf6ee;
  color: #2e7d52;
}

.full .badge {
  background: #fdecea;
  color: #c0392b;
}

/* ROOM ICON */
.room-icon {
  font-size: 28px;
  margin-bottom: 8px;
}

/* SUBMIT BUTTON */
.submit-btn {
  display: block;
  margin: 40px auto 0;
  padding: 14px 38px;
  background: #6b4c5e;
  color: white;
  border: none;
  border-radius: 14px;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
}

.submit-btn:hover {
  background: #b48fa8;
  transform: translateY(-2px);
}

@media (max-width: 768px) {
  header { padding: 0 25px; flex-direction: column; height: auto; }
  .details { font-size: 24px; }
}
</style>
</head>

<body>

<!-- Bubbles -->
<div class="bubble b1"></div>
<div class="bubble b2"></div>
<div class="bubble b3"></div>
<div class="bubble b4"></div>

<header>
  <div class="logo">
    <h1>Roomify</h1>
    <p>Girls Hostel</p>
  </div>
  <div class="nav-title"><h1>Select Room</h1></div>
</header>

<main>

<div class="details">Choose Your Room</div>

<form method="POST" action="form.php">
<input type="hidden" name="room_id" id="room_id">

<div class="room-grid">
<?php
$sql = "SELECT r.room_id, r.room_number, r.capacity,
               COUNT(b.booking_id) AS booked
        FROM rooms r
        LEFT JOIN bookings b ON r.room_id = b.room_id
        GROUP BY r.room_id, r.room_number, r.capacity";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
  $available = $row['capacity'] - $row['booked'];

  if($available > 0){
    echo "
    <div class='room-card available' data-id='{$row['room_id']}'>
      <div class='room-icon'>🛏</div>
      <h4>Room {$row['room_number']}</h4>
      <p>{$available} bed(s) free</p>
      <span class='badge'>Available</span>
    </div>";
  } else {
    echo "
    <div class='room-card full'>
      <div class='room-icon'>🔒</div>
      <h4>Room {$row['room_number']}</h4>
      <p>No beds left</p>
      <span class='badge'>Full</span>
    </div>";
  }
}
?>
</div>

<button class="submit-btn">Confirm Booking →</button>

</form>
</main>

<script>
const rooms = document.querySelectorAll(".room-card.available");
const hiddenInput = document.getElementById("room_id");

rooms.forEach(room => {
  room.addEventListener("click", () => {
    rooms.forEach(r => r.classList.remove("selected"));
    room.classList.add("selected");
    hiddenInput.value = room.dataset.id;
  });
});
</script>

</body>
</html>