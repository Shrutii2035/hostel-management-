<?php
session_start();
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $parent_name = $_POST['parent_name'];
    $parent_contact = $_POST['parent_contact'];
    $room_id = $_POST['room_id'];

    /* ===============================
       CHECK ROOM AVAILABILITY
    =============================== */
    $check = $conn->prepare(
        "SELECT r.capacity, COUNT(b.booking_id) AS booked
         FROM rooms r
         LEFT JOIN bookings b ON r.room_id = b.room_id
         WHERE r.room_id = ?
         GROUP BY r.room_id, r.capacity"
    );
    $check->bind_param("i", $room_id);
    $check->execute();
    $result = $check->get_result();
    $row = $result->fetch_assoc();

    if (!$row || $row['booked'] >= $row['capacity']) {
        echo "<script>
                alert('Sorry, this room is already full!');
                window.location.href='bookingform.php';
              </script>";
        exit();
    }

    /* ===============================
       INSERT BOOKING (PENDING)
    =============================== */
    $stmt = $conn->prepare(
        "INSERT INTO bookings
        (name, dob, age, contact, email, parent_name, parent_contact, room_id, payment_status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'PENDING')"
    );

    $stmt->bind_param(
        "ssisssii",
        $name,
        $dob,
        $age,
        $contact,
        $email,
        $parent_name,
        $parent_contact,
        $room_id
    );

    if ($stmt->execute()) {

        $booking_id = $stmt->insert_id;

        // store booking id for payment flow
        $_SESSION['booking_id'] = $booking_id;

        // redirect to payment page
        header("Location: payment.php");
        exit();

    } else {
        echo "<script>
                alert('Error: Unable to book room.');
                window.location.href='bookingform.php';
              </script>";
        exit();
    }

    $stmt->close();
    $check->close();
}

$conn->close();
?>
