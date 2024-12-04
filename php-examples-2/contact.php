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
if (isset($_POST['fname'])) {
  $firstName = $_POST['fname'];
}
if (isset($_POST['lname'])) {
  $lastName = $_POST['lname'];
}
if (isset($_POST['contactMessage'])) {
  $message = $_POST['contactMessage'];
}

// Prepare an insert query using placeholders
$sql = "INSERT INTO contactmessage (first_name, last_name, message_sent) VALUES (?, ?, ?)";

// Prepare the statement
if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sss", $firstName, $lastName, $message);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Records added successfully.";
    } else {
        echo "ERROR: Could not execute the query. " . mysqli_error($link);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "ERROR: Could not prepare the query. " . mysqli_error($link);
}

// Close the connection
mysqli_close($link);
?>


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
    <h1>Contact us</h1>

    <!-- /contact.php?a=abebe&b=challa -->
    <form action="contact.php" method="post">
      <label for="fname">First name:</label>
      <input type="text" id="fname" name="fname" /><br /><br />
      <label for="lname">Last name:</label>
      <input type="text" id="lname" name="lname" /><br /><br />
      <label for="message">Message:</label><br />
      <textarea
        id="contactMessage"
        name="contactMessage"
        rows="4"
        cols="50"
        placeholder="Please write your message here"></textarea><br /><br />
      <input type="submit" value="Submit" />
    </form>

    <a href="message.php">goto message</a>
</body>

</html>