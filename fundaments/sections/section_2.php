<?php
/**
 * CONDITIONAL STATEMENTS (IF/ELSE/ELSEIF)
 * 
 * Conditional statements allow your program to make decisions based on conditions.
 * Used extensively in: authentication, validation, business logic, access control.
 * 
 * Syntax:
 * - if (condition) { ... }
 * - if (condition) { ... } else { ... }
 * - if (condition) { ... } elseif (condition) { ... } else { ... }
 * 
 * Operators: ==, ===, !=, !==, <, >, <=, >=, &&, ||, !
 */

echo "=== CONDITIONAL STATEMENTS ===\n\n";

// Real-world example: User authentication and authorization
echo "1. User Authentication & Authorization\n";
echo str_repeat("-", 50) . "\n";

$userEmail = "admin@example.com";
$userPassword = "secure123";
$userRole = "admin";
$isEmailVerified = true;

// Authentication check
if ($userEmail && $userPassword) {
    echo "✓ User credentials provided\n";
    
    if ($isEmailVerified) {
        echo "✓ Email verified\n";
        
        // Authorization check
        if ($userRole === "admin") {
            echo "✓ Access granted: Administrator dashboard\n";
            echo "  Permissions: Full system access\n";
        } elseif ($userRole === "moderator") {
            echo "✓ Access granted: Moderator panel\n";
            echo "  Permissions: Content moderation\n";
        } elseif ($userRole === "user") {
            echo "✓ Access granted: User dashboard\n";
            echo "  Permissions: Basic features\n";
        } else {
            echo "✗ Unknown role\n";
        }
    } else {
        echo "✗ Please verify your email before logging in\n";
    }
} else {
    echo "✗ Invalid credentials\n";
}

echo "\n";

// Real-world example: E-commerce discount calculation
echo "2. E-commerce Discount System\n";
echo str_repeat("-", 50) . "\n";

$orderTotal = 250.00;
$customerType = "premium";
$isFirstOrder = false;
$hasPromoCode = true;

echo "Order Total: $" . number_format($orderTotal, 2) . "\n";
echo "Customer Type: $customerType\n";

$discount = 0;

if ($customerType === "premium") {
    $discount = 0.20; // 20% off
    echo "✓ Premium customer discount: 20%\n";
} elseif ($isFirstOrder) {
    $discount = 0.15; // 15% off
    echo "✓ First order discount: 15%\n";
} elseif ($orderTotal >= 100) {
    $discount = 0.10; // 10% off
    echo "✓ Order over $100 discount: 10%\n";
}

if ($hasPromoCode && $discount < 0.25) {
    $discount += 0.05; // Additional 5%
    echo "✓ Promo code applied: +5%\n";
}

$discountAmount = $orderTotal * $discount;
$finalTotal = $orderTotal - $discountAmount;

echo "Total Discount: " . ($discount * 100) . "%\n";
echo "Discount Amount: $" . number_format($discountAmount, 2) . "\n";
echo "Final Total: $" . number_format($finalTotal, 2) . "\n\n";

// Real-world example: Age-based content access
echo "3. Age-Based Content Access Control\n";
echo str_repeat("-", 50) . "\n";

$userAge = 16;
$hasParentalConsent = false;

echo "User Age: $userAge\n";

if ($userAge >= 18) {
    echo "✓ Full access granted\n";
    echo "  Can view: All content\n";
} elseif ($userAge >= 13 && $hasParentalConsent) {
    echo "✓ Restricted access granted\n";
    echo "  Can view: Teen-appropriate content\n";
} elseif ($userAge >= 13) {
    echo "⚠ Parental consent required\n";
    echo "  Access: Limited until consent is provided\n";
} else {
    echo "✗ Access denied\n";
    echo "  Minimum age requirement: 13 years\n";
}

echo "\n";

// Real-world example: Working hours check
echo "4. Business Hours Validation\n";
echo str_repeat("-", 50) . "\n";

$currentHour = (int)date('H'); // Current hour (0-23)
$currentDay = date('l'); // Day name (Monday, Tuesday, etc.)

echo "Current Time: " . date('H:i') . " on $currentDay\n";

if ($currentDay === "Saturday" || $currentDay === "Sunday") {
    echo "✗ Closed: Weekend\n";
    echo "  We're open Monday-Friday, 9 AM - 6 PM\n";
} elseif ($currentHour >= 9 && $currentHour < 18) {
    echo "✓ Open: We're available to help!\n";
    echo "  Business hours: 9 AM - 6 PM\n";
} elseif ($currentHour >= 18 && $currentHour < 21) {
    echo "⚠ After hours: Limited support available\n";
    echo "  Extended support: 6 PM - 9 PM\n";
} else {
    echo "✗ Closed: Outside business hours\n";
    echo "  Please visit us during business hours\n";
}

echo "\n💡 Best Practice: Use clear, descriptive conditions and organize complex\n";
echo "   logic into separate functions for better readability.\n";
