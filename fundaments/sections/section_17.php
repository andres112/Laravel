<?php
/**
 * HIGH ORDER FUNCTIONS
 * 
 * High-order functions are functions that accept other functions as arguments
 * or return functions. They enable functional programming patterns in PHP.
 * 
 * Common high-order functions in PHP:
 * - array_map()    : Transform each element
 * - array_filter() : Select elements based on condition
 * - array_reduce() : Reduce array to single value
 * - array_walk()   : Apply function to each element
 * - usort()        : Custom sorting
 * 
 * Benefits: Code reusability, cleaner syntax, functional programming patterns.
 */

echo "=== HIGH ORDER FUNCTIONS ===\n\n";

// Real-world example: Data transformation pipeline
echo "1. Data Transformation Pipeline\n";
echo str_repeat("-", 50) . "\n";

$rawUserData = [
    ['name' => 'john doe', 'email' => 'JOHN@EXAMPLE.COM', 'age' => '25', 'status' => 'active'],
    ['name' => 'jane smith', 'email' => 'jane@example.com', 'age' => '30', 'status' => 'inactive'],
    ['name' => 'bob wilson', 'email' => 'BOB@EXAMPLE.COM', 'age' => '22', 'status' => 'active'],
    ['name' => 'alice brown', 'email' => 'alice@example.com', 'age' => '35', 'status' => 'active'],
];

echo "Raw data transformation pipeline:\n\n";

// Pipeline: Filter active → Normalize names → Lowercase emails → Convert age to int
$processedUsers = array_map(
    fn($user) => [
        'name' => ucwords($user['name']),
        'email' => strtolower($user['email']),
        'age' => (int)$user['age'],
        'status' => $user['status']
    ],
    array_filter($rawUserData, fn($user) => $user['status'] === 'active')
);

foreach ($processedUsers as $user) {
    echo "  Name: {$user['name']}, Email: {$user['email']}, Age: {$user['age']}\n";
}

echo "\n";

// Real-world example: E-commerce calculations
echo "2. E-commerce Price Calculations\n";
echo str_repeat("-", 50) . "\n";

$cartItems = [
    ['name' => 'Laptop', 'price' => 999.99, 'quantity' => 1, 'discount' => 0.10],
    ['name' => 'Mouse', 'price' => 29.99, 'quantity' => 2, 'discount' => 0.00],
    ['name' => 'Keyboard', 'price' => 79.99, 'quantity' => 1, 'discount' => 0.05],
    ['name' => 'Monitor', 'price' => 299.99, 'quantity' => 2, 'discount' => 0.15],
];

// Calculate subtotal for each item
$itemsWithSubtotal = array_map(function($item) {
    $subtotal = $item['price'] * $item['quantity'];
    $discountAmount = $subtotal * $item['discount'];
    $finalPrice = $subtotal - $discountAmount;
    
    return array_merge($item, [
        'subtotal' => $subtotal,
        'discount_amount' => $discountAmount,
        'final_price' => $finalPrice
    ]);
}, $cartItems);

echo "Cart breakdown:\n";
foreach ($itemsWithSubtotal as $item) {
    printf("  %s (x%d): $%.2f", $item['name'], $item['quantity'], $item['subtotal']);
    if ($item['discount'] > 0) {
        printf(" - $%.2f (%.0f%% off)", $item['discount_amount'], $item['discount'] * 100);
    }
    printf(" = $%.2f\n", $item['final_price']);
}

// Calculate cart total
$cartTotal = array_reduce(
    $itemsWithSubtotal,
    fn($total, $item) => $total + $item['final_price'],
    0
);

echo "\nCart Total: $" . number_format($cartTotal, 2) . "\n\n";

// Real-world example: Data filtering and grouping
echo "3. Log Analysis and Grouping\n";
echo str_repeat("-", 50) . "\n";

