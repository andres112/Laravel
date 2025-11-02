<?php
/**
 * NAMED ARGUMENTS (PHP 8.0+)
 * 
 * Named arguments allow passing values to a function by specifying the parameter
 * name rather than relying on parameter position.
 * 
 * Benefits:
 * - Skip optional parameters easily
 * - Self-documenting code (parameter names visible at call site)
 * - Order-independent (can specify parameters in any order)
 * - Better readability for functions with many parameters
 * 
 * Use cases: Functions with optional parameters, configuration objects,
 *            builder patterns, improving code clarity.
 */

echo "=== NAMED ARGUMENTS (PHP 8.0+) ===\n\n";

// Real-world example: Database query builder
echo "1. Database Query Builder\n";
echo str_repeat("-", 50) . "\n";

function buildQuery(
    string $table,
    array $columns = ['*'],
    ?string $where = null,
    ?string $orderBy = null,
    ?int $limit = null,
    int $offset = 0
): string {
    $sql = "SELECT " . implode(', ', $columns) . " FROM $table";
    
    if ($where) {
        $sql .= " WHERE $where";
    }
    
    if ($orderBy) {
        $sql .= " ORDER BY $orderBy";
    }
    
    if ($limit) {
        $sql .= " LIMIT $limit";
    }
    
    if ($offset > 0) {
        $sql .= " OFFSET $offset";
    }
    
    return $sql . ";";
}

// Old way: Must pass all parameters in order
$query1 = buildQuery('users', ['id', 'name'], null, 'name ASC', 10, 0);
echo "Positional arguments (old way):\n";
echo "  $query1\n\n";

// New way: Named arguments (cleaner and clearer)
$query2 = buildQuery(
    table: 'users',
    columns: ['id', 'name', 'email'],
    orderBy: 'created_at DESC',
    limit: 20
);
echo "Named arguments (new way):\n";
echo "  $query2\n\n";

// Can skip optional parameters easily
$query3 = buildQuery(
    table: 'products',
    where: 'price > 100',
    limit: 5
);
echo "Skipping optional parameters:\n";
echo "  $query3\n\n";

// Real-world example: Email sending function
echo "2. Email Configuration\n";
echo str_repeat("-", 50) . "\n";

function sendEmail(
    string $to,
    string $subject,
    string $body,
    ?string $from = 'noreply@example.com',
    array $cc = [],
    array $bcc = [],
    bool $isHtml = false,
    int $priority = 3,
    array $attachments = []
): array {
    return [
        'to' => $to,
        'subject' => $subject,
        'from' => $from,
        'cc' => $cc,
        'bcc' => $bcc,
        'html' => $isHtml,
        'priority' => $priority,
        'attachments' => count($attachments),
        'status' => 'queued'
    ];
}

// Simple email
$email1 = sendEmail(
    to: 'user@example.com',
    subject: 'Welcome!',
    body: 'Thank you for signing up.'
);

echo "Simple email:\n";
echo "  To: {$email1['to']}\n";
echo "  Subject: {$email1['subject']}\n";
echo "  From: {$email1['from']}\n";
echo "  Status: {$email1['status']}\n\n";

// Complex email with many options
$email2 = sendEmail(
    to: 'customer@example.com',
    subject: 'Order Confirmation',
    body: '<h1>Your order has been received</h1>',
    from: 'orders@shop.com',
    cc: ['manager@shop.com'],
    isHtml: true,
    priority: 1,
    attachments: ['invoice.pdf', 'receipt.pdf']
);

echo "Complex email:\n";
echo "  To: {$email2['to']}\n";
echo "  Subject: {$email2['subject']}\n";
echo "  From: {$email2['from']}\n";
echo "  CC: " . implode(', ', $email2['cc']) . "\n";
echo "  HTML: " . ($email2['html'] ? 'Yes' : 'No') . "\n";
echo "  Priority: {$email2['priority']}\n";
echo "  Attachments: {$email2['attachments']}\n";
echo "  Status: {$email2['status']}\n\n";

// Real-world example: Logger configuration
echo "3. Flexible Logger\n";
echo str_repeat("-", 50) . "\n";

function log(
    string $message,
    string $level = 'info',
    string $channel = 'app',
    array $context = [],
    bool $sendToSlack = false,
    bool $sendEmail = false
): void {
    $timestamp = date('Y-m-d H:i:s');
    $levelEmoji = match($level) {
        'error' => '❌',
        'warning' => '⚠️',
        'info' => 'ℹ️',
        'debug' => '🐛',
        default => '📝'
    };
    
    echo "[$timestamp] $levelEmoji [$channel] $level: $message\n";
    
    if (!empty($context)) {
        echo "  Context: " . json_encode($context) . "\n";
    }
    
    if ($sendToSlack) {
        echo "  📱 Sent to Slack\n";
    }
    
    if ($sendEmail) {
        echo "  📧 Sent via email\n";
    }
}

