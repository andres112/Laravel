<?php
/**
 * RECURSION
 * 
 * Recursion is when a function calls itself to solve a problem by breaking it
 * down into smaller, similar sub-problems. Essential for tree structures,
 * hierarchies, and divide-and-conquer algorithms.
 * 
 * Key components of recursion:
 * - Base case: Condition to stop recursion (prevents infinite loops)
 * - Recursive case: Function calls itself with modified parameters
 * - Progress: Each call must move closer to the base case
 * 
 * Real-world uses: Directory traversal, menu systems, organizational charts,
 * nested data structures, tree operations, backtracking algorithms.
 * 
 * Warning: Deep recursion can cause stack overflow. Consider iteration or
 * tail-call optimization for deep structures.
 */

echo "=== RECURSION ===\n\n";

// Real-world example: Directory tree traversal
echo "1. Directory Tree Traversal (Simulated)\n";
echo str_repeat("-", 50) . "\n";

// Simulate directory structure
$fileSystem = [
    'name' => 'project',
    'type' => 'directory',
    'children' => [
        [
            'name' => 'src',
            'type' => 'directory',
            'children' => [
                ['name' => 'index.php', 'type' => 'file', 'size' => 1024],
                ['name' => 'helpers.php', 'type' => 'file', 'size' => 2048],
                [
                    'name' => 'models',
                    'type' => 'directory',
                    'children' => [
                        ['name' => 'User.php', 'type' => 'file', 'size' => 4096],
                        ['name' => 'Product.php', 'type' => 'file', 'size' => 3072],
                    ]
                ],
            ]
        ],
        [
            'name' => 'tests',
            'type' => 'directory',
            'children' => [
                ['name' => 'UserTest.php', 'type' => 'file', 'size' => 2048],
            ]
        ],
        ['name' => 'README.md', 'type' => 'file', 'size' => 8192],
    ]
];

function displayTree(array $node, int $level = 0): void {
    $indent = str_repeat("  ", $level);
    $icon = $node['type'] === 'directory' ? '📁' : '📄';
    
    echo $indent . $icon . " " . $node['name'];
    
    if ($node['type'] === 'file') {
        echo " (" . number_format($node['size'] / 1024, 1) . " KB)";
    }
    echo "\n";
    
    if (isset($node['children'])) {
        foreach ($node['children'] as $child) {
            displayTree($child, $level + 1);
        }
    }
}

echo "Project structure:\n";
displayTree($fileSystem);

echo "\n";

// Real-world example: Calculate total directory size
echo "2. Calculate Total Size Recursively\n";
echo str_repeat("-", 50) . "\n";

function calculateSize(array $node): int {
    if ($node['type'] === 'file') {
        return $node['size'];
    }
    
    $totalSize = 0;
    if (isset($node['children'])) {
        foreach ($node['children'] as $child) {
            $totalSize += calculateSize($child);
        }
    }
    echo "Node '{$node['name']}' total size: " . number_format($totalSize / 1024, 2) . " KB\n";
    return $totalSize;
}

$totalSize = calculateSize($fileSystem);
echo "Total project size: " . number_format($totalSize / 1024, 2) . " KB\n\n";

// Real-world example: Nested menu system
echo "3. Nested Menu System\n";
echo str_repeat("-", 50) . "\n";

$menuStructure = [
    ['title' => 'Home', 'url' => '/'],
    [
        'title' => 'Products',
        'url' => '/products',
        'children' => [
            ['title' => 'Electronics', 'url' => '/products/electronics'],
            [
                'title' => 'Computers',
                'url' => '/products/computers',
                'children' => [
                    ['title' => 'Laptops', 'url' => '/products/computers/laptops'],
                    ['title' => 'Desktops', 'url' => '/products/computers/desktops'],
                ]
            ],
            ['title' => 'Phones', 'url' => '/products/phones'],
        ]
    ],
    [
        'title' => 'About',
        'url' => '/about',
        'children' => [
            ['title' => 'Our Team', 'url' => '/about/team'],
            ['title' => 'Careers', 'url' => '/about/careers'],
        ]
    ],
];

function renderMenu(array $items, int $level = 0): void {
    $indent = str_repeat("  ", $level);
    
    foreach ($items as $item) {
        echo $indent . "• {$item['title']} ({$item['url']})\n";
        
        if (isset($item['children'])) {
            renderMenu($item['children'], $level + 1);
        }
    }
}

echo "Website navigation:\n";
renderMenu($menuStructure);

echo "\n";

// Real-world example: Organizational hierarchy
echo "4. Organizational Chart\n";
echo str_repeat("-", 50) . "\n";

$organization = [
    'name' => 'John Smith',
    'position' => 'CEO',
    'reports' => [
        [
            'name' => 'Jane Doe',
            'position' => 'CTO',
            'reports' => [
                [
                  'name' => 'Bob Wilson', 
                  'position' => 'Senior Developer', 
                  'reports' => [
                    ['name' => 'Charlie Green', 'position' => 'Junior Developer'],
                    [ 'name'=> 'Jane Smith','position'=> 'Junior Developer'],
                    ['name'=> 'Will Smith','position'=> 'Intern'],
                ]],
                ['name' => 'Alice Brown', 'position' => 'DevOps Engineer'],
            ]
        ],
        [
            'name' => 'Mike Johnson',
            'position' => 'CFO',
            'reports' => [
                ['name' => 'Sarah Davis', 'position' => 'Accountant'],
            ]
        ],
        [
            'name' => 'Emily White',
            'position' => 'COO',
        ],
    ]
];

