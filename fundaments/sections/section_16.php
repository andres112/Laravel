<?php
/**
 * ARROW FUNCTIONS (PHP 7.4+)
 * 
 * Arrow functions provide a concise syntax for simple anonymous functions.
 * They automatically capture variables from the parent scope (no 'use' needed).
 * 
 * Syntax: fn(params) => expression
 * 
 * Key features:
 * - Single expression only (implicit return)
 * - Automatic variable capture from parent scope
 * - Cannot contain statements (only expressions)
 * - More concise than traditional closures
 * 
 * Use cases: Array operations, callbacks, simple transformations, filters.
 */

echo "=== ARROW FUNCTIONS (PHP 7.4+) ===\n\n";

// Real-world example: Array transformations
echo "1. Array Mapping with Arrow Functions\n";
echo str_repeat("-", 50) . "\n";

$products = [
    ['name' => 'Laptop', 'price' => 999.99],
    ['name' => 'Mouse', 'price' => 29.99],
    ['name' => 'Keyboard', 'price' => 79.99],
    ['name' => 'Monitor', 'price' => 299.99],
];

$taxRate = 0.18;

// Arrow function (concise)
$pricesWithTaxArrow = array_map(
    fn($product) => $product['price'] * (1 + $taxRate),
    $products
);

echo "Products with tax (" . ($taxRate * 100) . "%):\n";
foreach ($products as $index => $product) {
    $finalPrice = $pricesWithTaxArrow[$index];
    printf("  %s: $%.2f → $%.2f\n", 
        $product['name'], $product['price'], $finalPrice);
}

echo "\n";

// Real-world example: Filtering data
echo "2. Data Filtering\n";
echo str_repeat("-", 50) . "\n";

$users = [
    ['name' => 'John', 'age' => 25, 'active' => true, 'role' => 'user'],
    ['name' => 'Jane', 'age' => 30, 'active' => true, 'role' => 'admin'],
    ['name' => 'Bob', 'age' => 22, 'active' => false, 'role' => 'user'],
    ['name' => 'Alice', 'age' => 35, 'active' => true, 'role' => 'moderator'],
    ['name' => 'Charlie', 'age' => 19, 'active' => true, 'role' => 'user'],
];

// Filter active users
$activeUsers = array_filter($users, fn($user) => $user['active']);

echo "Active users:\n";
foreach ($activeUsers as $user) {
    echo "  {$user['name']} ({$user['role']})\n";
}

// Filter adult active users
$adultUsers = array_filter($users, fn($user) => $user['active'] && $user['age'] >= 21);

echo "\nActive adult users (21+):\n";
foreach ($adultUsers as $user) {
    echo "  {$user['name']} - Age: {$user['age']}\n";
}

// Filter admins and moderators
$staff = array_filter($users, fn($user) => 
    $user['role'] === 'admin' || $user['role'] === 'moderator'
);

echo "\nStaff members:\n";
foreach ($staff as $member) {
    echo "  {$member['name']} - {$member['role']}\n";
}

echo "\n";

// Real-world example: Sorting with custom logic
echo "3. Custom Sorting\n";
echo str_repeat("-", 50) . "\n";

$products = [
    ['name' => 'Laptop', 'price' => 999.99, 'rating' => 4.5, 'stock' => 15],
    ['name' => 'Mouse', 'price' => 29.99, 'rating' => 4.8, 'stock' => 50],
    ['name' => 'Keyboard', 'price' => 79.99, 'rating' => 4.3, 'stock' => 0],
    ['name' => 'Monitor', 'price' => 299.99, 'rating' => 4.7, 'stock' => 8],
    ['name' => 'Headphones', 'price' => 199.99, 'rating' => 4.6, 'stock' => 25],
    ['name' => 'Webcam', 'price' => 89.99, 'rating' => 4.2, 'stock' => 0],
    ['name' => 'Tablet', 'price' => 499.99, 'rating' => 4.4, 'stock' => 12],
    ['name' => 'Smartphone', 'price' => 699.99, 'rating' => 4.5, 'stock' => 30],
    ['name' => 'Charger', 'price' => 19.99, 'rating' => 4.1, 'stock' => 100],
    ['name' => 'USB Cable', 'price' => 9.99, 'rating' => 4.0, 'stock' => 0],
];

// Sort by price (ascending)
$byPrice = $products;
usort($byPrice, fn($a, $b) => $a['price'] <=> $b['price']);

echo "Sorted by price (low to high):\n";
foreach ($byPrice as $product) {
    printf("  %s: $%.2f\n", $product['name'], $product['price']);
}

// Sort by rating (descending)
$byRating = $products;
usort($byRating, fn($a, $b) => $b['rating'] <=> $a['rating']);

echo "\nSorted by rating (high to low):\n";
foreach ($byRating as $product) {
    printf("  %s: %.1f stars\n", $product['name'], $product['rating']);
}

// Complex sort: in stock first, then by rating
$byAvailability = $products;
usort($byAvailability, fn($a, $b) => 
    ($b['stock'] > 0 <=> $a['stock'] > 0) ?: ($b['rating'] <=> $a['rating'])
);

echo "\nSorted by availability & rating:\n";
foreach ($byAvailability as $product) {
    $status = $product['stock'] > 0 ? '✓ In Stock' : '✗ Out of Stock';
    printf("  %s: %s (%.1f stars)\n", $product['name'], $status, $product['rating']);
}

echo "\n";

// Real-world example: Data extraction
echo "4. Extracting Specific Fields\n";
echo str_repeat("-", 50) . "\n";

