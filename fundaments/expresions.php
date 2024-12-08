<?php

$name = "John";
$lastName = "Doe";

echo "Hello $name $lastName!\n";

echo "Concatenation: " . $name . " - " . $lastName . "!\n";

$pizzas = 2;
$slices = 8;
$totalSlices = $pizzas * $slices;

echo "I have $pizzas pizzas and $slices slices each, total slices: $totalSlices\n";

// Set randomly true or false
$isHungry = rand(0, 1) == 1;

echo "Are you hungry? " . ($isHungry ? "Yes" : "No") . "\n";

echo "************************************\n";
echo "DATA TYPES\n";

$isStudent = 1;
echo "var_dump(variable): \n";
var_dump($isStudent, $isStudent == true, $isStudent === true); # var_dump shows the data type of the variable
 echo "\n";
$scores = [10, '20', 5.55, (int)5.55];
var_dump($scores, $scores[0], $scores[1], $scores[2], $scores[3], $scores[0] + $scores[1]);

echo "************************************\n";
echo "CONDITION IF STATEMENT\n";
