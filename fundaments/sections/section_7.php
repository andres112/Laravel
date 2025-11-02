<?php
/**
 * MATCH EXPRESSION (PHP 8.0+)
 * 
 * Match is a modern alternative to switch with strict comparison (===).
 * Unlike switch, match is an expression that returns a value directly.
 * 
 * Key differences from switch:
 * - Strict comparison (===) instead of loose (==)
 * - Returns a value (no break needed)
 * - No fall-through between cases
 * - Throws UnhandledMatchError if no case matches (unless default exists)
 * 
 * Use cases: Value mapping, status translation, configuration selection.
 */

echo "=== MATCH EXPRESSION (PHP 8.0+) ===\n\n";

// Real-world example: HTTP status code messages
echo "1. HTTP Status Code Message Mapper\n";
echo str_repeat("-", 50) . "\n";

$statusCodes = [200, 201, 400, 401, 403, 404, 500, 503];

foreach ($statusCodes as $code) {
    $message = match ($code) {
        200 => "OK - Request successful",
        201 => "Created - Resource created",
        204 => "No Content - Successful with no response body",
        400 => "Bad Request - Invalid syntax",
        401 => "Unauthorized - Authentication required",
        403 => "Forbidden - No permission",
        404 => "Not Found - Resource doesn't exist",
        500 => "Internal Server Error - Server error",
        502 => "Bad Gateway - Invalid response",
        503 => "Service Unavailable - Server overloaded",
        default => "Unknown Status Code"
    };
    
    $icon = match (true) {
        $code >= 200 && $code < 300 => "✓",
        $code >= 400 && $code < 500 => "⚠",
        $code >= 500 => "✗",
        default => "❓"
    };
    
    echo "$icon $code: $message\n";
}

echo "\n";

// Real-world example: User role badge assignment
echo "2. User Role Badge System\n";
echo str_repeat("-", 50) . "\n";

$users = [
    ['name' => 'Alice', 'role' => 'admin', 'level' => 10],
    ['name' => 'Bob', 'role' => 'moderator', 'level' => 7],
    ['name' => 'Charlie', 'role' => 'user', 'level' => 3],
    ['name' => 'Diana', 'role' => 'premium', 'level' => 5],
];

foreach ($users as $user) {
    // Role-based badge
    $badge = match ($user['role']) {
        'admin' => '👑 Administrator',
        'moderator' => '🛡️ Moderator',
        'premium' => '⭐ Premium Member',
        'user' => '👤 Member',
        default => '❓ Unknown'
    };
    
    // Level-based tier
    $tier = match (true) {
        $user['level'] >= 10 => 'Elite',
        $user['level'] >= 7 => 'Advanced',
        $user['level'] >= 4 => 'Intermediate',
        default => 'Beginner'
    };
    
    echo "{$user['name']}: $badge (Level {$user['level']} - $tier)\n";
}

echo "\n";

// Real-world example: File extension to MIME type
echo "3. File Type Detection\n";
echo str_repeat("-", 50) . "\n";

$files = [
    'document.pdf',
    'image.jpg',
    'video.mp4',
    'archive.zip',
    'script.js',
    'stylesheet.css',
    'data.json',
];

foreach ($files as $filename) {
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    $mimeType = match ($extension) {
        'jpg', 'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'pdf' => 'application/pdf',
        'doc', 'docx' => 'application/msword',
        'xls', 'xlsx' => 'application/vnd.ms-excel',
        'zip' => 'application/zip',
        'mp4' => 'video/mp4',
        'mp3' => 'audio/mpeg',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'html' => 'text/html',
        default => 'application/octet-stream'
    };
    
    $category = match ($extension) {
        'jpg', 'jpeg', 'png', 'gif', 'svg' => '🖼️ Image',
        'mp4', 'avi', 'mov' => '🎥 Video',
        'mp3', 'wav', 'ogg' => '🎵 Audio',
        'pdf', 'doc', 'docx', 'txt' => '📄 Document',
        'zip', 'rar', '7z' => '📦 Archive',
        'js', 'css', 'html', 'php' => '💻 Code',
        default => '📎 Other'
    };
    
    echo "$category $filename\n";
    echo "  MIME Type: $mimeType\n\n";
}

// Real-world example: Pricing tier calculation
echo "4. Subscription Pricing Calculator\n";
echo str_repeat("-", 50) . "\n";

$plans = ['basic', 'pro', 'enterprise'];
$billingCycles = ['monthly', 'yearly'];

foreach ($plans as $plan) {
    foreach ($billingCycles as $cycle) {
        // Calculate price based on plan and billing cycle
        $basePrice = match ($plan) {
            'basic' => 9.99,
            'pro' => 29.99,
            'enterprise' => 99.99,
            default => 0
        };
        
        $discount = match ($cycle) {
            'yearly' => 0.20,  // 20% off for yearly
            'monthly' => 0,
            default => 0
        };
        
        $price = $basePrice * (1 - $discount);
        
        if ($cycle === 'yearly') {
            $price *= 12;
        }
        
        $planName = match ($plan) {
            'basic' => 'Basic Plan',
            'pro' => 'Professional Plan',
            'enterprise' => 'Enterprise Plan',
            default => 'Unknown Plan'
        };
        
        $features = match ($plan) {
            'basic' => ['5 Projects', '5 GB Storage', 'Email Support'],
            'pro' => ['Unlimited Projects', '100 GB Storage', 'Priority Support', 'API Access'],
            'enterprise' => ['Unlimited Everything', '1 TB Storage', '24/7 Support', 'Dedicated Manager'],
            default => []
        };
        
        $billingLabel = $cycle === 'yearly' ? 'per year' : 'per month';
        $savingsLabel = $discount > 0 ? " (Save " . ($discount * 100) . "%)" : "";
        
        echo "$planName - " . ucfirst($cycle) . ":\n";
        echo "  Price: $" . number_format($price, 2) . " $billingLabel$savingsLabel\n";
        echo "  Features: " . implode(', ', $features) . "\n\n";
    }
}

// Real-world example: Error severity classification
echo "5. Error Severity Handler\n";
echo str_repeat("-", 50) . "\n";

$errors = [
    E_ERROR,
    E_WARNING,
    E_NOTICE,
    E_DEPRECATED,
];

foreach ($errors as $errorType) {
    $severity = match ($errorType) {
        E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR => 'CRITICAL',
        E_WARNING, E_CORE_WARNING, E_COMPILE_WARNING, E_USER_WARNING => 'WARNING',
        E_NOTICE, E_USER_NOTICE => 'NOTICE',
        E_DEPRECATED, E_USER_DEPRECATED => 'DEPRECATED',
        default => 'UNKNOWN'
    };
    
    $action = match ($severity) {
        'CRITICAL' => 'Stop execution, log error, notify admin',
        'WARNING' => 'Continue execution, log warning',
        'NOTICE' => 'Continue execution, log if debug mode',
        'DEPRECATED' => 'Continue execution, schedule code update',
        default => 'Log and continue'
    };
    
    $errorName = match ($errorType) {
        E_ERROR => 'E_ERROR',
        E_WARNING => 'E_WARNING',
        E_NOTICE => 'E_NOTICE',
        E_DEPRECATED => 'E_DEPRECATED',
        default => 'UNKNOWN'
    };
    
    echo "$errorName:\n";
    echo "  Severity: $severity\n";
    echo "  Action: $action\n\n";
}

echo "💡 Best Practice: Use match for clean, type-safe value mapping.\n";
echo "   Prefer match over switch when you need to return a value directly.\n";
