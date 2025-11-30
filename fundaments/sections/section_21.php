<?php
/**
 * ARRAYS & ARRAY MANIPULATION
 * 
 * Arrays are fundamental data structures in PHP used to store collections of data.
 * PHP arrays are versatile and can function as lists, maps, stacks, queues, and more.
 * 
 * Array types:
 * - Indexed arrays: Numeric keys (0, 1, 2, ...)
 * - Associative arrays: String keys (key-value pairs)
 * - Multidimensional arrays: Arrays containing arrays
 * 
 * Common operations:
 * - Creation and modification: [], array(), spread operator (...)
 * - Sorting: sort(), asort(), ksort(), usort()
 * - Transformation: array_map(), array_filter(), array_reduce()
 * - Manipulation: array_merge(), array_slice(), array_splice()
 * - Searching: in_array(), array_search(), array_key_exists()
 * - Set operations: array_intersect(), array_diff(), array_unique()
 * 
 * Real-world uses: Data collections, configuration, caching, API responses,
 * database results, form data processing, shopping carts, user permissions.
 * 
 * Best practices: Use descriptive keys, validate data, consider memory usage
 * for large arrays, prefer specific array functions over loops when possible.
 */

echo "=== ARRAYS & ARRAY MANIPULATION ===\n\n";

// Real-world example: User profile management
echo "1. User Profile Management\n";
echo str_repeat("-", 50) . "\n";

// Associative array for user data
$userProfile = [
    "first" => "John",
    "last" => "Doe",
    "age" => 30,
    "city" => "New York"
];

// Adding new information to profile
$userProfile["country"] = "USA";
$userProfile["email"] = "john.doe@example.com";

echo "User Profile:\n";
foreach ($userProfile as $key => $value) {
    echo "  " . ucfirst($key) . ": $value\n";
}
echo "\n";

// Verify profile completeness
$requiredFields = ["first", "last", "email", "country"];
$missingFields = array_diff($requiredFields, array_keys($userProfile));

if (empty($missingFields)) {
    echo "✓ Profile is complete\n";
} else {
    echo "✗ Missing fields: " . implode(", ", $missingFields) . "\n";
}
echo "\n";

// Real-world example: Product inventory matrix
echo "2. Product Inventory Grid\n";
echo str_repeat("-", 50) . "\n";

// Multidimensional array representing inventory by location
$inventory = [
    ['Laptop', 'Electronics', 15],  // [Product, Category, Quantity]
    ['Mouse', 'Electronics', 45],
    ['Desk', 'Furniture', 8]
];

echo "Inventory Report:\n";
foreach ($inventory as $index => $item) {
    [$product, $category, $quantity] = $item;
    $status = $quantity > 20 ? '✓ In Stock' : '⚠ Low Stock';
    echo "  " . ($index + 1) . ". $product ($category): $quantity units - $status\n";
}

// Access specific inventory item
echo "\nChecking item at position [1][2] (Mouse quantity): " . $inventory[1][2] . " units\n\n";

// Real-world example: CSV import processing
echo "3. CSV Data Import & Processing\n";
echo str_repeat("-", 50) . "\n";

$csvData = "apple, banana, cherry, date, elderberry";
$fruits = explode(", ", $csvData);

echo "Imported fruits from CSV:\n";
foreach ($fruits as $index => $fruit) {
    echo "  " . ($index + 1) . ". " . ucfirst($fruit) . "\n";
}

// Array destructuring for quick access
[$firstFruit, , $thirdFruit] = $fruits;
echo "\nQuick access: First = $firstFruit, Third = $thirdFruit\n\n";

// Real-world example: Sorting customer data
echo "4. Customer Data Sorting\n";
echo str_repeat("-", 50) . "\n";

$customer = [
    "name" => "Alice Johnson",
    "email" => "alice@example.com",
    "age" => 28,
    "city" => "Boston"
];

echo "Original customer data:\n";
print_r($customer);

// Sort by values (alphabetically)
$sortedByValue = $customer;
asort($sortedByValue);
echo "\nSorted by values (asort):\n";
print_r($sortedByValue);

// Sort by keys (alphabetically)
$sortedByKey = $customer;
ksort($sortedByKey);
echo "\nSorted by keys (ksort):\n";
print_r($sortedByKey);

echo "\n";

// Real-world example: Sales analytics
echo "5. Sales Analytics & Calculations\n";
echo str_repeat("-", 50) . "\n";

$monthlySales = range(1000, 10000, 1000); // [1000, 2000, ..., 10000]

echo "Monthly sales data:\n";
echo "  Sales: " . implode(", ", array_map(fn($n) => '$' . number_format($n), $monthlySales)) . "\n";

// Calculate squared values for statistical analysis
$salesSquared = array_map(fn($n) => $n * $n, $monthlySales);
echo "  Squared values (for variance): " . implode(", ", array_slice($salesSquared, 0, 3)) . "...\n";

