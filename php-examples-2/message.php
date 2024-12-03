<?php 

  require "connect.php";

//   // Attempt select query execution
//   $sql = "SELECT * FROM contactmessage";
//   $result = mysqli_query($link, $sql); 

//   if(!empty($result)){
//     // That means some data is returned 
//     // we can now use the mysqli_fetch_array() function to retrieve each data in the form of an array 
//     print "<pre>";

//     while ($row = mysqli_fetch_array($result)) {
//       print_r($row);
//     }
//   }

  


// ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Received messages</title>
  </head>
  <body>
    <header>
      <h1>Received messages</h1>
    </header>
    <section>
      <?php 
        // Attempt select query execution
        $sql = "SELECT * FROM contactmessage";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>First Name</th>";
                        echo "<th>Last Name</th>";
                        echo "<th>Message</th>";
                    echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['message_sent'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
      
      ?>
    </section>
  </body>
</html>
