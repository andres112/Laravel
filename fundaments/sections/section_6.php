<?php
/**
 * SWITCH STATEMENTS
 * 
 * Switch statements provide a clean way to handle multiple conditions based on
 * a single variable's value. Better than multiple if-elseif chains for readability.
 * 
 * Use cases: Status handling, role-based logic, API response routing, menu systems.
 * 
 * Important: Always use 'break' to prevent fall-through (unless intentional).
 * PHP 8.0+: Consider using 'match' expression for stricter type checking.
 */

echo "=== SWITCH STATEMENTS ===\n\n";

// Real-world example: Order status handling
echo "1. Order Status Management System\n";
echo str_repeat("-", 50) . "\n";

$orderStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'];

foreach ($orderStatuses as $status) {
    echo "Order Status: " . strtoupper($status) . "\n";
    
    switch ($status) {
        case 'pending':
            echo "  ⏳ Action: Waiting for payment confirmation\n";
            echo "  Next: Process payment and update inventory\n";
            break;
            
        case 'processing':
            echo "  📦 Action: Preparing items for shipment\n";
            echo "  Next: Package items and generate shipping label\n";
            break;
            
        case 'shipped':
            echo "  🚚 Action: Order is in transit\n";
            echo "  Next: Track delivery and notify customer\n";
            break;
            
        case 'delivered':
            echo "  ✅ Action: Order successfully delivered\n";
            echo "  Next: Request customer feedback\n";
            break;
            
        case 'cancelled':
            echo "  ❌ Action: Order cancelled by customer/admin\n";
            echo "  Next: Process refund if payment was made\n";
            break;
            
        case 'refunded':
            echo "  💰 Action: Refund processed\n";
            echo "  Next: Close order and update analytics\n";
            break;
            
        default:
            echo "  ❓ Action: Unknown status\n";
            echo "  Next: Log error and notify admin\n";
    }
    echo "\n";
}

// Real-world example: User role permissions
echo "2. Role-Based Access Control\n";
echo str_repeat("-", 50) . "\n";

$userRole = match (random_int(1, 5)) {
    1 => 'admin',
    2 => 'editor',
    3 => 'author',
    4 => 'subscriber',
    5 => 'guest',
};
$requestedAction = 'delete_post';

echo "User Role: $userRole\n";
echo "Requested Action: $requestedAction\n\n";

switch ($userRole) {
    case 'admin':
    case 'superadmin':
        echo "✓ Access: FULL SYSTEM ACCESS\n";
        echo "  Permissions:\n";
        echo "  - Create, Read, Update, Delete all content\n";
        echo "  - Manage users and roles\n";
        echo "  - System configuration\n";
        echo "  - View analytics and reports\n";
        break;
        
    case 'editor':
        echo "✓ Access: CONTENT MANAGEMENT\n";
        echo "  Permissions:\n";
        echo "  - Create, Read, Update content\n";
        echo "  - Publish/unpublish content\n";
        echo "  - Moderate comments\n";
        echo "  ✗ Cannot: Delete content, manage users\n";
        break;
        
    case 'author':
        echo "✓ Access: OWN CONTENT ONLY\n";
        echo "  Permissions:\n";
        echo "  - Create and edit own content\n";
        echo "  - Submit for review\n";
        echo "  ✗ Cannot: Publish, delete, or edit others' content\n";
        break;
        
    case 'subscriber':
        echo "✓ Access: READ ONLY\n";
        echo "  Permissions:\n";
        echo "  - View published content\n";
        echo "  - Comment on posts\n";
        echo "  - Manage own profile\n";
        break;
        
    default:
        echo "✗ Access: GUEST (Limited)\n";
        echo "  Permissions:\n";
        echo "  - View public content only\n";
}

echo "\n";

// Real-world example: Payment gateway routing
echo "3. Payment Gateway Routing\n";
echo str_repeat("-", 50) . "\n";

