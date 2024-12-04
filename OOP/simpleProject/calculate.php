<?php
require 'clases.php';



$operater = $_POST["oper"];
$first = $_POST["First"];
$second = $_POST["Second"];



$object = new calaculate($operater, (int)$first, (int)$second);
$value = $object->calculation();
echo $value;
