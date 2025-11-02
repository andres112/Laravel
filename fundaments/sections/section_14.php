<?php
/**
 * NULL in PHP 8.0+
 * 
 * NULL is a special type representing a variable with no value.
 * Understanding NULL is crucial for proper error handling and data validation.
 * 
 * Key concepts:
 * - NULL vs empty vs false: Different meanings
 * - Null coalescing operator (??): Returns first non-null value (PHP 7+)
 * - Null safe operator (? ->): Safely access properties (PHP 8.0+)
 * - Nullsafe assignment (??=): Assign if null (PHP 7.4+)
 * 
 * Functions: isset(), empty(), is_null(), $var ?? 'default'
 * 
 * Use cases: Optional parameters, database NULL values, API responses,
 *            error handling, default value assignment.
 */

echo "=== NULL IN PHP 8.0+ ===\n\n";

// Real-world example: Understanding NULL vs other values
echo "1. NULL vs Empty vs False\n";
echo str_repeat("-", 50) . "\n";

$values = [
    'null' => null,
    'false' => false,
    'zero' => 0,
    'empty_string' => "",
    'zero_string' => "0",
    'empty_array' => [],
    'space' => " ",
];

echo "Value comparison table:\n\n";
printf("%-15s | %-8s | %-8s | %-8s | %-8s\n", "Value", "is_null", "empty", "isset", "== false");
echo str_repeat("-", 65) . "\n";

foreach ($values as $name => $value) {
    printf("%-15s | %-8s | %-8s | %-8s | %-8s\n",
        $name,
        is_null($value) ? "true" : "false",
        empty($value) ? "true" : "false",
        isset($value) ? "true" : "false",
        ($value == false) ? "true" : "false"
    );
}

echo "\n";

// Real-world example: Null coalescing operator
echo "2. Null Coalescing Operator (??)\n";
echo str_repeat("-", 50) . "\n";

// Simulating user input or API response
$userData = [
    'username' => 'johndoe',
    'email' => 'john@example.com',
    'phone' => null,
    'bio' => '',
];

// Old way (isset ternary)
$username = isset($userData['username']) ? $userData['username'] : 'Guest';
$age = isset($userData['age']) ? $userData['age'] : 'Not provided';

// New way with ?? (cleaner)
$email = $userData['email'] ?? 'no-email@example.com';
$phone = $userData['phone'] ?? 'No phone number';
$address = $userData['address'] ?? 'No address provided';

// Chain multiple ?? operators
$displayName = $userData['display_name'] ?? $userData['username'] ?? 'Guest User';

echo "User Profile:\n";
echo "  Username: $username\n";
echo "  Email: $email\n";
echo "  Phone: $phone\n";
echo "  Age: $age\n";
echo "  Address: $address\n";
echo "  Display Name: $displayName\n\n";

// Note: ?? only checks for null/undefined, not empty string
echo "⚠️  Note: ?? checks for NULL, not empty values:\n";
echo "  Bio (empty string): '" . ($userData['bio'] ?? 'default bio') . "'\n";
echo "  Bio still empty because '' is not NULL\n\n";

// Real-world example: Null coalescing assignment
echo "3. Null Coalescing Assignment (??=) PHP 7.4+\n";
echo str_repeat("-", 50) . "\n";

$config = [
    'debug' => true,
    'timeout' => null,
];

echo "Original config:\n";
print_r($config);

// Assign default values only if null or undefined
$config['debug'] ??= false;      // Won't assign (already true)
$config['timeout'] ??= 30;       // Will assign (currently null)
$config['retries'] ??= 3;        // Will assign (doesn't exist)

echo "\nAfter ??= assignment:\n";
print_r($config);
echo "\n";

// Real-world example: Nullsafe operator (PHP 8.0)
echo "4. Nullsafe Operator (?->) PHP 8.0+\n";
echo str_repeat("-", 50) . "\n";

class Address {
    public function __construct(
        public ?string $street = null,
        public ?string $city = null,
        public ?string $country = null
    ) {}
    
    public function getFullAddress(): ?string {
        if ($this->street && $this->city && $this->country) {
            return "$this->street, $this->city, $this->country";
        }
        return null;
    }
}

class User {
    public function __construct(
        public string $name,
        public ?Address $address = null
    ) {}
}

$user1 = new User('John Doe', new Address('123 Main St', 'New York', 'USA'));
$user2 = new User('Jane Smith', null);

// Old way (verbose and error-prone)
$city1 = null;
if ($user1->address !== null) {
    $city1 = $user1->address->city;
}

// New way with nullsafe operator
$city2 = $user1->address?->city;  // Returns 'New York'
$city3 = $user2->address?->city;  // Returns null (no error!)

