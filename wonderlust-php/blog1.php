<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head> 
   <style>
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
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin-top: 20px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border:  1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"]{
            width: 100%;
            padding: 12px;
            background-color: bisque;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        input[type="submit"]:hover{
            background-color: darkred;
            color: white;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        span{
            color: darkred;
            padding: 10px;
            text-align: center;
            margin-top: 15px;
            font-size: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
       
   </style>
<script src="jquery.js"></script>
</head>
<body>
<?php
 
$code = $_GET['code'];
//echo($code);
 
$post_array = array(
	'client_id' => '1076802734172-mrhp4lj71jvf735dgk5trank3c273mg1.apps.googleusercontent.com',
	'client_secret' => '',
	'code' => $code,
	'grant_type' => 'authorization_code',
	'redirect_uri' => 'http://localhost/blog1.php'
);
 
 
//print_r($postRequest);
 
$post_string = http_build_query($post_array);
 
//echo($post_string);
 
$ch = curl_init();
 
   curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/x-www-form-urlencoded'
));
 
$json_response = curl_exec($ch);
$errors = curl_error($ch);
curl_close($ch);
 
//echo($errors);
 
//print_r($json_response);
//echo("<br><br>");
$obj = json_decode($json_response);
//echo($obj->access_token);
$_SESSION['token'] = $obj->access_token;
 
 
?> 
<form>
      <div>
         <label for="title"> Review Title </label> <br>
         <input type="text" id="title" placeholder="Insert the title" required>
      </div>

      <br>

      <div>
         <label for="content"> Review Content </label> <br>
         <input type="text" id="content" required>
      </div>
      
      <br>

         <input type="submit" onclick="submitPost(); return false;">
         <span id="message"> </span>

</form>
 
<script>
 
    function submitPost(){

            let title = $("#title").val().trim();
            let content = $("#content").val().trim();

                if(title == "" || content == ""){
                    $("#message").html("Error: Title and content cannot be empty!").show();
                    return;
                }
 
       $.ajax({
          url: "blogsubmit.php ",
          method: "POST",     
          data: {
             title: $("#title").val(),
             content: $("#content").val()
          },
          success: function(response) {
               if(response == "completed"){
                    $("#title").val("");
                    $("#content").val("");
                     $("#message").html("Thanks for Flying with us");
                     $("#message").delay(2000).fadeOut(500);
               }
          },
          error: function(error) {
            $("#message").html("Error submitting post. Try again.").show();
              //alert("error" + error);
          }
      });          
 
    }
 
</script>
</body>

</html>
