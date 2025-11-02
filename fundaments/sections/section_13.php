<?php
/**
 * VARIABLE SCOPE IN PHP
 * 
 * Variable scope determines where a variable can be accessed in your code.
 * PHP has three main scopes: local, global, and static.
 * 
 * Scope types:
 * - Local: Variables inside functions (default)
 * - Global: Variables outside functions (accessible with 'global' keyword or $GLOBALS)
 * - Static: Variables that retain their value between function calls
 * - Function parameters: Always local to the function
 * 
 * Use cases: State management, counters, configuration, singleton patterns.
 */

echo "=== VARIABLE SCOPE ===\n\n";

// Real-world example: Local vs Global scope
echo "1. Local vs Global Scope\n";
echo str_repeat("-", 50) . "\n";

$appName = "MyApp";  // Global scope
$version = "1.0.0";  // Global scope

function displayAppInfo() {
    // These are local variables
    $appName = "LocalApp";
    $status = "running";
    
    echo "Inside function (local scope):\n";
    echo "  App Name: $appName\n";
    echo "  Status: $status\n";
}

echo "Outside function (global scope):\n";
echo "  App Name: $appName\n";
echo "  Version: $version\n\n";

displayAppInfo();

echo "\nBack in global scope:\n";
echo "  App Name: $appName (unchanged)\n\n";

// Real-world example: Accessing global variables
echo "2. Accessing Global Variables\n";
echo str_repeat("-", 50) . "\n";

$dbHost = "localhost";
$dbName = "myapp_db";
$dbUser = "root";

// Method 1: Using 'global' keyword
function connectDatabase1() {
    global $dbHost, $dbName, $dbUser;
    echo "Method 1 (global keyword):\n";
    echo "  Connecting to: $dbUser@$dbHost/$dbName\n";
}

// Method 2: Using $GLOBALS array (preferred)
function connectDatabase2() {
    echo "Method 2 (\$GLOBALS array):\n";
    echo "  Connecting to: {$GLOBALS['dbUser']}@{$GLOBALS['dbHost']}/{$GLOBALS['dbName']}\n";
}

// Method 3: Passing as parameters (best practice)
function connectDatabase3($host, $database, $user) {
    echo "Method 3 (parameters - BEST):\n";
    echo "  Connecting to: $user@$host/$database\n";
}

connectDatabase1();
echo "\n";
connectDatabase2();
echo "\n";
connectDatabase3($dbHost, $dbName, $dbUser);

echo "\n💡 Best Practice: Pass variables as parameters instead of using global.\n\n";

// Real-world example: Static variables for state
echo "3. Static Variables - Request Counter\n";
echo str_repeat("-", 50) . "\n";

function handleRequest($endpoint) {
    static $requestCount = 0;
    static $requestLog = [];
    
    $requestCount++;
    $requestLog[] = $endpoint;
    
    echo "Request #$requestCount: $endpoint\n";
    echo "  Total requests: $requestCount\n";
    echo "  History: " . implode(', ', $requestLog) . "\n\n";
}

echo "Simulating API requests:\n\n";
handleRequest('/api/users');
handleRequest('/api/products');
handleRequest('/api/orders');
handleRequest('/api/users');

// Real-world example: Singleton pattern with static
echo "4. Singleton Pattern (Configuration Manager)\n";
echo str_repeat("-", 50) . "\n";

class ConfigManager {
    private static $instance = null;
    private $config = [];
    
    private function __construct() {
        // Private constructor prevents direct instantiation
        $this->config = [
            'app_name' => 'MyApp',
            'debug' => true,
            'timezone' => 'UTC'
        ];
    }
    
    public static function getInstance(): self {
        if (self::$instance === null) {
            echo "  Creating new ConfigManager instance\n";
            self::$instance = new self();
        } else {
            echo "  Using existing ConfigManager instance\n";
        }
        return self::$instance;
    }
    
    public function get(string $key) {
        return $this->config[$key] ?? null;
    }
    
    public function set(string $key, $value): void {
        $this->config[$key] = $value;
    }
}

echo "First call:\n";
$config1 = ConfigManager::getInstance();
echo "  App Name: " . $config1->get('app_name') . "\n\n";

echo "Second call:\n";
$config2 = ConfigManager::getInstance();
echo "  Debug Mode: " . ($config2->get('debug') ? 'enabled' : 'disabled') . "\n\n";