echo "Logging examples:\n\n";

// Simple log
log(message: 'User logged in');

echo "\n";

// Warning with context
log(
    message: 'High memory usage detected',
    level: 'warning',
    context: ['memory' => '512MB', 'threshold' => '400MB']
);

echo "\n";

// Critical error with notifications
log(
    message: 'Database connection failed',
    level: 'error',
    channel: 'database',
    context: ['host' => 'localhost', 'error' => 'timeout'],
    sendToSlack: true,
    sendEmail: true
);

echo "\n";

// Real-world example: HTML element builder
echo "4. HTML Element Builder\n";
echo str_repeat("-", 50) . "\n";

function button(
    string $text,
    string $type = 'button',
    string $class = 'btn',
    bool $disabled = false,
    ?string $onclick = null,
    array $dataAttributes = []
): string {
    $html = "<button type=\"$type\" class=\"$class\"";
    
    if ($disabled) {
        $html .= " disabled";
    }
    
    if ($onclick) {
        $html .= " onclick=\"$onclick\"";
    }
    
    foreach ($dataAttributes as $key => $value) {
        $html .= " data-$key=\"$value\"";
    }
    
    $html .= ">$text</button>";
    
    return $html;
}

echo "HTML Buttons:\n\n";

// Primary button
$btn1 = button(
    text: 'Submit Form',
    type: 'submit',
    class: 'btn btn-primary'
);
echo "$btn1\n\n";

// Disabled button
$btn2 = button(
    text: 'Processing...',
    disabled: true,
    class: 'btn btn-secondary'
);
echo "$btn2\n\n";

// Button with data attributes
$btn3 = button(
    text: 'Delete Item',
    type: 'button',
    class: 'btn btn-danger',
    onclick: 'confirmDelete()',
    dataAttributes: ['id' => '123', 'action' => 'delete']
);
echo "$btn3\n\n";

// Real-world example: API request configuration
echo "5. API Request Builder\n";
echo str_repeat("-", 50) . "\n";

function apiRequest(
    string $endpoint,
    string $method = 'GET',
    array $data = [],
    array $headers = [],
    int $timeout = 30,
    bool $verifySSL = true,
    int $retries = 0
): array {
    return [
        'method' => $method,
        'url' => "https://api.example.com/$endpoint",
        'data' => $data,
        'headers' => array_merge(['Content-Type' => 'application/json'], $headers),
        'timeout' => $timeout,
        'verify_ssl' => $verifySSL,
        'retries' => $retries
    ];
}

// Simple GET request
$request1 = apiRequest(endpoint: 'users');

echo "GET Request:\n";
echo "  Method: {$request1['method']}\n";
echo "  URL: {$request1['url']}\n\n";

// Complex POST request
$request2 = apiRequest(
    endpoint: 'orders',
    method: 'POST',
    data: ['product_id' => 123, 'quantity' => 2],
    headers: ['Authorization' => 'Bearer token123'],
    timeout: 60,
    retries: 3
);

echo "POST Request:\n";
echo "  Method: {$request2['method']}\n";
echo "  URL: {$request2['url']}\n";
echo "  Data: " . json_encode($request2['data']) . "\n";
echo "  Timeout: {$request2['timeout']}s\n";
echo "  Retries: {$request2['retries']}\n\n";

// Real-world example: Report generation
echo "6. Report Generator\n";
echo str_repeat("-", 50) . "\n";

function generateReport(
    string $type,
    string $startDate,
    string $endDate,
    array $filters = [],
    string $format = 'pdf',
    bool $includeCharts = true,
    bool $includeRawData = false,
    string $orientation = 'portrait'
): void {
    echo "Generating $format report ($orientation):\n";
    echo "  Type: $type\n";
    echo "  Period: $startDate to $endDate\n";
    echo "  Format: " . strtoupper($format) . "\n";
    echo "  Charts: " . ($includeCharts ? 'Yes' : 'No') . "\n";
    echo "  Raw Data: " . ($includeRawData ? 'Yes' : 'No') . "\n";
    
    if (!empty($filters)) {
        echo "  Filters: " . json_encode($filters) . "\n";
    }
}

echo "Sales Report:\n";
generateReport(
    type: 'sales',
    startDate: '2024-01-01',
    endDate: '2024-12-31',
    filters: ['region' => 'North America', 'product_category' => 'Electronics'],
    includeCharts: true,
    orientation: 'landscape'
);

echo "\n💡 Best Practice: Use named arguments for functions with many optional\n";
echo "   parameters to improve code readability and maintainability.\n";