function displayOrgChart(array $employee, int $level = 0): void {
    $indent = str_repeat("  ", $level);
    $prefix = $level > 0 ? "└─ " : "";
    
    echo $indent . $prefix . "{$employee['name']} - {$employee['position']}\n";
    
    if (isset($employee['reports'])) {
        foreach ($employee['reports'] as $report) {
            displayOrgChart($report, $level + 1);
        }
    }
}

echo "Company hierarchy:\n";
displayOrgChart($organization);

echo "\n";

// Count total employees
function countEmployees(array $employee): int {
    if (!isset($employee['reports'])) {
        return 1;
    }    
    return 1 + array_reduce(
        $employee['reports'],
        fn($sum, $report) => $sum + countEmployees($report),
        0
    );
}

echo "Total employees: " . countEmployees($organization) . "\n\n";

// Real-world example: Nested array flattening
echo "5. Flatten Nested Arrays\n";
echo str_repeat("-", 50) . "\n";

function flattenArray(array $array): array {
    $result = [];
    
    foreach ($array as $item) {
        if (is_array($item)) {
            $result = array_merge($result, flattenArray($item));
        } else {
            $result[] = $item;
        }
    }
    
    return $result;
}

$nestedData = [1, [2, 3], [[4, 5], 6], [[[7]], 8], 9];
$flattened = flattenArray($nestedData);

echo "Original: " . json_encode($nestedData) . "\n";
echo "Flattened: " . json_encode($flattened) . "\n\n";

// Real-world example: Permission checking in nested roles
echo "6. Recursive Permission Checking\n";
echo str_repeat("-", 50) . "\n";

$roles = [
    'admin' => [
        'permissions' => ['create', 'read', 'update', 'delete', 'manage_users'],
        'inherits' => []
    ],
    'editor' => [
        'permissions' => ['create', 'read', 'update'],
        'inherits' => ['viewer']
    ],
    'viewer' => [
        'permissions' => ['read'],
        'inherits' => []
    ],
    'moderator' => [
        'permissions' => ['update', 'delete'],
        'inherits' => ['editor']
    ],
];

function hasPermission(string $role, string $permission, array $roles): bool {
    if (!isset($roles[$role])) {
        return false;
    }
    
    // Check direct permissions
    if (in_array($permission, $roles[$role]['permissions'])) {
        return true;
    }
    
    // Check inherited permissions recursively
    foreach ($roles[$role]['inherits'] as $inheritedRole) {
        if (hasPermission($inheritedRole, $permission, $roles)) {
            return true;
        }
    }
    
    return false;
}

$testCases = [
    ['role' => 'admin', 'permission' => 'delete'],
    ['role' => 'editor', 'permission' => 'read'],
    ['role' => 'viewer', 'permission' => 'delete'],
    ['role' => 'moderator', 'permission' => 'read'],
];

echo "Permission checks:\n";
foreach ($testCases as $test) {
    $result = hasPermission($test['role'], $test['permission'], $roles);
    $status = $result ? '✓ Allowed' : '✗ Denied';
    echo "  {$test['role']} can '{$test['permission']}': {$status}\n";
}

echo "\n";

// Real-world example: Fibonacci with memoization
echo "7. Fibonacci Sequence (Optimized)\n";
echo str_repeat("-", 50) . "\n";

class FibonacciCalculator {
    private array $cache = [];
    
    public function calculate(int $n): int {
        if ($n <= 1) {
            return $n;
        }
        
        if (isset($this->cache[$n])) {
            return $this->cache[$n];
        }
        
        $this->cache[$n] = $this->calculate($n - 1) + $this->calculate($n - 2);
        return $this->cache[$n];
    }
    
    public function getCacheSize(): int {
        return count($this->cache);
    }
}

$fib = new FibonacciCalculator();

echo "Fibonacci sequence:\n";
$sequence = [];
for ($i = 0; $i <= 10; $i++) {
    $sequence[] = $fib->calculate($i);
}
echo "  First 11 numbers: " . implode(', ', $sequence) . "\n";

echo "\nLarge number calculation:\n";
$large = $fib->calculate(30);
echo "  Fibonacci(30) = " . number_format($large) . "\n";
echo "  Cache entries: {$fib->getCacheSize()}\n\n";

// Real-world example: Path finding in tree
echo "8. Find Path in Tree\n";
echo str_repeat("-", 50) . "\n";

function findPath(array $node, string $target, array $path = []): ?array {
    $path[] = $node['name'];
    
    if ($node['name'] === $target) {
        return $path;
    }
    
    if (isset($node['children'])) {
        foreach ($node['children'] as $child) {
            $result = findPath($child, $target, $path);
            if ($result !== null) {
                return $result;
            }
        }
    }
    
    return null;
}

$targetFile = 'User.php';
$path = findPath($fileSystem, $targetFile);

if ($path !== null) {
    echo "Path to '{$targetFile}': " . implode(' → ', $path) . "\n";
} else {
    echo "'{$targetFile}' not found\n";
}

echo "\n💡 Best Practice: Always include a base case to prevent infinite\n";
echo "   recursion. Consider iteration for very deep structures to avoid\n";
echo "   stack overflow. Use memoization for expensive recursive calculations.\n";
