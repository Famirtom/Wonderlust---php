<!DOCTYPE html>
<html>
<head>
	<Title> Faerûn Ariport  </Title>
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
		background-color: lightsteelblue;
		font-family: Arial, sans-serif;
	}
	h1{
		color: maroon;
		margin: 40px 0;
	}	
	p{

		font-size: 20px;
	}
	a{
		color: maroon;
		text-decoration: none;
		font-size: 40px;
		transition-duration: 0.4s;
	}
	a:hover{
		color: white;
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
   </Style>
</head>
<body>


<header></header>

		<div style="display: flex; align-items: center; justify-content: center;">
			<img src="faerunlogo.png" alt="Faerûn" title="Faerûn" width="100" height="50">
			<h1> Faerûn International Airport Database </h1>
		</div>
	<br>
		<div>
		<p><a href="Passenger and Flight Report.php"> Passenger and Flight Report </a></p>
		<p><a href="Passenger Entry Form.php"> Passenger Entry Form </a></p>
		<br>
			<p>Feedback Link for Our Blogger Page, feel free to write about your experience</p>
		<br>
		<button class="button button1" onclick="login();" > Write your feedback </button>

		<a id="countries" title="Countries Information" href="countries.php"> Cities</a>
		</div>


<script>




   function login(){
        var clientId = "1076802734172-mrhp4lj71jvf735dgk5trank3c273mg1.apps.googleusercontent.com";
        var secret = "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";
        var scope = "https://www.googleapis.com/auth/blogger";
        location.replace("https://accounts.google.com/o/oauth2/v2/auth?client_id="+clientId+"&redirect_uri=http://localhost/blog1.php&response_type=code&scope="+scope);            
   }

</script>




</body>
</html>