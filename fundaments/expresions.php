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
echo "Are you hungry? " . ($isHungry ? "Yes 👹" : "No 😊") . "\n";

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

$secret = "magic";
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

do {
    $diceRoll = rand(1, 6);
    echo "Dice roll: $diceRoll\n";
    if ($diceRoll == 6) {
        echo "Congratulations! You rolled a 6 🎲\n";
        break;
    }
} while ($diceRoll != 6);

echo "************************************\n";
echo "LOOP FOR...\n";

echo "Rocket launch in 5 seconds\n";
for ($i = 5; $i > 0; $i--) {
    echo "$i...\n";
    sleep(1);
    if ($i == 1) {
        echo "💥🚀\n";
    }
}

echo "************************************\n";
echo "LOOP FOREACH...\n";

echo "Labels and fruits: both key value\n";
$fruits = ['apple' => "🍎", 'banana' => "🍌", 'cherry' => "🍒", 'orange' => "🍊", 'kiwi' => "🥝"];
foreach ($fruits as $fruit => $emoji) {
    echo "$fruit: $emoji\n";
}

echo "Only fruits: only the value \n";
foreach ($fruits as $fruit) {
    echo "$fruit \n";
}

echo "************************************\n";
echo "SWITCH STATEMENT\n";

switch ($fruits['banana']) {
    case "🍎":
        echo "Apple\n";
        break;
    case "🍌":
        echo "Banana\n";
        break;
    case "🍒":
        echo "Cherry\n";
        break;
    default:
        echo "Maybe is another fruit\n";
}

echo "************************************\n";
echo "MATCH EXPRESSION, valid for PHP >= 8.0\n";

$status = 404;
$message = match ($status) {
    200, 300 => "OK",
    400, 404, 403 => "Not Found - Client Error",
    500, 502, 503 => "Internal Server Error - Server Error",
    default => "Unknown status code",
};
echo "Status: $status - $message\n";

echo "************************************\n";
echo "REQUIRE/INCLUDE\n";

include './require/config.php';
echo "Database data: " . DB_HOST . ":" . DB_USER . "\n";

require_once './checker.php';
require './checker.php'; // this is ignored because the file was already included

echo "************************************\n";
echo "FUNCTIONS\n";

function sayHello($name = "Guest", $emoji = "👋"): void
{
    echo "Hello $name $emoji!\n";
}

sayHello("Andres");
sayHello("John", "👨‍💻");
