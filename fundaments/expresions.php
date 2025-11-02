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
# var_dump shows the data type of the variable
var_dump($isStudent, $isStudent == true, $isStudent === true);
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
$maxAttempts = 5;

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
      if($attempts == 3){
        echo "Hint: it's something related to fantasy stories\n";
      }
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
# key => value
foreach ($fruits as $fruit => $emoji) {
    echo "$fruit: $emoji\n";
}

# when we only need the value not required the => 
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

# match expression returns a value based on the parameter
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
require './checker.php';

echo "************************************\n";
echo "FUNCTIONS\n";

function sayHello($name = "Guest", $emoji = "👋"): void
{
    echo "Hello $name $emoji!\n";
}

sayHello("Andres");
sayHello("John", "👨‍💻");

// Function with strict types
include 'strict.php';

echo "************************************\n";
echo "ANONYMOUS FUNCTIONS - CLOSURES\n";

// Anonymous function with closure, type hints, default values, and capturing external variables
$taxRate = 0.18;
$applyDiscountAndTax = function (float $amount, float $discount = 0.0) use ($taxRate): float {
  $discounted = $amount - ($amount * $discount);
  return $discounted + ($discounted * $taxRate);
};

$items = [
  ['name' => 'Book', 'price' => 100, 'discount' => 0.10],
  ['name' => 'Pen', 'price' => 10, 'discount' => 0.05],
  ['name' => 'Bag', 'price' => 250, 'discount' => 0.15],
];

foreach ($items as $item) {
  $finalPrice = $applyDiscountAndTax($item['price'], $item['discount']);
  echo "{$item['name']} final price (after discount & tax): " . number_format($finalPrice, 2) . "\n";
}
echo "The total tax rate applied is " . ($taxRate * 100) . "%\n";

$icons = ['🍎', '🍌', '🍒', '🍊', '🥝'];
// with "use" we can pass variables to the anonymous function context
$squares = function ($numbers) use ($icons) {
    // return squared - icon
    return array_map(function ($number) use ($icons) {
        return $number * $number . " " . $icons[array_rand($icons)];
    }, $numbers);
};

echo "Squares of fruits: " . implode(', ', $squares([1, 2, 3, 4, 5])) . "\n";

echo "************************************\n";
echo "REFERENCES\n";

$person = "John";
$otherPerson = &$person;
echo "👨 Person: $person, 👨 Other person: $otherPerson\n";
$person = "Jane";
echo "👩 Person: $person, 👩 Other person: $otherPerson\n";
$otherPerson = "Santa";
echo "🎅 Person: $person, 🎅 Other person: $otherPerson\n";

//DANGER: This function modifies the original value, because it is passed by reference with &
function doubleValue(int &$value): int 
{
    $value *= 2;
    return $value;
}
$originalValue = 10;
echo "Original value: $originalValue, Double value: " . doubleValue($originalValue) . "\n";
echo "Original value has been modified 😱: $originalValue\n";

echo "\n\n************************************\n";
echo "PERFORMANCE\n";
include_once 'performance.php';

echo "************************************\n";
echo "VARIABLE SCOPE\n";

$superhero = "Superman";
$antihero = "Baldy";

function showSuperhero($antihero)
{
    global $superhero; // we can access the global variable using the global keyword
    echo "Global variable using global: $superhero is Clark Kent\n";
    echo "Global variable using function parameters: $antihero is Lex Luthor\n";
}

showSuperhero($antihero);

function countVisits()
{
    static $visits = 0; // static variables keep their value between function calls
    $visits++;
    echo "Visits: $visits\n";
}
countVisits();
sleep(1);
countVisits();
countVisits();

echo "************************************\n";
echo "NULL in PHP 8.0\n";

$variable = null;
var_dump(
    null,
    null == false,
    null == 0,
    null == "",
    null == [],
    isset($variable),
    empty($variable),
    is_null($variable),
    array_filter([1, null, [], "", false, 0, "0"])
);