$orders = [
    ['id' => 1, 'customer' => 'John', 'total' => 299.99, 'status' => 'completed'],
    ['id' => 2, 'customer' => 'Jane', 'total' => 149.50, 'status' => 'pending'],
    ['id' => 3, 'customer' => 'Bob', 'total' => 499.99, 'status' => 'shipped'],
];

// Extract just customer names
$customerNames = array_map(fn($order) => $order['customer'], $orders);

echo "Customers: " . implode(', ', $customerNames) . "\n\n";

// Extract order IDs
$orderIds = array_map(fn($order) => $order['id'], $orders);

echo "Order IDs: " . implode(', ', $orderIds) . "\n\n";

// Calculate total revenue
$totalRevenue = array_reduce($orders, fn($sum, $order) => $sum + $order['total'], 0);

echo "Total Revenue: $" . number_format($totalRevenue, 2) . "\n\n";

// Real-world example: Validation chains
echo "5. Validation with Arrow Functions\n";
echo str_repeat("-", 50) . "\n";

$validationRules = [
    'required' => fn($value) => !empty($value),
    'min_length' => fn($value, $min) => strlen($value) >= $min,
    'max_length' => fn($value, $max) => strlen($value) <= $max,
    'email' => fn($value) => filter_var($value, FILTER_VALIDATE_EMAIL) !== false,
    'numeric' => fn($value) => is_numeric($value),
    'positive' => fn($value) => is_numeric($value) && $value > 0,
];

$formData = [
    'username' => 'john_doe',
    'email' => 'john@example.com',
    'age' => '25',
    'bio' => 'Software developer',
];

echo "Validating form data:\n\n";

// Validate username
$usernameValid = $validationRules['required']($formData['username']) &&
                 $validationRules['min_length']($formData['username'], 3) &&
                 $validationRules['max_length']($formData['username'], 20);

echo "Username '{$formData['username']}': " . ($usernameValid ? '✓ Valid' : '✗ Invalid') . "\n";

// Validate email
$emailValid = $validationRules['required']($formData['email']) &&
              $validationRules['email']($formData['email']);

echo "Email '{$formData['email']}': " . ($emailValid ? '✓ Valid' : '✗ Invalid') . "\n";

// Validate age
$ageValid = $validationRules['required']($formData['age']) &&
            $validationRules['numeric']($formData['age']) &&
            $validationRules['positive']($formData['age']);

echo "Age '{$formData['age']}': " . ($ageValid ? '✓ Valid' : '✗ Invalid') . "\n\n";

// Real-world example: Chaining array operations
echo "6. Chaining Operations\n";
echo str_repeat("-", 50) . "\n";

$transactions = [
    ['type' => 'income', 'amount' => 2000, 'category' => 'salary'],
    ['type' => 'expense', 'amount' => 500, 'category' => 'rent'],
    ['type' => 'expense', 'amount' => 100, 'category' => 'groceries'],
    ['type' => 'income', 'amount' => 300, 'category' => 'freelance'],
    ['type' => 'expense', 'amount' => 50, 'category' => 'utilities'],
    ['type' => 'expense', 'amount' => 200, 'category' => 'entertainment'],
    ['type' => 'expense', 'amount' => 150, 'category' => 'entertainment']
];

// Calculate total income
$totalIncome = array_reduce(
    array_filter($transactions, fn($t) => $t['type'] === 'income'),
    fn($sum, $t) => $sum + $t['amount'],
    0
);

// Calculate total expenses
$totalExpenses = array_reduce(
    array_filter($transactions, fn($t) => $t['type'] === 'expense'),
    fn($sum, $t) => $sum + $t['amount'],
    0
);

$balance = $totalIncome - $totalExpenses;

echo "Financial Summary:\n";
echo "  Total Income: $" . number_format($totalIncome, 2) . "\n";
echo "  Total Expenses: $" . number_format($totalExpenses, 2) . "\n";
echo "  Balance: $" . number_format($balance, 2) . "\n\n";

// Group expenses by category
echo "Expenses by category:\n";
$expensesByCategory = [];
foreach (array_filter($transactions, fn($t) => $t['type'] === 'expense') as $transaction) {
    $category = $transaction['category'];
    if (!isset($expensesByCategory[$category])) {
        $expensesByCategory[$category] = 0;
    }
    $expensesByCategory[$category] += $transaction['amount'];
}

foreach ($expensesByCategory as $category => $amount) {
    $percentage = ($amount / $totalExpenses) * 100;
    printf("  %s: $%.2f (%.1f%%)\n", ucfirst($category), $amount, $percentage);
}

echo "\n";

// Real-world example: Performance comparison
echo "7. Arrow Function vs Closure Performance\n";
echo str_repeat("-", 50) . "\n";

$data = range(1, 10000);
$multiplier = 2;

// Traditional closure
$start = microtime(true);
$result1 = array_map(function($x) use ($multiplier) {
    return $x * $multiplier;
}, $data);
$time1 = microtime(true) - $start;

// Arrow function
$start = microtime(true);
$result2 = array_map(fn($x) => $x * $multiplier, $data);
$time2 = microtime(true) - $start;

echo "Processing 10,000 elements:\n";
echo "  Traditional closure: " . number_format($time1 * 1000, 4) . " ms\n";
echo "  Arrow function: " . number_format($time2 * 1000, 4) . " ms\n";
echo "  Performance: Similar (syntax sugar, not faster)\n\n";

echo "Benefits of arrow functions:\n";
echo "  ✓ More concise syntax\n";
echo "  ✓ Automatic variable capture (no 'use' keyword)\n";
echo "  ✓ Single expression only (implicit return)\n";
echo "  ✓ Better readability for simple operations\n";

echo "\n💡 Best Practice: Use arrow functions for simple, single-expression\n";
echo "   callbacks. Use traditional closures for complex multi-line logic.\n";
