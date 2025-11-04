<?php
/**
 * REFERENCES IN PHP
 * 
 * References allow multiple variables to point to the same value in memory.
 * Using the & operator creates an alias to the original variable.
 * 
 * Key concepts:
 * - Variable references: $b = &$a (both point to same value)
 * - Function parameters by reference: function foo(&$var)
 * - Return by reference: function &getReference()
 * 
 * Use cases: Modifying arrays in place, performance optimization (avoiding copies),
 *            function output parameters, implementing data structures.
 * 
 * ⚠️ Warning: References can make code harder to understand and debug.
 *    Use sparingly and only when necessary.
 */

echo "=== REFERENCES IN PHP ===\n\n";

// Real-world example: Understanding reference behavior
echo "1. Basic Reference Behavior\n";
echo str_repeat("-", 50) . "\n";

// Without reference (copy)
$originalPrice = 100;
$copiedPrice = $originalPrice;
$copiedPrice = 150;

echo "Without Reference (Copy):\n";
echo "  Original: $$originalPrice\n";
echo "  Copied (modified): $$copiedPrice\n";
echo "  Original unchanged: $$originalPrice\n\n";

// With reference (alias)
$originalPrice = 100;
$referencedPrice = &$originalPrice;
$referencedPrice = 150;

echo "With Reference (Alias):\n";
echo "  Original: $$originalPrice\n";
echo "  Referenced (modified): $$referencedPrice\n";
echo "  Original also changed: $$originalPrice\n\n";

// Real-world example: In-place array modification
echo "2. Array Modification in Place\n";
echo str_repeat("-", 50) . "\n";

$products = [
    ['id' => 1, 'name' => 'Laptop', 'price' => 999.99, 'discount' => 0],
    ['id' => 2, 'name' => 'Mouse', 'price' => 29.99, 'discount' => 0],
    ['id' => 3, 'name' => 'Keyboard', 'price' => 79.99, 'discount' => 0],
];

echo "Original prices:\n";
foreach ($products as $product) {
    echo "  {$product['name']}: $" . number_format($product['price'], 2) . "\n";
}

// Apply 10% discount using reference
echo "\nApplying 10% discount (using reference):\n";
foreach ($products as &$product) {
    $product['discount'] = 10;
    $product['price'] = $product['price'] * 0.90;
    echo "  {$product['name']}: $" . number_format($product['price'], 2) . 
         " ({$product['discount']}% off)\n";
}
unset($product); // Important: break the reference!

echo "\n⚠️  Always unset the reference variable after foreach loop!\n\n";

// Real-world example: Function parameters by reference
echo "3. Function Parameters by Reference\n";
echo str_repeat("-", 50) . "\n";

function applyTax(float &$amount, float $taxRate): void
{
    $originalAmount = $amount;
    $amount = $amount * (1 + $taxRate);
    echo "  Tax applied: $" . number_format($originalAmount, 2) . 
         " → $" . number_format($amount, 2) . "\n";
}

function applyDiscount(float &$amount, float $discountPercent): void
{
    $originalAmount = $amount;
    $amount = $amount * (1 - $discountPercent / 100);
    echo "  Discount applied: $" . number_format($originalAmount, 2) . 
         " → $" . number_format($amount, 2) . "\n";
}

$orderTotal = 100.00;
echo "Order Total: $" . number_format($orderTotal, 2) . "\n\n";

applyDiscount($orderTotal, 15); // 15% discount
applyTax($orderTotal, 0.18);     // 18% tax

echo "\nFinal Order Total: $" . number_format($orderTotal, 2) . "\n\n";

// Real-world example: Swap function
echo "4. Swap Function with References\n";
echo str_repeat("-", 50) . "\n";

function swap(&$a, &$b): void
{
    $temp = $a;
    $a = $b;
    $b = $temp;
}

$firstName = "John";
$lastName = "Doe";

echo "Before swap:\n";
echo "  First Name: $firstName\n";
echo "  Last Name: $lastName\n\n";

swap($firstName, $lastName);

echo "After swap:\n";
echo "  First Name: $firstName\n";
echo "  Last Name: $lastName\n\n";