echo "User 1:\n";
echo "  Name: {$user1->name}\n";
echo "  City: $city2\n";
echo "  Full Address: " . ($user1->address?->getFullAddress() ?? 'No address') . "\n\n";

echo "User 2:\n";
echo "  Name: {$user2->name}\n";
echo "  City: " . ($city3 ?? 'No city') . "\n";
echo "  Full Address: " . ($user2->address?->getFullAddress() ?? 'No address') . "\n\n";

// Real-world example: Database NULL handling
echo "5. Database NULL Value Handling\n";
echo str_repeat("-", 50) . "\n";

// Simulating database row
$dbRow = [
    'id' => 1,
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => null,              // NULL in database
    'last_login' => null,         // NULL in database
    'subscription_end' => '2024-12-31',
];

function formatDatabaseValue($value, $type = 'string') {
    if (is_null($value)) {
        return match($type) {
            'date' => 'Never',
            'phone' => 'Not provided',
            'email' => 'No email',
            default => 'N/A'
        };
    }
    return $value;
}

echo "Database Record:\n";
echo "  ID: {$dbRow['id']}\n";
echo "  Name: {$dbRow['name']}\n";
echo "  Email: {$dbRow['email']}\n";
echo "  Phone: " . formatDatabaseValue($dbRow['phone'], 'phone') . "\n";
echo "  Last Login: " . formatDatabaseValue($dbRow['last_login'], 'date') . "\n";
echo "  Subscription End: " . formatDatabaseValue($dbRow['subscription_end'], 'date') . "\n\n";

// Real-world example: API response with nullable fields
echo "6. API Response Handling\n";
echo str_repeat("-", 50) . "\n";

$apiResponse = [
    'status' => 'success',
    'data' => [
        'user_id' => 123,
        'username' => 'johndoe',
        'avatar_url' => null,
        'bio' => null,
        'verified' => true,
    ],
    'meta' => [
        'next_page' => null,
        'total_count' => 1,
    ]
];

echo "Processing API Response:\n";
echo "  Status: {$apiResponse['status']}\n";
echo "  User: {$apiResponse['data']['username']}\n";
echo "  Avatar: " . ($apiResponse['data']['avatar_url'] ?? 'default-avatar.png') . "\n";
echo "  Bio: " . ($apiResponse['data']['bio'] ?? 'No bio provided') . "\n";
echo "  Verified: " . ($apiResponse['data']['verified'] ? 'Yes' : 'No') . "\n";
echo "  Has Next Page: " . ($apiResponse['meta']['next_page'] !== null ? 'Yes' : 'No') . "\n\n";

// Real-world example: Form validation with null
echo "7. Form Validation & NULL\n";
echo str_repeat("-", 50) . "\n";

$formData = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '',        // Empty string, not NULL
    'age' => null,        // NULL value
    'terms' => false,     // False, not NULL
];

function validateField($name, $value, $required = true) {
    if ($required && ($value === null || $value === '')) {
        return "✗ $name is required";
    }
    
    if ($value === null || $value === '') {
        return "○ $name is optional (not provided)";
    }
    
    return "✓ $name is valid: $value";
}

echo "Form Validation:\n";
echo "  " . validateField('Name', $formData['name']) . "\n";
echo "  " . validateField('Email', $formData['email']) . "\n";
echo "  " . validateField('Phone', $formData['phone'], false) . "\n";
echo "  " . validateField('Age', $formData['age'], false) . "\n";
echo "  " . validateField('Terms', $formData['terms'] ? 'accepted' : null) . "\n\n";

// Real-world example: Array filtering with null
echo "8. Array Operations with NULL\n";
echo str_repeat("-", 50) . "\n";

$products = [
    ['id' => 1, 'name' => 'Laptop', 'price' => 999.99, 'discount' => 10],
    ['id' => 2, 'name' => 'Mouse', 'price' => 29.99, 'discount' => null],
    ['id' => 3, 'name' => 'Keyboard', 'price' => 79.99, 'discount' => 5],
    ['id' => 4, 'name' => 'Monitor', 'price' => 299.99, 'discount' => null],
];

echo "Products with discounts:\n";
$discounted = array_filter($products, fn($p) => $p['discount'] !== null);
foreach ($discounted as $product) {
    echo "  {$product['name']}: {$product['discount']}% off\n";
}

echo "\nProducts without discounts:\n";
$fullPrice = array_filter($products, fn($p) => $p['discount'] === null);
foreach ($fullPrice as $product) {
    echo "  {$product['name']}: Full price\n";
}

echo "\n💡 Best Practice: Use ?? for default values, ?-> for safe property\n";
echo "   access, and strict comparisons (=== null) for null checks.\n";
