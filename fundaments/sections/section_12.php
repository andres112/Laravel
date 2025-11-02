<?php
/**
 * PERFORMANCE OPTIMIZATION IN PHP
 * 
 * Writing efficient PHP code is crucial for scalable applications.
 * Performance optimization involves reducing execution time and memory usage.
 * 
 * Key areas:
 * - Algorithm efficiency (time complexity)
 * - Memory management
 * - Database query optimization
 * - Caching strategies
 * - Opcode caching (OPcache)
 * 
 * Use cases: High-traffic websites, data processing, API endpoints,
 *            real-time applications, resource-intensive operations.
 */

echo "=== PERFORMANCE OPTIMIZATION ===\n\n";

// Include performance testing utilities if available
if (file_exists(__DIR__ . '/../performance.php')) {
    include_once __DIR__ . '/../performance.php';
    echo "✓ Performance utilities loaded\n\n";
}

// Real-world example: String concatenation performance
echo "1. String Concatenation Methods\n";
echo str_repeat("-", 50) . "\n";

$iterations = 1000;

// Method 1: Concatenation with .=
$start = microtime(true);
$result = '';
for ($i = 0; $i < $iterations; $i++) {
    $result .= "Item $i, ";
}
$time1 = microtime(true) - $start;

// Method 2: Array join
$start = microtime(true);
$items = [];
for ($i = 0; $i < $iterations; $i++) {
    $items[] = "Item $i";
}
$result = implode(', ', $items);
$time2 = microtime(true) - $start;

echo "Building a string with $iterations items:\n";
echo "  Concatenation (.=): " . number_format($time1 * 1000, 4) . " ms\n";
echo "  Array join (implode): " . number_format($time2 * 1000, 4) . " ms\n";
echo "  Winner: " . ($time2 < $time1 ? "Array join" : "Concatenation") . 
     " is " . number_format(max($time1, $time2) / min($time1, $time2), 2) . "x faster\n\n";

// Real-world example: Array operations performance
echo "2. Array Search Methods\n";
echo str_repeat("-", 50) . "\n";

$largeArray = range(1, 10000);
$searchValue = 7500;

// Method 1: in_array (linear search)
$start = microtime(true);
for ($i = 0; $i < 100; $i++) {
    $found = in_array($searchValue, $largeArray);
}
$time1 = microtime(true) - $start;

// Method 2: isset with array flip (hash lookup)
$flipped = array_flip($largeArray);
$start = microtime(true);
for ($i = 0; $i < 100; $i++) {
    $found = isset($flipped[$searchValue]);
}
$time2 = microtime(true) - $start;

echo "Searching in 10,000 element array (100 times):\n";
echo "  in_array(): " . number_format($time1 * 1000, 4) . " ms\n";
echo "  isset() with flipped array: " . number_format($time2 * 1000, 4) . " ms\n";
echo "  Speedup: " . number_format($time1 / $time2, 2) . "x faster\n\n";

// Real-world example: Loop performance
echo "3. Loop Optimization\n";
echo str_repeat("-", 50) . "\n";

$data = range(1, 1000);

// Method 1: Count in loop condition (BAD)
$start = microtime(true);
$sum = 0;
for ($i = 0; $i < count($data); $i++) {
    $sum += $data[$i];
}
$time1 = microtime(true) - $start;

// Method 2: Cache count (BETTER)
$start = microtime(true);
$sum = 0;
$length = count($data);
for ($i = 0; $i < $length; $i++) {
    $sum += $data[$i];
}
$time2 = microtime(true) - $start;

// Method 3: foreach (BEST for arrays)
$start = microtime(true);
$sum = 0;
foreach ($data as $value) {
    $sum += $value;
}
$time3 = microtime(true) - $start;

echo "Summing 1,000 numbers:\n";
echo "  for with count(): " . number_format($time1 * 1000, 4) . " ms\n";
echo "  for with cached count: " . number_format($time2 * 1000, 4) . " ms\n";
echo "  foreach: " . number_format($time3 * 1000, 4) . " ms\n";
echo "  Best: foreach is " . number_format($time1 / $time3, 2) . "x faster\n\n";

// Real-world example: Function call overhead
echo "4. Function Call Overhead\n";
echo str_repeat("-", 50) . "\n";

function simpleOperation($x) {
    return $x * 2;
}

$iterations = 10000;

// With function calls
$start = microtime(true);
$sum = 0;
for ($i = 0; $i < $iterations; $i++) {
    $sum += simpleOperation($i);
}
$time1 = microtime(true) - $start;

