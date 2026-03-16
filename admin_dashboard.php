<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

/* ===== FETCH BOOKINGS WITH USER DATA ===== */
$sql = "
SELECT 
    b.booking_id,
    b.booking_date,
    b.room_id,

    pd.name,
    pd.age,
    pd.contact,
    pd.email

FROM bookings b
JOIN personal_details pd ON b.personal_id = pd.personal_id
ORDER BY b.booking_date DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Roomify – Admin Dashboard</title>

<style>
/* ===== RESET ===== */
*{margin:0;padding:0;box-sizing:border-box;}

html,body{
  background:#f6f1f5;
  font-family:Arial, sans-serif;
  color:#2e1f29;
}

/* ===== FONT ===== */
@font-face{
  font-family:"fonts";
  src:url("fonts/Hello.otf");
}

/* ===== HEADER ===== */
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
}

.logo p{
  font-size:14px;
  color:#8b6a7d;
  margin-top:-6px;
}

.nav-title h1{
  font-family:"fonts";
  font-size:30px;
  font-weight: 400;
  color:#6b4c5e;
}

/* ===== MAIN ===== */
main{
  margin-top:120px;
  padding:30px;
}

/* ===== TITLE ===== */
.dashboard-title{
  text-align:center;
  margin-bottom:30px;
}

.dashboard-title h2{
  font-family:"fonts";
  font-size:36px;
  font-weight: 200;
  color:#6b4c5e;
}

/* ===== TABLE ===== */
.table-wrapper{overflow-x:auto;}

table{
  width:100%;
  border-collapse:collapse;
  background:white;
  border-radius:16px;
  overflow:hidden;
  box-shadow:0 15px 40px rgba(0,0,0,0.1);
}

th,td{
  padding:14px;
  text-align:center;
  font-size:14px;
}

th{
  background:#6b4c5e;
  color:white;
}

tr:nth-child(even){
  background:#f6f1f5;
}

/* ===== ACTIONS ===== */
.delete-btn{
  color:#c62828;
  text-decoration:none;
}

.delete-btn:hover{text-decoration:underline;}

.actions{
  text-align:center;
  margin-top:30px;
}

.actions a{
  background:#6b4c5e;
  color:white;
  padding:10px 22px;
  border-radius:10px;
  text-decoration:none;
}

.actions a:hover{background:#b48fa8;}
</style>
</head>

<body>

<header>
  <div class="logo">
    <h1>Roomify</h1>
    <p>Girls Hostel</p>
  </div>
  <div class="nav-title">
    <h1>Admin Dashboard</h1>
  </div>
</header>

<main>

<div class="dashboard-title">
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?></h2>
  <p>Manage hostel bookings below</p>
</div>

<div class="table-wrapper">
<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Age</th>
  <th>Contact</th>
  <th>Email</th>
  <th>Room ID</th>
  <th>Booking Date</th>
  <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
  <td><?= $row['booking_id'] ?></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= $row['age'] ?></td>
  <td><?= htmlspecialchars($row['contact']) ?></td>
  <td><?= htmlspecialchars($row['email']) ?></td>
  <td><?= $row['room_id'] ?></td>
  <td><?= $row['booking_date'] ?></td>
  <td>
    <a class="edit-btn"
       href="edit_booking.php?booking_id=<?= $row['booking_id'] ?>">
       Edit
    </a>
   

  </td>
</tr>
<?php } ?>
</table>
</div>

<div class="actions">
  <a href="logout.php">Logout</a>
</div>

</main>

</body>
</html>
