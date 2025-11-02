<?php
/**
 * REQUIRE and INCLUDE
 * 
 * PHP provides four ways to include external files:
 * - include: Includes file, warning on failure (script continues)
 * - require: Includes file, fatal error on failure (script stops)
 * - include_once: Includes file only once
 * - require_once: Requires file only once (most common for classes/configs)
 * 
 * Use cases: Configuration loading, class autoloading, template inclusion,
 *            shared functions, modular code organization.
 * 
 * Best practices:
 * - Use require_once for critical files (configs, classes)
 * - Use include for templates where failure is acceptable
 * - Use absolute paths with __DIR__ for reliability
 */

echo "=== REQUIRE AND INCLUDE ===\n\n";

// Real-world example: Configuration file loading
echo "1. Loading Configuration Files\n";
echo str_repeat("-", 50) . "\n";

// Check if config file exists
$configFile = __DIR__ . '/../require/config.php';

if (file_exists($configFile)) {
    require_once $configFile;
    
    echo "✓ Configuration loaded successfully\n\n";
    echo "Database Configuration:\n";
    echo "  Host: " . DB_HOST . "\n";
    echo "  User: " . DB_USER . "\n";
    echo "  Connection string: " . DB_USER . "@" . DB_HOST . "\n";
} else {
    echo "✗ Configuration file not found: $configFile\n";
}

echo "\n";

// Real-world example: Loading helper functions
echo "2. Helper Functions Module\n";
echo str_repeat("-", 50) . "\n";

$checkerFile = __DIR__ . '/../checker.php';

if (file_exists($checkerFile)) {
    // require_once ensures the file is loaded only once
    // even if called multiple times
    require_once $checkerFile;
    echo "✓ Checker module loaded (first require_once)\n";
    
    // This won't load it again
    require_once $checkerFile;
    echo "✓ Checker module skipped (second require_once)\n";
    
    // But regular require would try to load it again (may cause errors)
    // require $checkerFile; // Uncomment to see redeclaration error
} else {
    echo "✗ Checker file not found\n";
}

echo "\n";

// Real-world example: Conditional loading
echo "3. Conditional File Loading\n";
echo str_repeat("-", 50) . "\n";

$environment = 'production'; // Could be: development, staging, production

echo "Environment: $environment\n";

// Load environment-specific configuration
$envConfigFile = __DIR__ . "/../config/{$environment}.php";

if (file_exists($envConfigFile)) {
    include $envConfigFile;
    echo "✓ Environment-specific config loaded\n";
} else {
    echo "⚠ Environment config not found, using defaults\n";
    // Set default values
    define('APP_DEBUG', false);
    define('APP_LOG_LEVEL', 'error');
}

echo "\n";

// Real-world example: Template system
echo "4. Template System Simulation\n";
echo str_repeat("-", 50) . "\n";

// Simulate template loading
$pageTitle = "Welcome to Our Site";
$pageContent = "This is the main content of the page.";

echo "Rendering page template...\n";
echo "  Title: $pageTitle\n";
echo "  Content: $pageContent\n";

// In a real application, you would include template files like:
// include __DIR__ . '/templates/header.php';
// include __DIR__ . '/templates/content.php';
// include __DIR__ . '/templates/footer.php';

echo "\nTemplate structure:\n";
echo "  [Header] - Navigation, Logo\n";
echo "  [Content] - $pageTitle\n";
echo "  [Footer] - Copyright, Links\n";

echo "\n";

// Real-world example: Autoloading demonstration
echo "5. Class Autoloading Concept\n";
echo str_repeat("-", 50) . "\n";

echo "Modern PHP uses autoloading instead of manual require/include:\n\n";

echo "// Traditional approach (not recommended):\n";
echo "require_once 'classes/User.php';\n";
echo "require_once 'classes/Post.php';\n";
echo "require_once 'classes/Comment.php';\n\n";

echo "// Modern approach with Composer autoloader:\n";
echo "require_once 'vendor/autoload.php';\n";
echo "\$user = new User(); // Automatically loaded!\n\n";

echo "Advantages of autoloading:\n";
echo "  ✓ Only loads classes when needed\n";
echo "  ✓ No manual require statements\n";
echo "  ✓ Follows PSR-4 standards\n";
echo "  ✓ Better performance\n";

echo "\n";

// Real-world example: Include vs Require comparison
echo "6. Include vs Require - Error Handling\n";
echo str_repeat("-", 50) . "\n";

echo "include behavior:\n";
$includeFile = __DIR__ . '/../nonexistent.php';
@include $includeFile; // @ suppresses warning for demo
echo "  ⚠ Warning on failure, script continues\n";
echo "  ✓ Script still running...\n\n";

echo "require behavior:\n";
echo "  ✗ Fatal error on failure, script stops\n";
echo "  Use when file is critical for operation\n\n";

echo "require_once behavior:\n";
echo "  ✓ Loads file only once (prevents redeclaration)\n";
echo "  ✗ Fatal error if file not found\n";
echo "  Best for: classes, configs, core functions\n\n";

echo "include_once behavior:\n";
echo "  ✓ Loads file only once\n";
echo "  ⚠ Warning if file not found, continues\n";
echo "  Best for: optional features, plugins\n";

echo "\n💡 Best Practice: Use require_once for critical files (configs, classes)\n";
echo "   and include for optional templates. Always use __DIR__ for paths.\n";
