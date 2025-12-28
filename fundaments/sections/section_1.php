<?php

/**
 * DATA TYPES in PHP
 * 
 * PHP is a dynamically typed language, meaning variables don't need explicit type declarations.
 * However, understanding data types is crucial for writing robust applications.
 * 
 * Main PHP data types:
 * - Scalar: int, float, string, bool
 * - Compound: array, object
 * - Special: null, resource
 * 
 * Type juggling: PHP automatically converts types in certain contexts
 * Type comparison: == (loose) vs === (strict)
 */

echo "=== DATA TYPES IN PHP ===\n\n";

// Real-world example: User registration validation
echo "1. Boolean Types - User Account Status\n";
echo str_repeat("-", 50) . "\n";

$isEmailVerified = true;
$hasSubscription = false;
$loginAttempts = 0;

echo "Email verified: " . ($isEmailVerified ? "✓ Yes" : "✗ No") . "\n";
echo "Has subscription: " . ($hasSubscription ? "✓ Yes" : "✗ No") . "\n";
echo "Account locked: " . ($loginAttempts >= 5 ? "✓ Yes" : "✗ No") . "\n\n";

// Real-world example: E-commerce pricing
echo "2. Numeric Types - Product Pricing\n";
echo str_repeat("-", 50) . "\n";

$productPrice = 99.99;          // float
$quantity = 3;                   // int
$taxRate = 0.18;                // float (18%)

$subtotal = $productPrice * $quantity;
$tax = $subtotal * $taxRate;
$total = $subtotal + $tax;

echo "Product Price: $" . number_format($productPrice, 2) . "\n";
echo "Quantity: $quantity\n";
echo "Subtotal: $" . number_format($subtotal, 2) . "\n";
echo "Tax (18%): $" . number_format($tax, 2) . "\n";
echo "Total: $" . number_format($total, 2) . "\n\n";

// Real-world example: Math operations
// round, floor, ceil, rand, min, max, abs, sqrt, pow, log, exp, sin, cos, tan, number_format
echo "2.1. Math Operations \n";
echo str_repeat("-", 50) . "\n";

$number = 7.65;
echo "Original number: $number\n";
echo "Rounded: " . round($number) . "\n";
echo "Floored: " . floor($number) . "\n";
echo "Ceiled: " . ceil($number) . "\n";

$random = rand(1, 100);
echo "Random number (1-100): $random\n";

$values = [3, 7, 2, 9, 5];
echo "Values: " . implode(", ", $values) . "\n";
echo "Min: " . min($values) . "\n";
echo "Max: " . max($values) . "\n";

$negative = -42;
echo "Absolute value of $negative: " . abs($negative) . "\n\n";

// More math operations
$base = 2;
$exponent = 8;
echo "$base raised to the power of $exponent: " . pow($base, $exponent) . "\n";

$sqrtNum = 49;
echo "Square root of $sqrtNum: " . sqrt($sqrtNum) . "\n";

$logNum = 1000;
echo "Natural log of $logNum: " . log($logNum) . "\n";
echo "Base-10 log of $logNum: " . log10($logNum) . "\n";

$expNum = 2;
echo "e^$expNum: " . exp($expNum) . "\n";

$angle = pi() / 4; // 45 degrees
echo "sin(45°): " . sin($angle) . "\n";
echo "cos(45°): " . cos($angle) . "\n";
echo "tan(45°): " . tan($angle) . "\n\n";

echo rad2deg(atan2($expNum, 1)) . " degrees\n\n";


// Real-world example: String manipulation for display
echo "3. String Types - User Profile\n";
echo str_repeat("-", 50) . "\n";

$firstName = "John";
$lastName = "Doe";
$email = "john.doe@example.com";
$fullName = "$firstName $lastName";

echo "Full Name: $fullName\n";
echo "Email: $email\n";
echo "Username: " . strtolower(str_replace(' ', '_', $fullName)) . "\n\n";

// Real-world example: Arrays for data structures
echo "4. Array Types - Shopping Cart\n";
echo str_repeat("-", 50) . "\n";

$cart = [
  ['id' => 1, 'name' => 'Laptop', 'price' => 999.99, 'qty' => 1],
  ['id' => 2, 'name' => 'Mouse', 'price' => 29.99, 'qty' => 2],
  ['id' => 3, 'name' => 'Keyboard', 'price' => 79.99, 'qty' => 1],
];

$cartTotal = 0;
foreach ($cart as $item) {
  $itemTotal = $item['price'] * $item['qty'];
  $cartTotal += $itemTotal;
  echo "{$item['name']} x{$item['qty']}: $" . number_format($itemTotal, 2) . "\n";
}
echo "Cart Total: $" . number_format($cartTotal, 2) . "\n\n";

// Type comparison demonstration
echo "5. Type Comparison - Loose (==) vs Strict (===)\n";
echo str_repeat("-", 50) . "\n";

$userId = "123";
$userIdInt = 123;
$isActive = 1;
$isActiveTrue = true;

echo "String '123' == Int 123: " . ($userId == $userIdInt ? "true" : "false") . " (loose comparison)\n";
echo "String '123' === Int 123: " . ($userId === $userIdInt ? "true" : "false") . " (strict comparison)\n";
echo "Int 1 == Bool true: " . ($isActive == $isActiveTrue ? "true" : "false") . " (loose comparison)\n";
echo "Int 1 === Bool true: " . ($isActive === $isActiveTrue ? "true" : "false") . " (strict comparison)\n\n";

// Debugging with var_dump
echo "6. Debugging with var_dump()\n";
echo str_repeat("-", 50) . "\n";
echo "var_dump() shows the exact type and value:\n\n";

$mixedData = [
  'string' => '123',
  'integer' => 123,
  'float' => 123.45,
  'boolean' => true,
  'null' => null,
  'array' => [1, 2, 3],
];

var_dump($mixedData);

echo "\n💡 Best Practice: Always use strict comparison (===) when checking values\n";
echo "   to avoid unexpected type coercion bugs.\n";

// Enums in PHP 8.1+
echo "\n7. Enums in PHP 8.1+\n";

enum DaysOfWeek: string
{
    case Monday = 'Monday';
    case Tuesday = 'Tuesday';
    case Wednesday = 'Wednesday';
    case Thursday = 'Thursday';
    case Friday = 'Friday';
    case Saturday = 'Saturday';
    case Sunday = 'Sunday';
}

$today = DaysOfWeek::Friday;
echo "Today is: " . $today->value . "\n";