$logEntries = [
    ['level' => 'ERROR', 'message' => 'Database connection failed', 'timestamp' => 1609459200],
    ['level' => 'INFO', 'message' => 'User login successful', 'timestamp' => 1609459300],
    ['level' => 'WARNING', 'message' => 'Slow query detected', 'timestamp' => 1609459400],
    ['level' => 'ERROR', 'message' => 'File not found', 'timestamp' => 1609459500],
    ['level' => 'INFO', 'message' => 'Cache cleared', 'timestamp' => 1609459600],
    ['level' => 'ERROR', 'message' => 'API timeout', 'timestamp' => 1609459700],
];

// Group by severity
$groupBySeverity = function($logs) {
    $grouped = [];
    array_walk($logs, function($log) use (&$grouped) {
        $grouped[$log['level']][] = $log;
    });
    return $grouped;
};

$groupedLogs = $groupBySeverity($logEntries);

foreach ($groupedLogs as $level => $logs) {
    echo "{$level} logs (" . count($logs) . "):\n";
    foreach ($logs as $log) {
        $time = date('H:i:s', $log['timestamp']);
        echo "  [{$time}] {$log['message']}\n";
    }
    echo "\n";
}

// Count errors
$errorCount = count(array_filter($logEntries, fn($log) => $log['level'] === 'ERROR'));
echo "Total errors found: {$errorCount}\n\n";

// Real-world example: Custom validation chain
echo "4. Validation Chain\n";
echo str_repeat("-", 50) . "\n";

// High-order function that returns validators
function createValidator(string $rule): callable {
    return match($rule) {
        'required' => fn($value) => !empty($value) ? true : 'Field is required',
        'email' => fn($value) => filter_var($value, FILTER_VALIDATE_EMAIL) ? true : 'Invalid email',
        'min:3' => fn($value) => strlen($value) >= 3 ? true : 'Minimum 3 characters',
        'max:50' => fn($value) => strlen($value) <= 50 ? true : 'Maximum 50 characters',
        'numeric' => fn($value) => is_numeric($value) ? true : 'Must be a number',
        'positive' => fn($value) => $value > 0 ? true : 'Must be positive',
        default => fn($value) => true
    };
}

// Validate function using validators
function validate(mixed $value, array $rules): array {
    $errors = [];
    foreach ($rules as $rule) {
        $validator = createValidator($rule);
        $result = $validator($value);
        if ($result !== true) {
            $errors[] = $result;
        }
    }
    return $errors;
}

$testData = [
    'email' => ['value' => 'test@example.com', 'rules' => ['required', 'email']],
    'username' => ['value' => 'ab', 'rules' => ['required', 'min:3', 'max:50']],
    'age' => ['value' => '25', 'rules' => ['required', 'numeric', 'positive']],
];

echo "Validation results:\n";
foreach ($testData as $field => $config) {
    $errors = validate($config['value'], $config['rules']);
    if (empty($errors)) {
        echo "  ✓ {$field}: '{$config['value']}' is valid\n";
    } else {
        echo "  ✗ {$field}: '{$config['value']}' - " . implode(', ', $errors) . "\n";
    }
}

echo "\n";

// Real-world example: Function composition
echo "5. Function Composition\n";
echo str_repeat("-", 50) . "\n";

// Compose multiple functions together
function compose(callable ...$functions): callable {
    return fn($value) => array_reduce(
        array_reverse($functions),
        fn($carry, $fn) => $fn($carry),
        $value
    );
}

// Individual transformation functions
$trim = fn($str) => trim($str);
$lowercase = fn($str) => strtolower($str);
$removeSpaces = fn($str) => str_replace(' ', '', $str);
$reverse = fn($str) => strrev($str);

// Compose a slug generator
$slugify = compose($trim, $lowercase, fn($str) => str_replace(' ', '-', $str));

$title = "  Hello World Example  ";
$slug = $slugify($title);

echo "Original: '{$title}'\n";
echo "Slugified: '{$slug}'\n\n";

// Compose username sanitizer
$sanitizeUsername = compose(
    $trim,
    $lowercase,
    fn($str) => preg_replace('/[^a-z0-9_]/', '', $str)
);

$inputUsername = "  John_Doe123!@# ";
$cleanUsername = $sanitizeUsername($inputUsername);

