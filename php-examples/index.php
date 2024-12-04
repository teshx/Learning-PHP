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

// Functions 
function selamta()
{
  echo "Hello Evangadi Family";
}
selamta();

// Functions with arguments
function add($a, $b)
{
  $sum = $a + $b;
  echo $sum;
}
add(44, 88);

// Functions that return a value
function adderWithReturn($a, $b)
{
  $sum = $a + $b;
  return $sum;
}

function average($x, $y)
{
  $average = adderWithReturn($x, $y) / 2;
  echo "The average of " . $x . " and " . $y . " is: " . $average;
}
average(10, 20);
echo '<br>';
// If Statement
$pass = 50;
$score = 49;
if ($score >= $pass) {
  echo ("You passed");
}
if ($score < $pass) {
  echo ("Failed");
}
echo '<br>';
// If Else 
$x = 90;
$y = 80;
$z = 70;
$score = 96;

if ($score >= $x) {
  echo ("You got A");
} else if ($score >= $y) {
  echo ("You got B");
} else if ($score >= $z) {
  echo ("You got C");
} else {
  echo ("You Failed!");
}
echo '<br>';
// for loop 
$someNumbers = [70, 89, 47, 88, 99];
print "<pre>";
print_r($someNumbers);
echo '<br>';
$lengthOfArray = count($someNumbers);
for ($i = 0; $i < $lengthOfArray; $i++) {
  echo ($someNumbers[$i] . "<br>");
}
echo '<br>';
// While Loop example
if (true) {
  echo ("Abebe <br>");
}
$f = 0;
while ($f < 3) {
  echo ("Abebe <br>");
  $f++;
}
echo '<br>';


//with one echo you can render multiple html element
$average="is teshager habtie";

echo '<div>
        <h1>Welcome to My Website</h1>
        <p>This is a paragraph.</p>
        <ul>
            <li>First item</li>
            <li>Second item</li>
            <li>Third item</li>
            <li>Third item '.$average.'</li>
        </ul>
      </div>';