echo "************************************\n";
echo "NAMED ARGUMENTS in PHP 8.0\n";

function orderPizza(string $flavor, string $size, array $toppings): void
{
    echo "Ordering a $size $flavor pizza 🍕 with " . implode(', ', $toppings) . "\n";
}

// Positional arguments, the order matters
orderPizza('Pepperoni', 'Large', ['Cheese', 'Pepperoni']);
// Named arguments, the order does not matter
orderPizza(size: 'Personal', toppings: ['Cheese', 'Pineapple', 'Salami'], flavor: 'Salami');

echo "************************************\n";
echo "ARROW FUNCTIONS\n";

$numbers = [1, 2, 3, 4, 5];
$multiplier = 2;

// Arrow functions are a more concise way to write anonymous functions
$multipliedNumbers = array_map(fn($number) => $number * $multiplier, $numbers);
echo "Numbers: " . implode(', ', $numbers) . ", Multiplied by $multiplier: " . implode(', ', $multipliedNumbers) . "\n";

echo "************************************\n";
echo "HIGH ORDER FUNCTIONS\n";

// High order functions receive a function as a parameter
function apply(array $numbers, callable $operation): array
{
    return array_map($operation, $numbers);
}

$unsortedNumbers = [5, 3, 1, 4, 2, 6, -3, 0, -6];
$multiplier = 2;
$addition = 3;

$multipliedNumbers = apply($unsortedNumbers, fn($number) => $number * $multiplier);
$addedNumbers = apply($unsortedNumbers, fn($number) => $number + $addition);

echo "Numbers: " . implode(', ', $unsortedNumbers) . "\n";
echo "✴️ Multiplied by $multiplier: " . implode(', ', $multipliedNumbers) . "\n";
echo "❇️ Added by $addition: " . implode(', ', $addedNumbers) . "\n";

// --------------------------------------------------
// Higher-order array functions showcase
// --------------------------------------------------

// 1. array_map — transform
$doubled = array_map(fn($x) => $x * 2, $unsortedNumbers);
echo "array_map → Doubled: " . implode(', ', $doubled) . "\n";

// 2. array_filter — select
$positives = array_filter($unsortedNumbers, fn($x) => $x > 0);
echo "array_filter → Positive numbers: " . implode(', ', $positives) . "\n";

// 3. array_reduce — fold into a single value
$sum = array_reduce($unsortedNumbers, fn($carry, $x) => $carry + $x, 0);
echo "array_reduce → Sum of all numbers: $sum\n";

// 4. array_walk — in-place transformation (modifies original array)
$temp = $unsortedNumbers;
array_walk($temp, fn(&$x) => $x *= 10);
echo "array_walk → Each element x10: " . implode(', ', $temp) . "\n";

// 5. array_walk_recursive — works with nested arrays
$nested = [1, [2, 3], [4, [5, 6]]];
array_walk_recursive($nested, fn(&$x) => $x += 5);
echo "array_walk_recursive → Incremented nested: " . json_encode($nested) . "\n";

// 6. usort — sort values with a comparator
$temp = $unsortedNumbers;
usort($temp, fn($a, $b) => $a <=> $b); // ascending
// <=> operator returns -1, 0, 1 for less than, equal, greater than
echo "usort → Sorted ascending: " . implode(', ', $temp) . "\n";

// 7. uasort — same but preserves keys
$temp = array_combine(range('a', 'i'), $unsortedNumbers);
uasort($temp, fn($a, $b) => abs($a) <=> abs($b)); // sort by absolute value
echo "uasort → Sorted by absolute value (keys preserved): " . json_encode($temp) . "\n";

// 8. uksort — sort by custom key rule
$temp = [
    'banana' => 3,
    'apple' => 5,
    'pineapple' => 2
];
uksort($temp, fn($a, $b) => strlen($a) <=> strlen($b));
echo "uksort → Sorted by key length: " . json_encode($temp) . "\n";