echo "Modifying config:\n";
$config1->set('app_name', 'UpdatedApp');
echo "  Changed via \$config1\n";
echo "  Reading from \$config2: " . $config2->get('app_name') . " (same instance!)\n\n";

// Real-world example: Function call counter
echo "5. Function Call Analytics\n";
echo str_repeat("-", 50) . "\n";

function trackableFunction($action) {
    static $analytics = [
        'total_calls' => 0,
        'actions' => []
    ];
    
    $analytics['total_calls']++;
    
    if (!isset($analytics['actions'][$action])) {
        $analytics['actions'][$action] = 0;
    }
    $analytics['actions'][$action]++;
    
    echo "Action: $action\n";
    echo "  This action called: {$analytics['actions'][$action]} time(s)\n";
    echo "  Total function calls: {$analytics['total_calls']}\n\n";
}

echo "Tracking function calls:\n\n";
trackableFunction('login');
trackableFunction('view_profile');
trackableFunction('login');
trackableFunction('logout');
trackableFunction('login');

// Real-world example: Cache within function
echo "6. Function-Level Caching\n";
echo str_repeat("-", 50) . "\n";

function fetchUserData($userId) {
    static $cache = [];
    
    if (isset($cache[$userId])) {
        echo "  [CACHE HIT] User ID $userId\n";
        return $cache[$userId];
    }
    
    echo "  [CACHE MISS] Fetching user ID $userId from database...\n";
    // Simulate database fetch
    usleep(10000); // 10ms delay
    
    $userData = [
        'id' => $userId,
        'name' => "User $userId",
        'email' => "user$userId@example.com"
    ];
    
    $cache[$userId] = $userData;
    return $userData;
}

echo "Fetching user data:\n\n";

$user1 = fetchUserData(1);
echo "  Result: {$user1['name']} ({$user1['email']})\n\n";

$user2 = fetchUserData(2);
echo "  Result: {$user2['name']} ({$user2['email']})\n\n";

$user1Again = fetchUserData(1);  // Cached!
echo "  Result: {$user1Again['name']} ({$user1Again['email']})\n\n";

// Real-world example: Rate limiting with static
echo "7. Rate Limiting Implementation\n";
echo str_repeat("-", 50) . "\n";

function checkRateLimit($clientId, $maxRequests = 3, $window = 60) {
    static $requests = [];
    
    $now = time();
    
    // Initialize client if not exists
    if (!isset($requests[$clientId])) {
        $requests[$clientId] = [];
    }
    
    // Remove old requests outside the time window
    $requests[$clientId] = array_filter(
        $requests[$clientId],
        fn($timestamp) => ($now - $timestamp) < $window
    );
    
    // Check if limit exceeded
    if (count($requests[$clientId]) >= $maxRequests) {
        $oldestRequest = min($requests[$clientId]);
        $resetIn = $window - ($now - $oldestRequest);
        echo "✗ Rate limit exceeded for client $clientId\n";
        echo "  Try again in $resetIn seconds\n";
        return false;
    }
    
    // Add new request
    $requests[$clientId][] = $now;
    $remaining = $maxRequests - count($requests[$clientId]);
    
    echo "✓ Request allowed for client $clientId\n";
    echo "  Remaining requests: $remaining/$maxRequests\n";
    return true;
}

echo "Testing rate limiting (3 requests per 60 seconds):\n\n";

for ($i = 1; $i <= 5; $i++) {
    echo "Request #$i:\n";
    checkRateLimit('client-123');
    echo "\n";
}

// Real-world example: Scope resolution
echo "8. Understanding Scope Resolution\n";
echo str_repeat("-", 50) . "\n";

$globalVar = "I'm global";

function scopeTest() {
    $localVar = "I'm local";
    
    // This will cause an error (commented out)
    // echo $globalVar;  // Undefined variable
    
    // Correct way to access global
    global $globalVar;
    echo "Accessing global variable: $globalVar\n";
    echo "Accessing local variable: $localVar\n";
}

function anotherScopeTest() {
    // This will cause an error (commented out)
    // echo $localVar;  // Undefined variable from other function
    
    echo "This function has its own scope\n";
    echo "Cannot access variables from other functions\n";
}

scopeTest();
echo "\n";
anotherScopeTest();

echo "\n💡 Best Practice: Minimize use of global variables. Use parameters,\n";
echo "   return values, or dependency injection for better code organization.\n";
