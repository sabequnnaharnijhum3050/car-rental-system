<?php
include 'db.php';

if (!isset($_GET['step'])) {
    // Step 1: Welcome Page
    echo "<h2>Welcome to Our Ride</h2>";
    echo "<p>Make your journey safe and sound with us.</p>";
    echo "<a href='index.php?step=car_list'><button>Next</button></a>";
} elseif ($_GET['step'] == 'car_list') {
    // Step 2: Display Available Cars
    $sql = "SELECT * FROM Cars WHERE availability = 1";
    $result = $conn->query($sql);
    
    echo "<h2>Available Cars</h2>";
    echo "<table border='1'>
            <tr><th>Car ID</th><th>Model</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['car_id']}</td>
                <td>{$row['model']}</td>
                <td><a href='form.php?car_id={$row['car_id']}'><button>Select</button></a></td>
              </tr>";
    }
    echo "</table>";
}
?>
