<?php
session_start();
 
   $title = $_POST["title"];
   $content = $_POST["content"];
   $token = $_SESSION['token'] ;
 
 
$post_string2 = "{'kind': 'blogger#post',  
                   'blog': {  'id': '844946807545966636'  },  
  		   			'title': '$title',  
		   			'content': '$content'}
		";
 
$ch2 = curl_init();
 
curl_setopt($ch2, CURLOPT_URL, 'https://www.googleapis.com/blogger/v3/blogs/844946807545966636/posts');
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_string2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
 
curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	"Authorization: Bearer $token"                  
));
 
$json_response2 = curl_exec($ch2);
$errors2 = curl_error($ch2);
curl_close($ch2);
 
//print_r($json_response2);
 
$response_data = json_decode($json_response2, true);

if(isset($response_data['error'])){
	echo json_encode(["error" => "Invalid client Id or authorization filed"]);
} else {
	echo("completed");
}

 
?>