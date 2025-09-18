<!DOCTYPE html>
<html>
<body>
<?php 
// client id  

//client secret

//scope
//https://www.googleapis.com/auth/blogger
//api key
//AIzaSyB8VRT7ullROJL4AW_qKMtwFMqFQTILDmU
?>
<button onclick="login();"> login </button>
<script>
   function login(){
        var clientId = "1076802734172-mrhp4lj71jvf735dgk5trank3c273mg1.apps.googleusercontent.com";
        var secret = "";
        var scope = "https://www.googleapis.com/auth/blogger";
 

        location.replace("https://accounts.google.com/o/oauth2/v2/auth?client_id="+clientId+"&redirect_uri=http://localhost/blog1.php&response_type=code&scope="+scope);            
   }

</script>

</body>

</html>

