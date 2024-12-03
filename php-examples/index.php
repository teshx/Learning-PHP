<?php
// Display out put 
echo "Hello World";

// Declaring Variables & Assignment operator 
$a = "";
$a = "Abebe";
echo $a;
echo '<br>';
// Arithmetic operators
$a;
$b;
$c;
$d;
$e;
$a = 2;
$b = 3;
$c = $a + $b;
$d = $a * $b;
$e = ($a + $b) * ($c / $d);
echo $e;
echo '<br>';
// String Operator (Concatenation)
$firstName = "Abebe";
$lastName = "Kebede";
$fullName = $firstName . " " . $lastName;
echo $fullName;
echo '<br>';
// Comparison operator 
$a = 5;
$b = 7;
echo ($a <= $b);
echo '<br>';
// Logical operators 
echo (1 == 1 || 2 == 2 || 3 == 7);
echo '<br>';
// Array 
// Declaring empty array
$exampleArray = array();
echo '<br>';
// Adding values to array 
$exampleArray = array(3, "Abebe", 5, 8, 99, true, "Kebede");
print "<pre>";
print_r($exampleArray);

// Accessing Array values 
$exampleArray = array(3, "Abebe", 5, 8, 99, true, "Kebede");
echo $exampleArray[1];

// array_push() function 
$exampleArray = array(3, "Abebe", 5, 8, 99, true, "Kebede");
array_push($exampleArray, "Almaz", "Challa");
print "<pre>";
print_r($exampleArray);

// Count function 
$exampleArray = array(3, "Abebe", 5, 8, 99, true, "Kebede");
echo count($exampleArray);