// 9. array_udiff — custom comparison difference
$a1 = [1, 2, 3, 4];
$a2 = [3, 4, 5];
$diff = array_udiff($a1, $a2, fn($a, $b) => $a <=> $b);
echo "array_udiff → Values in a1 not in a2: " . implode(', ', $diff) . "\n";

// 10. array_uintersect — custom comparison intersection
$inter = array_uintersect($a1, $a2, fn($a, $b) => $a <=> $b);
echo "array_uintersect → Values shared by both arrays: " . implode(', ', $inter) . "\n";

// 11. array_uintersect_assoc — intersection considering keys and values
$a1 = ['x' => 1, 'y' => 2, 'z' => 3];
$a2 = ['y' => 2, 'z' => 4];
$interAssoc = array_uintersect_assoc($a1, $a2, fn($a, $b) => $a <=> $b);
echo "array_uintersect_assoc → Matching key/value pairs: " . json_encode($interAssoc) . "\n";

// 12. array_udiff_assoc — difference considering both key and value
$diffAssoc = array_udiff_assoc($a1, $a2, fn($a, $b) => $a <=> $b);
echo "array_udiff_assoc → Non-matching key/value pairs: " . json_encode($diffAssoc) . "\n";


echo "************************************\n";
echo "RECURSION\n";

function factorial(int $number): float
{
    if ($number <= 1) {
        return 1;
    }
    return $number * factorial($number - 1);
}

echo "Factorial with recursion\n";
echo "Factorial of 5: " . factorial(5) . "\n";
echo "Factorial of 10: " . factorial(10) . "\n";
echo "Factorial of 50: " . factorial(50) . "\n";

$fibonacciCache = [1 => 1, 2 => 1];
function fibonacci(int $number): int
{
    global $fibonacciCache;
    if (array_key_exists($number, $fibonacciCache)) {
        return $fibonacciCache[$number];
    }

    if ($number <= 1) {
        return $number;
    }
    $fibonacciCache[$number] = fibonacci($number - 1) + fibonacci($number - 2);
    return fibonacci($number - 1) + fibonacci($number - 2);
}

echo "Fibonacci with recursion\n";
echo "Fibonacci of 5: " . fibonacci(5) . "\n";
echo " Cached: " . implode(', ', $fibonacciCache) . "\n";
echo "Fibonacci of 10: " . fibonacci(10) . "\n";
echo " Cached: " . implode(', ', $fibonacciCache) . "\n";
echo "Fibonacci of 20: " . fibonacci(20) . "\n";
echo " Cached: " . implode(', ', $fibonacciCache) . "\n";
echo "Fibonacci of 50: " . fibonacci(50) . "\n";
echo " Cached: " . implode(', ', $fibonacciCache) . "\n";

echo "************************************\n";
echo "GENERATORS\n";

function contDown(int $start): Generator
{
    for ($i = $start; $i >= 0; $i--) {
        yield $i;
    }
}

echo "Countdown with generator\n";
foreach (contDown(50) as $number) {
    echo "$number... ";
}

echo "\n************************************\n";
echo "STRINGS\n";

$longText = "This is a long text with many words";
echo "Original text with double quote: $longText\n";
echo 'Original text with single quote: $longText';

$multilineText = <<<EOT
This is a multiline text
with many lines
and it preserves the formatting of
the multiple lines including  variables like
$longText
EOT;
echo "\nMultiline text:\n$multilineText\n";

echo "Substring: " . substr($longText, 10, 4) . "\n";
echo "Uppercase: " . strtoupper($longText) . "\n";
echo "Lowercase: " . strtolower($longText) . "\n";
echo "Camel case: " . ucwords($longText) . "\n";
echo "Reverse case: " . strrev($longText) . "\n";
echo "First letter uppercase: " . ucfirst($longText) . "\n";
