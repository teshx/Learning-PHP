<?php

// //$_POST 
// print "<pre>";
// print_r($_POST);  

//$_GET 
// print "<pre>";
// print_r($_GET); 

// //$_REQUEST 
// print "<pre>";
// print_r($_REQUEST);

// // // Add cookie 
// $cookie_name = "test_cookie";
// $cookie_value = "visited contact page";
// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

// // $_COOKIE
// print "<pre>";
// print_r($_COOKIE);

// // //$_SESSION 
// session_start();
// print "<pre>";
// print_r($_SESSION);

// // Saving the form submitted on the contact page 
// print "<pre>";
// print_r($_POST);  
// // Write your conditions in here to check if data is available 
// $firstName = "";
// $lastName = ""; 
// $message = "";
// // Capture the submitted values 
// if(isset($_POST['fname'])){
//   $firstName = $_POST['fname']; 
// }
// if(isset($_POST['lname'])){
//   $lastName = $_POST['lname']; 
// }
// if(isset($_POST['contactMessage'])){
//   $message = $_POST['contactMessage']; 
// }   
// // Open the file you want to write your data on and write it 
// $handle = fopen('AbebeBesoBela.txt', 'a');
// //opens file in append mode 
// if(!empty($firstName)){
//   fwrite($handle, $firstName."\n");  
// }
// if(!empty($lastName)){
//   fwrite($handle, $lastName."\n");  
// }
// if(!empty($message)){
//   fwrite($handle, $message."\n");  
// }
// fclose($handle);  
// echo "Message saved successfully";


// Insert data to the database 
require "connect.php"; 
$firstName = "";
$lastName = ""; 
$message = "";
// Capture the submitted values 
if(isset($_POST['fname'])){
  $firstName = $_POST['fname']; 
}
if(isset($_POST['lname'])){
  $lastName = $_POST['lname']; 
}
if(isset($_POST['contactMessage'])){
  $message = $_POST['contactMessage']; 
}  
// Attempt insert query execution
$sql = "INSERT INTO contactmessage (first_name, last_name, message_sent) VALUES ('$firstName', '$lastName', '$message')";

if(mysqli_query($link, $sql)){
  echo "Records added successfully.";
  mysqli_close($link);
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thank you page</title>
</head>

<body>
  <header>
    <h1>Thank you for your message!</h1>

  </header>
  <section>We will get back to you soon.</section>
</body>

</html>