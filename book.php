<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['car_id'], $_POST['name'], $_POST['email'], $_POST['phone'])) {
        die("Error: Missing required fields.");
    }

    $car_id = intval($_POST['car_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // Fetch the current timestamp of the car
    $sql = "SELECT last_updated_timestamp FROM Cars WHERE car_id = $car_id AND availability = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $timestamp = $row['last_updated_timestamp'];

        // Attempt to book using optimistic locking
        $sql = "UPDATE Cars SET availability = 0 WHERE car_id = $car_id AND last_updated_timestamp = '$timestamp'";
        
        if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
            // Insert booking record
            $conn->query("INSERT INTO Bookings (car_id, name, email, phone) VALUES ($car_id, '$name', '$email', '$phone')");
            echo "Booking successful!";
        } else {
            echo "Sorry, this car was just booked by another user.";
        }
    } else {
        echo "Car not available.";
    }
} else {
    echo "Invalid request.";
}
?>