$paymentMethod = match (random_int(1, 4)) {
    1 => 'credit_card',
    2 => 'paypal',
    3 => 'bank_transfer',
    4 => 'cryptocurrency',
};
$amount = 150.00;

echo "Payment Method: $paymentMethod\n";
echo "Amount: $" . number_format($amount, 2) . "\n\n";

switch ($paymentMethod) {
    case 'credit_card':
    case 'debit_card':
        echo "Processing card payment...\n";
        echo "  Gateway: Stripe\n";
        echo "  Processing Fee: 2.9% + $0.30\n";
        $fee = ($amount * 0.029) + 0.30;
        echo "  Fee Amount: $" . number_format($fee, 2) . "\n";
        echo "  Total Charge: $" . number_format($amount + $fee, 2) . "\n";
        break;
        
    case 'paypal':
        echo "Processing PayPal payment...\n";
        echo "  Gateway: PayPal\n";
        echo "  Processing Fee: 3.5%\n";
        $fee = $amount * 0.035;
        echo "  Fee Amount: $" . number_format($fee, 2) . "\n";
        echo "  Total Charge: $" . number_format($amount + $fee, 2) . "\n";
        break;
        
    case 'bank_transfer':
        echo "Processing bank transfer...\n";
        echo "  Gateway: Direct Bank Transfer\n";
        echo "  Processing Fee: $2.00 flat\n";
        $fee = 2.00;
        echo "  Fee Amount: $" . number_format($fee, 2) . "\n";
        echo "  Note: Payment may take 2-3 business days\n";
        break;
        
    case 'cryptocurrency':
        echo "Processing crypto payment...\n";
        echo "  Gateway: Coinbase Commerce\n";
        echo "  Processing Fee: 1%\n";
        $fee = $amount * 0.01;
        echo "  Fee Amount: $" . number_format($fee, 2) . "\n";
        echo "  Note: Subject to price volatility\n";
        break;
        
    default:
        echo "✗ Error: Payment method not supported\n";
        echo "  Supported methods: Credit Card, PayPal, Bank Transfer, Cryptocurrency\n";
}

echo "\n";

// Real-world example: HTTP status code handling
echo "4. HTTP Response Handler\n";
echo str_repeat("-", 50) . "\n";

$httpStatusCode = match (random_int(1, 8)) {
    1 => 200,
    2 => 201,
    3 => 400,
    4 => 401,
    5 => 403,
    6 => 404,
    7 => 500,
    8 => 503,
};

echo "HTTP Status Code: $httpStatusCode\n";

switch ($httpStatusCode) {
    case 200:
        echo "✓ OK - Request successful\n";
        echo "  Action: Return requested data\n";
        break;
        
    case 201:
        echo "✓ Created - Resource created successfully\n";
        echo "  Action: Return new resource with location header\n";
        break;
        
    case 400:
        echo "✗ Bad Request - Invalid request format\n";
        echo "  Action: Return error details to client\n";
        break;
        
    case 401:
        echo "✗ Unauthorized - Authentication required\n";
        echo "  Action: Redirect to login page\n";
        break;
        
    case 403:
        echo "✗ Forbidden - Insufficient permissions\n";
        echo "  Action: Display access denied message\n";
        break;
        
    case 404:
        echo "✗ Not Found - Resource doesn't exist\n";
        echo "  Action: Show 404 page or suggest alternatives\n";
        break;
        
    case 500:
        echo "✗ Internal Server Error - Server malfunction\n";
        echo "  Action: Log error, show generic error page\n";
        break;
        
    case 503:
        echo "✗ Service Unavailable - Server overloaded/maintenance\n";
        echo "  Action: Show maintenance page\n";
        break;
        
    default:
        echo "❓ Status code not specifically handled\n";
        echo "  Action: Use generic response handler\n";
}

echo "\n💡 Best Practice: Use switch for 3+ conditions on the same variable.\n";
echo "   For complex logic or type safety, consider PHP 8.0+ match expression.\n";
