<?php
// Connection to the database using user Tom
$servername = "localhost";
$username = ""; // User with limited privileges
$password = "p"; // Replace with the actual password
$database = "airportdb"; // Database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully as user .<br>";

// Attempt to alter a table structure
$sql = "ALTER TABLE Passengers ADD COLUMN TestColumn VARCHAR(50)";

if (mysqli_query($conn, $sql)) {
    echo "Table altered successfully.";
} else {
    // This should execute because the user does not have ALTER privileges
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

