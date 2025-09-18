<!DOCTYPE html>
<html>
<head>
    <title>Travel Agency - Country Info</title>
<style>
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
		background-color: lightsteelblue;
		font-family: Arial, sans-serif;
	}
    button{
		background-color: #04AA6D;
		border: none;
		color: white;
		padding: 16px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		transition-duration: 0.4s;
		cursor: pointer;
	}
	.button1:hover{
		background-color: white;
		color: black;
		border: 2px solid #04AA6D;
	}
	p{
		color: navy;
		text-align: center;
		text-indent: 30px;
		font-size: 20px;
		font-family: Arial,sans-serif;
	}
    div{
        font-size: 25px;
        font-weight: bold;
        color: maroon;
        border: 5px;
    }
    select {
    width: 10rem;
    background-color: #c3f0c6;
    border: #b2eeac 2px solid;
    }

    select>option {
    background-color: #b8e1ba;
    }
</style>

</head>
<body>

    <form id="countryForm">

        <div>
            <!-- Create a drop-down meny with 4 cities -->
            <label for="cities">Choose a city:</label> <br>
            <select id="cities" name="cities"> 
                <!-- the <option> has the country name as its value Tokyo for Japan - France for Paris -->
                <option value="Japan">Tokyo</option>
                <option value="UK">London</option>
                <option value="France">Paris</option>
                <option value="Spain">Spain</option>
            </select>
        </div>

        <br>
        <button type="submit">Submit</button>

    </form>

    <!-- show result as the div is empy at the beginning -->
    <div id="result"></div>

    <!-- Java Script function for request data from the API -->
    <script>
        // take the module in this case is document.getElementByID(Id is " countryForm")
        // intercept when the user press "submit" - addEventListener("submit", function(event))
        // event.preventDefault() prevent the page from reloading
        document.getElementById("countryForm").addEventListener("submit", function(event) {
            event.preventDefault(); 
            
            // let - take the value of the selected cities 
            let selectedCountry = document.getElementById("cities").value;

            // Use fetch() to send a request to the PHP page in this case is "fetchCountryInfo.php"
            //encodeURIComponent(selectedCountry) ensure the name are correctly read withoUt space
            // EXAMPLE: if the user chose "France", the request is : fetchCountryInfo.php?country=France
            fetch("fetchCountryInfo.php?country=" + encodeURIComponent(selectedCountry))

                //Convert the response in Json
                // if the data are correct , load the page with the language, currency and time zone
                .then(response => response.json())
                .then(data => {
                    document.getElementById("result").innerHTML = `
                        <h3>Country Info</h3>
                        <p><strong>Language:</strong> ${data.language}</p>
                        <p><strong>Currency:</strong> ${data.currency}</p>
                        <p><strong>Time Zone:</strong> ${data.timezone}</p>
                        <img src="${data.flag}" alt="Flag" width="150">
                    `;
                })
                // If samethings go wronge print an error on the console.
                .catch(error => console.error("Error fetching data:", error));
        });
    </script>

</body>
</html>
