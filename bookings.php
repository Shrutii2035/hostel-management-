<?php
include("db_connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];  // or get from session
    $room_id = $_POST['room_id'];

    // 1. Check current bookings for this room
    $check_sql = "SELECT COUNT(*) as booked, r.capacity 
                  FROM bookings b 
                  JOIN rooms r ON b.room_id = r.room_id 
                  WHERE b.room_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $booked = $result['booked'] ?? 0;
    $capacity = $result['capacity'] ?? 0;

    if ($booked >= $capacity) {
        // ❌ No space left
        echo "<script>alert('This room is already full! Choose another room.');
        window.location.href='form.php';</script>";
        exit;
    }

    // 2. Insert booking
    $insert_sql = "INSERT INTO bookings (username, room_id) VALUES (?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("si", $username, $room_id);

    if ($insert_stmt->execute()) {
        echo "<script>alert('Room booked successfully!');
        window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