// Filter high-performing months (even months for demo)
$highPerformingMonths = array_filter($monthlySales, fn($n) => $n % 2000 === 0);
echo "  High-performing months: $" . implode(", $", $highPerformingMonths) . "\n";

// Calculate total revenue
$totalRevenue = array_reduce($monthlySales, fn($carry, $n) => $carry + $n, 0);
$averageRevenue = $totalRevenue / count($monthlySales);
echo "  Total Revenue: $" . number_format($totalRevenue) . "\n";
echo "  Average Revenue: $" . number_format($averageRevenue) . "\n";

// Extend sales data with projections
$extendedSales = [0, ...$monthlySales, 11000, 12000];
echo "  Extended with projections: " . count($extendedSales) . " months\n\n";

// Real-world example: Feature comparison matrix
echo "6. Product Feature Comparison\n";
echo str_repeat("-", 50) . "\n";

$basicFeatures = ['email', 'storage', 'support', 'analytics', 'api'];
$premiumFeatures = ['analytics', 'api', 'priority-support', 'custom-domain', 'white-label'];

echo "Plan Features:\n";
echo "  Basic Plan: " . implode(", ", $basicFeatures) . "\n";
echo "  Premium Plan: " . implode(", ", $premiumFeatures) . "\n\n";

// Features in both plans
$commonFeatures = array_intersect($basicFeatures, $premiumFeatures);
echo "Common features: " . implode(", ", $commonFeatures) . "\n";

// Features exclusive to each plan
$basicOnly = array_diff($basicFeatures, $premiumFeatures);
$premiumOnly = array_diff($premiumFeatures, $basicFeatures);
echo "Basic plan exclusives: " . implode(", ", $basicOnly) . "\n";
echo "Premium plan exclusives: " . implode(", ", $premiumOnly) . "\n\n";

// Real-world example: Configuration management
echo "7. Application Configuration Management\n";
echo str_repeat("-", 50) . "\n";

$defaultConfig = [
    "app_name" => "MyApp",
    "debug" => false,
    "timezone" => "UTC",
    "language" => "en"
];

$userConfig = [
    "timezone" => "America/New_York",
    "theme" => "dark",
    "notifications" => true
];

// Merge configurations (user config overrides defaults)
$finalConfig = array_merge($defaultConfig, $userConfig);

echo "Final application configuration:\n";
foreach ($finalConfig as $key => $value) {
    $displayValue = is_bool($value) ? ($value ? 'true' : 'false') : $value;
    echo "  $key: $displayValue\n";
}

echo "\nConfiguration checks:\n";
echo "  Has 'debug' setting? " . (array_key_exists("debug", $finalConfig) ? 'Yes' : 'No') . "\n";
echo "  Dark theme enabled? " . (in_array("dark", $finalConfig) ? 'Yes' : 'No') . "\n\n";

// Real-world example: Tag management system
echo "8. Tag Management & Deduplication\n";
echo str_repeat("-", 50) . "\n";

$article1Tags = ['php', 'web', 'backend', 'tutorial', 'php'];
$article2Tags = ['web', 'frontend', 'javascript', 'tutorial'];

// Combine all tags
$allTags = array_merge($article1Tags, $article2Tags);
echo "All tags (with duplicates): " . implode(", ", $allTags) . "\n";

// Remove duplicates
$uniqueTags = array_unique($allTags);
echo "Unique tags: " . implode(", ", $uniqueTags) . "\n";

// Get specific tag subset
$featuredTags = array_slice($uniqueTags, 0, 4);
echo "Featured tags (first 4): " . implode(", ", $featuredTags) . "\n";

// Find position of specific tag
$searchTag = "tutorial";
$position = array_search($searchTag, $uniqueTags);
echo "Position of '$searchTag': " . ($position !== false ? $position : 'Not found') . "\n\n";

// Real-world example: User permissions system
echo "9. User Permissions & Role Management\n";
echo str_repeat("-", 50) . "\n";

$adminPermissions = ['read', 'write', 'delete', 'manage-users', 'manage-settings'];
$editorPermissions = ['read', 'write', 'publish'];
$viewerPermissions = ['read'];

$currentUser = [
    "name" => "John Doe",
    "role" => "editor",
    "permissions" => $editorPermissions
];

// Extract permission information
$permissionKeys = array_keys($currentUser);
$permissionValues = array_values($currentUser["permissions"]);

echo "User: {$currentUser['name']}\n";
echo "Role: {$currentUser['role']}\n";
echo "Permissions: " . implode(", ", $currentUser["permissions"]) . "\n";
echo "User data keys: " . implode(", ", $permissionKeys) . "\n";

// Check specific permissions
$canDelete = in_array("delete", $currentUser["permissions"]);
$canPublish = in_array("publish", $currentUser["permissions"]);

echo "\nPermission checks:\n";
echo "  Can delete? " . ($canDelete ? 'Yes' : 'No') . "\n";
echo "  Can publish? " . ($canPublish ? 'Yes' : 'No') . "\n";