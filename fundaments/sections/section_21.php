<?php

$simpleArray = [1, 2, 3, 4, 5];
$associativeArray = [
    "first" => "John",
    "last" => "Doe",
    "age" => 30,
    "city" => "New York"
];

$simpleArray[] = 6; // Adding an element to the simple array
$associativeArray["country"] = "USA"; // Adding an element to the associative array

$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

echo "The value at matrix[1][1] is " . $matrix[1][1]."\n"; // Outputs: 5


$fruits = "apple, banana, cherry, date";
$fruitArray = explode(", ", $fruits); // Splitting string into array
var_dump($fruitArray);

// sorting arrays
echo "Sorting arrays:\n";
var_dump($associativeArray);
asort($associativeArray); // Sort by values
var_dump($associativeArray);
ksort($associativeArray); // Sort by keys
var_dump($associativeArray);

// numbers
echo "Array of numbers";
$numbers = range(1,10);
var_dump($numbers);
$squared = array_map(fn($n) => $n * $n, $numbers);
var_dump($squared);

$evenNumbers = array_filter($numbers, fn($n) => $n % 2 === 0);
var_dump($evenNumbers);

$sum = array_reduce($numbers, fn($carry, $n) => $carry + $n, 0);
echo "Sum of numbers: $sum\n";

// merging arrays
$moreNumbers = [-5, ...$numbers, 11, 12];
var_dump($moreNumbers);

// array destructuring
[$first, , $third] = $fruitArray;
echo "First fruit: $first, Third fruit: $third\n";