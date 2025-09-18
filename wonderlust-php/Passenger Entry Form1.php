<?php
// Connection to the Database
$conn = mysqli_connect("localhost", "root", "", "airportdb");

// Check if the connection is working
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Passenger Registration</title>
    <style>
        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: linen; /* Background color set to linen */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Styling for the main form container */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin-top: 20px;
        }

        /* Styling the header */
        h1 {
            text-align: center; /* Center-align the text */
            color: maroon; /* Header color set to maroon */
            font-size: 40px; /* Font size set to 40px */
            margin-bottom: 20px;
        }

        /* Input fields and select dropdown styling */
        input[type="text"], select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        /* Styling for the submit button */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: maroon; /* Submit button color set to maroon */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: darkred; /* Darker maroon color on hover */
        }

        /* Label styling */
        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        /* Styling for the error or success messages */
        .message {
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-top: 15px;
            font-size: 16px;
            border-radius: 5px;
        }

        .success {
            background-color: #4CAF50; /* Success message color */
        }

        .error {
            background-color: #f44336; /* Error message color */
        }

        /* Styling for readonly date field */
        input[readonly] {
            background-color: #e9e9e9;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Passenger Entry Form</h1>

    <!-- Form to collect passenger information -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="passport_number">Passport Number:</label>
            <input type="text" name="passport_number" id="passport_number" required>
        </div>

        <div class="form-group">
            <label for="flight_id">Flight Selection:</label>
            <select name="flight_id" id="flight_id" required>
                <option value="">Select Flight</option>
                <?php
                // Query to fetch available flights from the database
                $sql = "SELECT FlightID, FlightNumber, Destination FROM Flight";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Loop through the flights and display them as options in the dropdown
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['FlightID'] . "'>" . $row['FlightNumber'] . " - " . $row['Destination'] . "</option>";
                    }
                } else {
                    // if no flights are available, display a message in the dropdown
                    echo "<option>No flights available</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="booking_date">Booking Date:</label>
            <input type="text" name="booking_date" id="booking_date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
        </div>

        <div class="form-group">
            <input type="submit" value="Submit">
        </div>
    </form>

    <?php
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect data from the form
        $name = $_POST['name'];
        $passport_number = $_POST['passport_number'];
        $flight_id = $_POST['flight_id'];
        $booking_date = date('Y-m-d H:i:s'); 

        // Insert the passenger into the passengers table
        $sql_passenger = "INSERT INTO Passengers (Name, PassportNumber) 
                          VALUES ('$name', '$passport_number')";

        // Execute the query to insert the passenger
        if (mysqli_query($conn, $sql_passenger)) {
            echo "<div class='message success'>Passenger added successfully!</div>";

            // Get the ID of the newly inserted passenger
            $passenger_id = mysqli_insert_id($conn);  

            // Now insert the booking information into the booking table
            $sql_booking = "INSERT INTO Bookings (PassengerID, FlightID, BookingDate) 
                            VALUES ('$passenger_id', '$flight_id', '$booking_date')";

            // Execute the query to insert the booking
            if (mysqli_query($conn, $sql_booking)) {
                echo "<div class='message success'>Booking successfully created!</div>";
            } else {
                // If there is an error inserting the booking
                echo "<div class='message error'>Error: " . mysqli_error($conn) . "</div>";
            }
        } else {
            // If there is an error inserting the passenger
            echo "<div class='message error'>Error inserting passenger: " . mysqli_error($conn) . "</div>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