// Inline operation
$start = microtime(true);
$sum = 0;
for ($i = 0; $i < $iterations; $i++) {
    $sum += $i * 2;
}
$time2 = microtime(true) - $start;

echo "10,000 simple operations:\n";
echo "  With function calls: " . number_format($time1 * 1000, 4) . " ms\n";
echo "  Inline operations: " . number_format($time2 * 1000, 4) . " ms\n";
echo "  Overhead: " . number_format(($time1 - $time2) / $time1 * 100, 2) . "%\n\n";

echo "Note: Function call overhead matters only in tight loops.\n";
echo "Always prioritize code readability over micro-optimizations.\n\n";

// Real-world example: Memory usage
echo "5. Memory Usage Comparison\n";
echo str_repeat("-", 50) . "\n";

// Method 1: Loading all data at once
$memStart = memory_get_usage();
$data = range(1, 100000);
$sum = array_sum($data);
$memEnd = memory_get_usage();
$memory1 = $memEnd - $memStart;

echo "Processing 100,000 numbers:\n";
echo "  Load all data: " . number_format($memory1 / 1024, 2) . " KB\n";

// Method 2: Processing on-the-fly (generator)
function numberGenerator($start, $end) {
    for ($i = $start; $i <= $end; $i++) {
        yield $i;
    }
}

$memStart = memory_get_usage();
$sum = 0;
foreach (numberGenerator(1, 100000) as $num) {
    $sum += $num;
}
$memEnd = memory_get_usage();
$memory2 = $memEnd - $memStart;

echo "  Using generator: " . number_format($memory2 / 1024, 2) . " KB\n";
echo "  Memory saved: " . number_format(($memory1 - $memory2) / 1024, 2) . " KB\n\n";

// Real-world example: Database query simulation
echo "6. Query Optimization Principles\n";
echo str_repeat("-", 50) . "\n";

echo "❌ N+1 Query Problem (SLOW):\n";
echo "   1. SELECT * FROM posts (1 query)\n";
echo "   2. For each post:\n";
echo "      SELECT * FROM users WHERE id = ? (N queries)\n";
echo "   Total: 1 + N queries\n\n";

echo "✓ Eager Loading (FAST):\n";
echo "   1. SELECT * FROM posts (1 query)\n";
echo "   2. SELECT * FROM users WHERE id IN (?) (1 query)\n";
echo "   Total: 2 queries\n\n";

echo "For 100 posts:\n";
echo "  N+1 approach: 101 queries\n";
echo "  Eager loading: 2 queries\n";
echo "  Performance gain: 50x faster\n\n";

// Real-world example: Caching demonstration
echo "7. Caching Strategy\n";
echo str_repeat("-", 50) . "\n";

// Simulate expensive operation
function expensiveCalculation($input) {
    usleep(10000); // 10ms delay
    return $input * $input;
}

$cache = [];

function getCachedResult($input) {
    global $cache;
    
    if (!isset($cache[$input])) {
        echo "  [MISS] Computing result for $input...\n";
        $cache[$input] = expensiveCalculation($input);
    } else {
        echo "  [HIT] Using cached result for $input\n";
    }
    
    return $cache[$input];
}

echo "Caching demonstration:\n";
$start = microtime(true);
$result1 = getCachedResult(5);
$result2 = getCachedResult(10);
$result3 = getCachedResult(5);  // Cached!
$result4 = getCachedResult(10); // Cached!
$time = microtime(true) - $start;

echo "\nTotal time: " . number_format($time * 1000, 2) . " ms\n";
echo "Without cache: ~40ms\n";
echo "With cache: ~" . number_format($time * 1000, 2) . " ms\n\n";

// Performance tips summary
echo "8. Performance Best Practices\n";
echo str_repeat("-", 50) . "\n";

$tips = [
    "✓ Use OPcache in production (stores compiled bytecode)",
    "✓ Implement caching (Redis, Memcached) for expensive operations",
    "✓ Use isset() instead of in_array() for lookups",
    "✓ Avoid counting in loop conditions",
    "✓ Use generators for large datasets",
    "✓ Minimize database queries (eager loading, indexing)",
    "✓ Profile before optimizing (use Xdebug, Blackfire)",
    "✓ Use native functions over custom implementations",
    "✓ Defer non-critical operations (queues, async)",
    "✓ Enable compression (gzip) for responses",
];

foreach ($tips as $tip) {
    echo "$tip\n";
}

echo "\n💡 Remember: Premature optimization is the root of all evil.\n";
echo "   Profile first, optimize bottlenecks, measure results.\n";