echo "Input username: '{$inputUsername}'\n";
echo "Sanitized: '{$cleanUsername}'\n\n";

// Real-world example: Array operations chaining
echo "6. Report Generation with Array Operations\n";
echo str_repeat("-", 50) . "\n";

$salesData = [
    ['date' => '2024-01-01', 'product' => 'Laptop', 'amount' => 999.99, 'region' => 'North'],
    ['date' => '2024-01-02', 'product' => 'Mouse', 'amount' => 29.99, 'region' => 'South'],
    ['date' => '2024-01-03', 'product' => 'Laptop', 'amount' => 999.99, 'region' => 'North'],
    ['date' => '2024-01-04', 'product' => 'Keyboard', 'amount' => 79.99, 'region' => 'East'],
    ['date' => '2024-01-05', 'product' => 'Monitor', 'amount' => 299.99, 'region' => 'West'],
    ['date' => '2024-01-06', 'product' => 'Laptop', 'amount' => 999.99, 'region' => 'South'],
];

// Generate sales report
$totalSales = array_reduce($salesData, fn($sum, $sale) => $sum + $sale['amount'], 0);

// Group by product
$productSales = [];
array_walk($salesData, function($sale) use (&$productSales) {
    $product = $sale['product'];
    if (!isset($productSales[$product])) {
        $productSales[$product] = ['count' => 0, 'total' => 0];
    }
    $productSales[$product]['count']++;
    $productSales[$product]['total'] += $sale['amount'];
});

// Sort by total sales (descending)
uasort($productSales, fn($a, $b) => $b['total'] <=> $a['total']);

echo "Sales Report:\n";
echo "Total Revenue: $" . number_format($totalSales, 2) . "\n\n";
echo "By Product:\n";
foreach ($productSales as $product => $data) {
    $percentage = ($data['total'] / $totalSales) * 100;
    printf("  %s: %d sales, $%.2f (%.1f%%)\n", 
        $product, $data['count'], $data['total'], $percentage);
}

// Find best-selling product
$bestSeller = array_key_first($productSales);
echo "\n🏆 Best Seller: {$bestSeller}\n\n";

// Real-world example: Custom array operations
echo "7. Custom High-Order Functions\n";
echo str_repeat("-", 50) . "\n";

// pluck - extract a specific field from array of arrays
function pluck(array $array, string $key): array {
    return array_map(fn($item) => $item[$key] ?? null, $array);
}

// where - filter by field value
function where(array $array, string $key, mixed $value): array {
    return array_filter($array, fn($item) => ($item[$key] ?? null) === $value);
}

// sortBy - sort by field
function sortBy(array $array, string $key, string $direction = 'asc'): array {
    $sorted = $array;
    usort($sorted, fn($a, $b) => $direction === 'asc' 
        ? ($a[$key] ?? 0) <=> ($b[$key] ?? 0)
        : ($b[$key] ?? 0) <=> ($a[$key] ?? 0)
    );
    return $sorted;
}

$employees = [
    ['name' => 'John', 'department' => 'IT', 'salary' => 60000],
    ['name' => 'Jane', 'department' => 'HR', 'salary' => 55000],
    ['name' => 'Bob', 'department' => 'IT', 'salary' => 65000],
    ['name' => 'Alice', 'department' => 'Sales', 'salary' => 70000],
];

// Use custom functions
$names = pluck($employees, 'name');
echo "All employees: " . implode(', ', $names) . "\n\n";

$itDepartment = where($employees, 'department', 'IT');
echo "IT Department:\n";
foreach ($itDepartment as $emp) {
    echo "  {$emp['name']} - \${$emp['salary']}\n";
}

echo "\nEmployees by salary (high to low):\n";
$bySalary = sortBy($employees, 'salary', 'desc');
foreach ($bySalary as $emp) {
    printf("  %s (%s): $%s\n", $emp['name'], $emp['department'], number_format($emp['salary']));
}

echo "\n💡 Best Practice: High-order functions make code more declarative\n";
echo "   and easier to understand. Chain operations for complex transformations.\n";
