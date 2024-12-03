<?php


$link = mysqli_connect("localhost", "phpAdmin", "phpadmin", "phpAdmin");
// Check connection
if ($link === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
  echo "Connected <br>";
}


// // Add table to save the message 
// $sql = "CREATE TABLE contactmessage(
//   id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   first_name VARCHAR(30) NOT NULL,
//   last_name VARCHAR(30) NOT NULL,
//   message_sent VARCHAR(255) NOT NULL
// )";
// if(mysqli_query($link, $sql)){
//   echo "Table created successfully.";
// } else{
//   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }

// Close connection
// mysqli_close($link);

