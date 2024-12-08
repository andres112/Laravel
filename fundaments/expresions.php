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

// Get the current day
$oddDay = date('d') % 2 == 1;
if ($oddDay) {
    echo "Today is an odd day\n";
} else {
    echo "Today is an even day\n";
}

echo "************************************\n";
echo "LOOP WHILE - DO...WHILE\n";

$secret= "magic";
$attempts = 0;
$maxAttempts = 3;

while ($attempts < $maxAttempts) {
    $attempts++;
    echo "Attempt $attempts: ";
    $guess = readline();
    if ($guess == $secret) {
        echo "Congratulations! You found the secret word 🪙\n";
        break;
    } elseif ($attempts == $maxAttempts) {
        echo "Sorry, you have reached the maximum number of attempts 🔒\n";
    } else {
        echo "Try again\n";
    }
}