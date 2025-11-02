<?php
/**
 * FOREACH LOOPS
 * 
 * Foreach loops are designed specifically for iterating over arrays and objects.
 * Most commonly used loop type in PHP applications.
 * 
 * Use cases: Processing collections, rendering lists, data transformation.
 * 
 * Syntax:
 * - foreach ($array as $value) { ... }
 * - foreach ($array as $key => $value) { ... }
 * - foreach ($array as &$value) { ... } // By reference
 */

echo "=== FOREACH LOOPS ===\n\n";

// Real-world example: User list rendering
echo "1. User Directory Listing\n";
echo str_repeat("-", 50) . "\n";

$users = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'admin', 'active' => true],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'editor', 'active' => true],
    ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'user', 'active' => false],
    ['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice@example.com', 'role' => 'editor', 'active' => true],
];

foreach ($users as $user) {
    $status = $user['active'] ? '✓ Active' : '✗ Inactive';
    $roleIcon = match($user['role']) {
        'admin' => '👑',
        'editor' => '✏️',
        'user' => '👤',
        default => '❓'
    };
    
    echo "{$roleIcon} {$user['name']}\n";
    echo "   Email: {$user['email']}\n";
    echo "   Role: {$user['role']} | Status: $status\n\n";
}

// Real-world example: Order items processing
echo "2. E-commerce Order Processing\n";
echo str_repeat("-", 50) . "\n";

$order = [
    'order_id' => 'ORD-2024-1001',
    'customer' => 'John Doe',
    'items' => [
        ['name' => 'Wireless Mouse', 'price' => 29.99, 'qty' => 2, 'tax_rate' => 0.18],
        ['name' => 'USB Cable', 'price' => 9.99, 'qty' => 3, 'tax_rate' => 0.18],
        ['name' => 'Laptop Stand', 'price' => 49.99, 'qty' => 1, 'tax_rate' => 0.18],
    ],
    'shipping' => 15.00
];

echo "Order ID: {$order['order_id']}\n";
echo "Customer: {$order['customer']}\n";
echo str_repeat("-", 50) . "\n";

$subtotal = 0;
$totalTax = 0;

foreach ($order['items'] as $index => $item) {
    $itemTotal = $item['price'] * $item['qty'];
    $itemTax = $itemTotal * $item['tax_rate'];
    
    $subtotal += $itemTotal;
    $totalTax += $itemTax;
    
    printf("%d. %s\n", $index + 1, $item['name']);
    printf("   $%.2f x %d = $%.2f (Tax: $%.2f)\n\n", 
        $item['price'], $item['qty'], $itemTotal, $itemTax);
}

$total = $subtotal + $totalTax + $order['shipping'];

echo str_repeat("-", 50) . "\n";
printf("Subtotal:       $%8.2f\n", $subtotal);
printf("Tax:            $%8.2f\n", $totalTax);
printf("Shipping:       $%8.2f\n", $order['shipping']);
printf("Total:          $%8.2f\n\n", $total);

// Real-world example: Configuration settings
echo "3. Application Configuration Display\n";
echo str_repeat("-", 50) . "\n";

$config = [
    'app_name' => 'MyApp',
    'app_version' => '2.1.0',
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'name' => 'myapp_db',
        'charset' => 'utf8mb4'
    ],
    'cache' => [
        'driver' => 'redis',
        'ttl' => 3600,
        'prefix' => 'myapp_'
    ],
    'mail' => [
        'driver' => 'smtp',
        'host' => 'smtp.example.com',
        'port' => 587,
        'encryption' => 'tls'
    ]
];

foreach ($config as $section => $settings) {
    echo strtoupper($section) . ":\n";
    
    if (is_array($settings)) {
        foreach ($settings as $key => $value) {
            $displayKey = str_replace('_', ' ', ucfirst($key));
            echo "  $displayKey: $value\n";
        }
    } else {
        echo "  $settings\n";
    }
    echo "\n";
}

// Real-world example: Data transformation with reference
echo "4. Bulk Price Update (By Reference)\n";
echo str_repeat("-", 50) . "\n";

$products = [
    ['id' => 1, 'name' => 'Product A', 'price' => 100.00],
    ['id' => 2, 'name' => 'Product B', 'price' => 150.00],
    ['id' => 3, 'name' => 'Product C', 'price' => 200.00],
];

$increasePercentage = 10;

echo "Applying {$increasePercentage}% price increase...\n\n";
echo "Before -> After:\n";

// Using reference (&) to modify original array
foreach ($products as &$product) {
    $oldPrice = $product['price'];
    $product['price'] = $oldPrice * (1 + $increasePercentage / 100);
    
    printf("%s: $%.2f -> $%.2f\n", 
        $product['name'], $oldPrice, $product['price']);
}
unset($product); // Important: Break the reference

echo "\n";

// Real-world example: Filtering and categorizing
echo "5. Transaction Categorization\n";
echo str_repeat("-", 50) . "\n";

$transactions = [
    ['id' => 1, 'amount' => 50.00, 'type' => 'expense', 'category' => 'food'],
    ['id' => 2, 'amount' => 2000.00, 'type' => 'income', 'category' => 'salary'],
    ['id' => 3, 'amount' => 30.00, 'type' => 'expense', 'category' => 'transport'],
    ['id' => 4, 'amount' => 100.00, 'type' => 'expense', 'category' => 'food'],
    ['id' => 5, 'amount' => 500.00, 'type' => 'income', 'category' => 'freelance'],
];

$summary = [
    'total_income' => 0,
    'total_expense' => 0,
    'categories' => []
];

foreach ($transactions as $transaction) {
    if ($transaction['type'] === 'income') {
        $summary['total_income'] += $transaction['amount'];
    } else {
        $summary['total_expense'] += $transaction['amount'];
    }
    
    // Categorize
    $cat = $transaction['category'];
    if (!isset($summary['categories'][$cat])) {
        $summary['categories'][$cat] = 0;
    }
    $summary['categories'][$cat] += $transaction['amount'];
}

echo "Financial Summary:\n";
printf("Total Income:  $%.2f\n", $summary['total_income']);
printf("Total Expense: $%.2f\n", $summary['total_expense']);
printf("Net:           $%.2f\n\n", $summary['total_income'] - $summary['total_expense']);

echo "By Category:\n";
foreach ($summary['categories'] as $category => $amount) {
    printf("  %s: $%.2f\n", ucfirst($category), $amount);
}

echo "\n💡 Best Practice: Use foreach for arrays. Always unset reference variables\n";
echo "   after using &$value to prevent unexpected behavior.\n";
