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
		body {
   			font-family: Arial, sans-serif;
   			background-color: linen; /* Background color set to linen */
   			margin: 0;
    			padding: 0;
   			display: flex;
   			justify-content: top; 
    			align-items: center; 
    			height: 100vh; 
    			flex-direction: column; 		}

		/* Styling for the main form */
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
    			font-size: 40px;
    			margin-bottom: 20px;
		}
		input[type="text"], select {
            		width: 100%;
           		padding: 12px;
            		margin: 8px 0;
           		border: 1px solid #ccc;
            		border-radius: 4px;
           		box-sizing: border-box;
            		font-size: 16px;
        }
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
            		background-color: blue; /* Blue color on hover */
        }

	</style>
</head>
<body>
    <h1>Passenger Entry Form</h1>

    <!-- Form to collect passenger infomation -->
    <form method="POST" action="">
        Name: <input type="text" name="name" required><br>
        Passport Number: <input type="text" name="passport_number" required><br>

        <!-- Flight selection dropdown -->
        Flight Selection:
        <select name="flight_id" required>
            <option value="">Select Flight</option>
            <?php

            // Query to fetch available flights from the database

            $sql = "SELECT FlightID, FlightNumber, Destination FROM Flight";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
		// Loop trough the flights and display them as options in the dropdown
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['FlightID'] . "'>" . $row['FlightNumber'] . " - " . $row['Destination'] . "</option>";
                }
            } else {
		// if no flights are available, display a message in the dropdown
                echo "<option>No flights available</option>";
            }
            ?>
        </select><br>

        <!-- Current date and time as booking date (readonly)-->
        Booking Date: <input type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    // check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect data form the form
        $name = $_POST['name'];
        $passport_number = $_POST['passport_number'];
        $flight_id = $_POST['flight_id'];
        $booking_date = date('Y-m-d H:i:s'); 

        // Insert the passenger into the passengers table
        $sql_passenger = "INSERT INTO Passengers (Name, PassportNumber) 
                          VALUES ('$name', '$passport_number')";

        // Execute the query to insert the passenger
        if (mysqli_query($conn, $sql_passenger)) {
            echo "Passenger added successfully! ";

            // get the id of the newly passenger and get the auto-incremented passenger ID
            $passenger_id = mysqli_insert_id($conn);  

            // Now insert the booking infomration intto the booking table
            $sql_booking = "INSERT INTO Bookings (PassengerID, FlightID, BookingDate) 
                            VALUES ('$passenger_id', '$flight_id', '$booking_date')";

            // Execute the query to insert the passenger
            if (mysqli_query($conn, $sql_booking)) {
                echo " Booking successfully created!";
            } else {
	    // is there is an error inserting the booking
                echo "Error: " . mysqli_error($conn);
            }
        } else {
	// if there is an error inserting the passenger
            echo "Error inserting passenger: " . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
    ?>
</body>
</html>
