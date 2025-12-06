<?php

$sections = [
    1 => 'DATA TYPES',
    2 => 'CONDITION IF STATEMENT',
    3 => 'LOOP WHILE - DO...WHILE',
    4 => 'LOOP FOR',
    5 => 'LOOP FOREACH',
    6 => 'SWITCH STATEMENT',
    7 => 'MATCH EXPRESSION',
    8 => 'REQUIRE/INCLUDE',
    9 => 'FUNCTIONS',
    10 => 'ANONYMOUS FUNCTIONS - CLOSURES',
    11 => 'REFERENCES',
    12 => 'PERFORMANCE',
    13 => 'VARIABLE SCOPE',
    14 => 'NULL in PHP 8.0',
    15 => 'NAMED ARGUMENTS in PHP 8.0',
    16 => 'ARROW FUNCTIONS',
    17 => 'HIGH ORDER FUNCTIONS',
    18 => 'RECURSION',
    19 => 'GENERATORS',
    20 => 'STRINGS & STRING SEARCH',
    21 => 'ARRAYS',
    22 => 'CLASSES',
];

// Print menu
function printMenu($sections) {
    echo "PHP Fundamentals Index\n";
    echo str_repeat("=", 30) . "\n";
    foreach ($sections as $key => $section) {
        echo "$key. $section\n";
    }
    echo "0. Exit\n";
    echo str_repeat("=", 30) . "\n";
}

printMenu($sections);
echo "Select a section number: ";
$choice = (int)readline();

if ($choice === 0) {
    echo "Exiting...\n";
    exit;
}

if (!isset($sections[$choice])) {
    echo "Invalid selection.\n";
    exit(1);
}

$sectionFile = __DIR__ . "/sections/section_$choice.php";
if (file_exists($sectionFile)) {
    include $sectionFile;
} else {
    echo "Section not implemented yet.\n";
}
