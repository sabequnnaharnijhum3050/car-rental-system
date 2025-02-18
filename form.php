<?php
include 'db.php';

if (!isset($_GET['car_id']) || empty($_GET['car_id'])) {
    die("Invalid request. Car ID is missing.");
}

$car_id = intval($_GET['car_id']); // Ensure car_id is an integer
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Booking</title>
</head>
<body>
    <h2>Enter Your Details</h2>
    <form action="book.php" method="POST">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br>
        <button type="submit">Book Now</button>
    </form>
</body>
</html>
