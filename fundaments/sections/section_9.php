<?php
/**
 * FUNCTIONS
 * 
 * Functions are reusable blocks of code that perform specific tasks.
 * Essential for code organization, reusability, and maintainability.
 * 
 * Key concepts:
 * - Parameters: Input values (can have default values)
 * - Return types: Specify what the function returns (PHP 7.0+)
 * - Type hints: Enforce parameter types (int, string, array, object, etc.)
 * - Variadic functions: Accept unlimited arguments (...)
 * 
 * Use cases: Data validation, calculations, formatting, database operations,
 *            API interactions, business logic encapsulation.
 */

echo "=== FUNCTIONS ===\n\n";

// Real-world example: User validation
echo "1. User Input Validation Functions\n";
echo str_repeat("-", 50) . "\n";

function validateEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validatePassword(string $password): array
{
    $errors = [];
    
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter";
    }
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least one lowercase letter";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one number";
    }
    
    return $errors;
}

function validateUsername(string $username): bool
{
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username) === 1;
}

// Test validation functions
$testEmail = "user@example.com";
$testPassword = "Secure123";
$testUsername = "john_doe_2024";

echo "Testing validation functions:\n\n";
echo "Email: $testEmail\n";
echo "  Valid: " . (validateEmail($testEmail) ? "✓ Yes" : "✗ No") . "\n\n";

echo "Password: $testPassword\n";
$passwordErrors = validatePassword($testPassword);
if (empty($passwordErrors)) {
    echo "  Valid: ✓ Yes\n\n";
} else {
    echo "  Valid: ✗ No\n";
    foreach ($passwordErrors as $error) {
        echo "    - $error\n";
    }
    echo "\n";
}

echo "Username: $testUsername\n";
echo "  Valid: " . (validateUsername($testUsername) ? "✓ Yes" : "✗ No") . "\n\n";

// Real-world example: Price calculations
echo "2. E-commerce Price Calculation Functions\n";
echo str_repeat("-", 50) . "\n";

function calculateSubtotal(array $items): float
{
    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

function calculateTax(float $amount, float $rate = 0.18): float
{
    return $amount * $rate;
}

function applyDiscount(float $amount, float $discountPercent): float
{
    return $amount * (1 - $discountPercent / 100);
}

function formatPrice(float $price, string $currency = 'USD'): string
{
    $symbol = match ($currency) {
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        default => '$'
    };
    
    return $symbol . number_format($price, 2);
}

// Test price functions
$cartItems = [
    ['name' => 'Laptop', 'price' => 999.99, 'quantity' => 1],
    ['name' => 'Mouse', 'price' => 29.99, 'quantity' => 2],
];

$subtotal = calculateSubtotal($cartItems);
$discountedSubtotal = applyDiscount($subtotal, 10); // 10% off
$tax = calculateTax($discountedSubtotal);
$total = $discountedSubtotal + $tax;

echo "Cart Calculation:\n";
echo "  Subtotal: " . formatPrice($subtotal) . "\n";
echo "  After 10% discount: " . formatPrice($discountedSubtotal) . "\n";
echo "  Tax (18%): " . formatPrice($tax) . "\n";
echo "  Total: " . formatPrice($total) . "\n\n";

// Real-world example: Date and time utilities
echo "3. Date/Time Utility Functions\n";
echo str_repeat("-", 50) . "\n";

function formatDate(string $date, string $format = 'Y-m-d'): string
{
    return date($format, strtotime($date));
}

function getTimeDifference(string $datetime): string
{
    $now = time();
    $timestamp = strtotime($datetime);
    $diff = $now - $timestamp;
    
    if ($diff < 60) {
        return "just now";
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return "$minutes minute" . ($minutes > 1 ? 's' : '') . " ago";
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return "$hours hour" . ($hours > 1 ? 's' : '') . " ago";
    } else {
        $days = floor($diff / 86400);
        return "$days day" . ($days > 1 ? 's' : '') . " ago";
    }
}

function isBusinessDay(string $date): bool
{
    $dayOfWeek = date('N', strtotime($date));
    return $dayOfWeek < 6; // Monday = 1, Sunday = 7
}

// Test date functions
$postDate = date('Y-m-d H:i:s', strtotime('-2 hours'));
$meetingDate = '2024-12-25';

echo "Post published: " . formatDate($postDate, 'F j, Y g:i A') . "\n";
echo "  Time ago: " . getTimeDifference($postDate) . "\n\n";

echo "Meeting date: $meetingDate\n";
echo "  Is business day: " . (isBusinessDay($meetingDate) ? "✓ Yes" : "✗ No") . "\n\n";

// Real-world example: String utilities
echo "4. String Manipulation Functions\n";
echo str_repeat("-", 50) . "\n";

function slugify(string $text): string
{
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function truncate(string $text, int $length = 100, string $suffix = '...'): string
{
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . $suffix;
}

function maskEmail(string $email): string
{
    $parts = explode('@', $email);
    if (count($parts) !== 2) {
        return $email;
    }
    
    $name = $parts[0];
    $domain = $parts[1];
    $nameLength = strlen($name);
    
    if ($nameLength <= 2) {
        return str_repeat('*', $nameLength) . '@' . $domain;
    }
    
    $masked = $name[0] . str_repeat('*', $nameLength - 2) . $name[$nameLength - 1];
    return $masked . '@' . $domain;
}

// Test string functions
$title = "How to Learn PHP Programming in 2024!";
$longText = "This is a very long text that needs to be truncated because it exceeds the maximum allowed length for display purposes.";
$email = "john.doe@example.com";

echo "Original title: $title\n";
echo "  Slug: " . slugify($title) . "\n\n";

echo "Long text:\n  " . truncate($longText, 50) . "\n\n";

echo "Email: $email\n";
echo "  Masked: " . maskEmail($email) . "\n\n";

// Real-world example: Variadic functions
echo "5. Variadic Functions (Variable Arguments)\n";
echo str_repeat("-", 50) . "\n";

function sum(...$numbers): float
{
    return array_sum($numbers);
}

function average(...$numbers): float
{
    if (empty($numbers)) {
        return 0;
    }
    return array_sum($numbers) / count($numbers);
}

function logMessage(string $level, string $message, ...$context): void
{
    $timestamp = date('Y-m-d H:i:s');
    echo "[$timestamp] $level: $message";
    
    if (!empty($context)) {
        echo " | Context: " . json_encode($context);
    }
    echo "\n";
}

// Test variadic functions
echo "Sum of 1, 2, 3, 4, 5: " . sum(1, 2, 3, 4, 5) . "\n";
echo "Average of 10, 20, 30, 40: " . average(10, 20, 30, 40) . "\n\n";

echo "Logging examples:\n";
logMessage('INFO', 'User logged in', ['user_id' => 123, 'ip' => '192.168.1.1']);
logMessage('ERROR', 'Database connection failed', ['host' => 'localhost', 'error' => 'timeout']);
logMessage('WARNING', 'High memory usage detected');

echo "\n� Best Practice: Use type hints and return types for better code\n";
echo "   reliability. Keep functions small and focused on a single task.\n";

// Function with strict types demonstration
if (file_exists(__DIR__ . '/../strict.php')) {
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "Strict Types Example:\n";
    include __DIR__ . '/../strict.php';
}
