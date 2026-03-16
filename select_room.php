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
/* ========= RESET ========= */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

html,body{
  background:#f6f1f5;
  color:#2e1f29;
  font-family:"Segoe UI",Tahoma,Geneva,Verdana,sans-serif;
}

/* ========= FONT ========= */
@font-face{
  font-family:"fonts";
  src:url("fonts/Hello.otf");
}

/* ========= HEADER ========= */
header{
  position:fixed;
  top:0;
  width:100%;
  height:90px;
  background:rgba(255,255,255,0.85);
  backdrop-filter:blur(8px);
  box-shadow:0 4px 25px rgba(0,0,0,0.08);
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:0 70px;
  z-index:1000;
}

.logo h1{
  font-family:"fonts";
  font-size:42px;
  color:#6b4c5e;
  margin-bottom:-6px;
}

.logo p{
  font-size:14px;
  color:#8b6a7d;
  letter-spacing:1px;
}

.nav-title h1{
  font-family:"fonts";
  font-size:40px;
  color:#6b4c5e;
  font-weight: 200;
}
.nav-title{
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}

/* ========= PAGE ========= */
main{
  margin-top:90px;
  padding:90px 30px;
}

.details{
  font-family:"fonts";
  font-size:36px;
  color:#6b4c5e;
  text-align:center;
  margin-bottom:40px;
}

/* ========= ROOM GRID ========= */
.room-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
  gap:30px;
  max-width:1000px;
  margin:auto;
}

/* ========= ROOM CARD ========= */
.room-card{
  padding:28px;
  border-radius:22px;
  box-shadow:0 14px 35px rgba(0,0,0,0.08);
  text-align:center;
  cursor:pointer;
  transition:0.3s;
  position:relative;
}

/* AVAILABLE (GREEN) */
.room-card.available{
  background:#e9f7ef;
  border:2px solid #2ecc71;
}

.room-card.available:hover{
  transform:translateY(-6px);
  box-shadow:0 22px 50px rgba(46,204,113,0.3);
}

/* FULL (RED) */
.room-card.full{
  background:#fdecea;
  border:2px solid #e74c3c;
  cursor:not-allowed;
  opacity:0.85;
}

/* SELECTED */
.room-card.selected{
  border:3px solid #6b4c5e;
  box-shadow:0 0 0 4px rgba(107,76,94,0.15);
}

/* ========= CARD TEXT ========= */
.room-card h4{
  font-size:22px;
  margin-bottom:10px;
}

.room-card p{
  font-size:16px;
  margin-bottom:15px;
}

/* ========= BADGES ========= */
.badge{
  padding:6px 16px;
  border-radius:20px;
  font-size:14px;
  font-weight:600;
  display:inline-block;
}

.available .badge{
  background:#2ecc71;
  color:white;
}

.full .badge{
  background:#e74c3c;
  color:white;
}

/* ========= BUTTON ========= */
.submit-btn{
  display:block;
  margin:50px auto 0;
  padding:16px 40px;
  background:#6b4c5e;
  color:white;
  border:none;
  border-radius:18px;
  font-size:18px;
  cursor:pointer;
  transition:0.3s;
}

.submit-btn:hover{
  background:#5a3f4f;
  transform:translateY(-2px);
}

/* ========= RESPONSIVE ========= */
@media(max-width:768px){
  header{
    padding:0 25px;
    flex-direction:column;
    height:auto;
  }
  .details{
    font-size:28px;
  }
}
</style>
</head>

<body>

<header>
  <div class="logo">
    <h1>Roomify</h1>
    <p>Girls Hostel</p>
  </div>
  <div class="nav-title"><h1>Select Room</h1></div>
</header>

<main>

<div class="details">Select Available Room</div>

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
      <h4>Room {$row['room_number']}</h4>
      <p>🛏 Beds Available: {$available}</p>
      <span class='badge'>Available</span>
    </div>";
  } else {
    echo "
    <div class='room-card full'>
      <h4>Room {$row['room_number']}</h4>
      <p>No Beds Available</p>
      <span class='badge'>Full</span>
    </div>";
  }
}
?>
</div>

<button class="submit-btn">Confirm Booking</button>

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
