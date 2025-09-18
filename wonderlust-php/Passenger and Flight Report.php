<!DOCTYPE html>
<html>
<head> <Title> Passenger and Flight Report  </Title>
<Style>
	header{
		background-image: url('aeroporto.png');
		background-size: cover;
		border: 2px solid Blue;
		background-repeat: no-repeat;
		padding: 150px;
		width: 100%;		
	}
	body{
		text-align: center;
		font-size: 20px;
		background-color: linen;
		font-family: arial, sans-serif;
	}
	table{
		width:80%;
		margin: 0 auto;
	}
	th, td{
		border: 2px solid black;
		padding: 10px;
		text-align: center;
	}
	h1{
		color: maroon;	
	}
   </Style>
</head>
<body>
	<div style="display: flex; align-items: center; justify-content: center;">
	<img src="faerunlogo.png" alt="Faerûn" title="Faerûn" width="100" height="50">
	<h1> Passenger and Flight Report </h1>
</div>

    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "airportdb");

    // verify the connectivity
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    // Query
    $sql = "SELECT p.PassengerID, p.Name, p.PassportNumber, f.FlightNumber, f.Destination, f.DepartureDateTime 
            FROM Passengers p 
            JOIN Bookings b ON p.PassengerID = b.PassengerID 
            JOIN Flight f ON b.FlightID = f.FlightID";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Print
        echo "<table>
                <tr>
                    <th>Passenger ID</th>
                    <th>Name</th>
                    <th>Passport Number</th>
                    <th>Flight Number</th>
                    <th>Destination</th>
                    <th>Departure Date & Time</th>
                </tr>";

        // Print information of each passengers
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . ($row['PassengerID']) . "</td>
                    <td>" . ($row['Name']) . "</td>
                    <td>" . ($row['PassportNumber']) . "</td>
                    <td>" . ($row['FlightNumber']) . "</td>
                    <td>" . ($row['Destination']) . "</td>
                    <td>" . ($row['DepartureDateTime']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No passengers found!";
    }
    // Close connection
    mysqli_close($conn);
    ?>

</body>
</html>