// Real-world example: Statistics calculator with multiple outputs
echo "5. Multiple Return Values via References\n";
echo str_repeat("-", 50) . "\n";

function calculateStatistics(array $numbers, &$min, &$max, &$avg, &$sum): void
{
    $min = min($numbers);
    $max = max($numbers);
    $sum = array_sum($numbers);
    $avg = $sum / count($numbers);
}

$salesData = [150, 230, 180, 270, 190, 310, 245];

$minimum = 0;
$maximum = 0;
$average = 0;
$total = 0;

calculateStatistics($salesData, $minimum, $maximum, $average, $total);

echo "Sales Data Analysis:\n";
echo "  Data: " . implode(', ', $salesData) . "\n";
echo "  Minimum: $" . number_format($minimum, 2) . "\n";
echo "  Maximum: $" . number_format($maximum, 2) . "\n";
echo "  Average: $" . number_format($average, 2) . "\n";
echo "  Total: $" . number_format($total, 2) . "\n\n";

// Real-world example: The danger of references
echo "6. Common Reference Pitfalls\n";
echo str_repeat("-", 50) . "\n";

echo "⚠️  DANGER: Forgetting to unset reference in foreach:\n\n";

$numbers = [1, 2, 3, 4, 5];

echo "Original: " . implode(', ', $numbers) . "\n";

// First loop with reference
foreach ($numbers as &$num) {
    $num *= 2;
}
// Oops! Forgot to unset($num)

// Second loop without reference
echo "After doubling: " . implode(', ', $numbers) . "\n";

foreach ($numbers as $num) {
    // This will cause unexpected behavior!
}
echo "After second loop (CORRUPTED): " . implode(', ', $numbers) . "\n\n";

echo "✓ CORRECT: Always unset reference:\n\n";

$numbers = [1, 2, 3, 4, 5];
echo "Original: " . implode(', ', $numbers) . "\n";

foreach ($numbers as &$num) {
    $num *= 2;
}
unset($num); // ← This is critical!

echo "After doubling: " . implode(', ', $numbers) . "\n";

foreach ($numbers as $num) {
    // Now it works correctly
}
echo "After second loop (CORRECT): " . implode(', ', $numbers) . "\n\n";

// Real-world example: When NOT to use references
echo "7. When to Avoid References\n";
echo str_repeat("-", 50) . "\n";

echo "❌ DON'T: Use references for simple value passing\n";
echo "   function calculate(&\$x) { return \$x * 2; }\n\n";

echo "✓ DO: Use normal parameters and return values\n";
echo "   function calculate(\$x) { return \$x * 2; }\n\n";

echo "❌ DON'T: Use references to 'optimize' small arrays\n";
echo "   PHP's copy-on-write is already efficient\n\n";

echo "✓ DO: Use references for large data structures or\n";
echo "   when you explicitly need to modify the original\n\n";

// Real-world example: Performance consideration
echo "8. Performance: Copy vs Reference\n";
echo str_repeat("-", 50) . "\n";

$largeArray = range(1, 10000);

// Copy (but PHP uses copy-on-write, so it's efficient)
$startTime = microtime(true);
$copy = $largeArray; // Looks like a copy, but actually just a pointer
$copy[0] = 999; // Now it makes an actual copy
$copyTime = microtime(true) - $startTime;

// Reference
$startTime = microtime(true);
$ref = &$largeArray; // True reference
$ref[0] = 999;
$refTime = microtime(true) - $startTime;

echo "Copying 10,000 element array:\n";
echo "  Copy method: " . number_format($copyTime * 1000, 6) . " ms\n";
echo "  Reference method: " . number_format($refTime * 1000, 6) . " ms\n\n";

echo "Note: PHP's copy-on-write makes copies cheap until modification.\n";
echo "References are only beneficial for very large data structures.\n";

echo "\n� Best Practice: Avoid references unless absolutely necessary.\n";
echo "   They make code harder to debug and can introduce subtle bugs.\n";
echo "   Use return values instead of output parameters when possible.\n";
