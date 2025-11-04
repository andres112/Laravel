<?php
/**
 * ANONYMOUS FUNCTIONS & CLOSURES
 * 
 * Anonymous functions (closures) are functions without a name that can be stored
 * in variables, passed as arguments, or returned from other functions.
 * 
 * Key concepts:
 * - Lambda functions: Short, one-time-use functions
 * - Closures: Functions that capture variables from outer scope using 'use'
 * - Callbacks: Functions passed as arguments to other functions
 * - First-class functions: Functions treated as values
 * 
 * Use cases: Event handlers, array operations, callbacks, factory patterns,
 *            middleware, custom sorting, data filtering and transformation.
 */

echo "=== ANONYMOUS FUNCTIONS & CLOSURES ===\n\n";

// Real-world example: Event listener system
echo "1. Event Listener System\n";
echo str_repeat("-", 50) . "\n";

class EventManager
{
    private array $listeners = [];
    
    public function on(string $event, callable $callback): void
    {
        if (!isset($this->listeners[$event])) {
            $this->listeners[$event] = [];
        }
        $this->listeners[$event][] = $callback;
    }
    
    public function trigger(string $event, array $data = []): void
    {
        if (isset($this->listeners[$event])) {
            foreach ($this->listeners[$event] as $callback) {
                $callback($data);
            }
        }
    }
}

$eventManager = new EventManager();

// Register event listeners using closures
$eventManager->on('user.login', function($data) {
    echo "✓ User logged in: {$data['username']}\n";
    echo "  IP Address: {$data['ip']}\n";
});

$eventManager->on('user.login', function($data) {
    echo "  📧 Sending welcome email to {$data['email']}\n";
});

$eventManager->on('order.placed', function($data) {
    echo "✓ Order placed: #{$data['order_id']}\n";
    echo "  Total: $" . number_format($data['total'], 2) . "\n";
    echo "  📦 Processing order...\n";
});

// Trigger events
echo "Event: User Login\n";
$eventManager->trigger('user.login', [
    'username' => 'johndoe',
    'email' => 'john@example.com',
    'ip' => '192.168.1.1'
]);

echo "\nEvent: Order Placed\n";
$eventManager->trigger('order.placed', [
    'order_id' => 'ORD-1001',
    'total' => 299.99
]);

echo "\n";

// Real-world example: Data transformation pipeline
echo "2. Data Transformation Pipeline\n";
echo str_repeat("-", 50) . "\n";

class DataPipeline
{
    private array $transformers = [];
    
    public function add(callable $transformer): self
    {
        $this->transformers[] = $transformer;
        return $this;
    }
    
    public function process($data)
    {
        foreach ($this->transformers as $transformer) {
            $data = $transformer($data);
        }
        return $data;
    }
}

$pipeline = new DataPipeline();

// Add transformation steps using closures
$pipeline
    ->add(function($data) {
        // Step 1: Trim whitespace
        return array_map('trim', $data);
    })
    ->add(function($data) {
        // Step 2: Convert to lowercase
        return array_map('strtolower', $data);
    })
    ->add(function($data) {
        // Step 3: Remove empty values
        return array_filter($data, fn($val) => !empty($val));
    })
    ->add(function($data) {
        // Step 4: Remove duplicates
        return array_unique($data);
    });

$rawData = ['  John  ', 'JANE', 'john', '', '  Bob  ', 'jane', 'Alice'];
echo "Raw data: " . json_encode($rawData) . "\n";

$processedData = $pipeline->process($rawData);
echo "Processed: " . json_encode(array_values($processedData)) . "\n\n";

// Real-world example: Price calculator with closures
echo "3. Dynamic Price Calculator\n";
echo str_repeat("-", 50) . "\n";

// Tax rate captured by closure
$taxRate = 0.18;

// Create calculator functions
$applyDiscount = function(float $amount, float $discountPercent) {
    return $amount * (1 - $discountPercent / 100);
};

$applyTax = function(float $amount) use ($taxRate) {
    return $amount * (1 + $taxRate);
};

$applyShipping = function(float $amount, float $weight) {
    $shippingCost = match(true) {
        $weight < 1 => 5.00,
        $weight < 5 => 10.00,
        $weight < 10 => 15.00,
        default => 25.00
    };
    return $amount + $shippingCost;
};

// Create a complete pricing function that uses other closures
$calculateFinalPrice = function(float $basePrice, float $discount, float $weight) 
    use ($applyDiscount, $applyTax, $applyShipping, $taxRate) {
    
    $afterDiscount = $applyDiscount($basePrice, $discount);
    $afterTax = $applyTax($afterDiscount);
    $finalPrice = $applyShipping($afterTax, $weight);
    
    return [
        'base_price' => $basePrice,
        'discount' => $discount . '%',
        'after_discount' => $afterDiscount,
        'tax_rate' => ($taxRate * 100) . '%',
        'after_tax' => $afterTax,
        'weight' => $weight . 'kg',
        'final_price' => $finalPrice
    ];
};

$products = [
    ['name' => 'Laptop', 'price' => 999.99, 'discount' => 10, 'weight' => 2.5],
    ['name' => 'Book', 'price' => 29.99, 'discount' => 15, 'weight' => 0.5],
    ['name' => 'Monitor', 'price' => 399.99, 'discount' => 5, 'weight' => 8.0],
];

foreach ($products as $product) {
    $result = $calculateFinalPrice($product['price'], $product['discount'], $product['weight']);
    
    echo "{$product['name']}:\n";
    echo "  Base Price: $" . number_format($result['base_price'], 2) . "\n";
    echo "  Discount ({$result['discount']}): $" . number_format($result['after_discount'], 2) . "\n";
    echo "  After Tax ({$result['tax_rate']}): $" . number_format($result['after_tax'], 2) . "\n";
    echo "  Shipping ({$result['weight']}): $" . number_format($result['final_price'], 2) . "\n";
    echo "  FINAL: $" . number_format($result['final_price'], 2) . "\n\n";
}

// Real-world example: Custom array sorting
echo "4. Custom Sorting with Closures\n";
echo str_repeat("-", 50) . "\n";

$products = [
    ['name' => 'Laptop', 'price' => 999.99, 'rating' => 4.5, 'stock' => 15],
    ['name' => 'Mouse', 'price' => 29.99, 'rating' => 4.8, 'stock' => 50],
    ['name' => 'Keyboard', 'price' => 79.99, 'rating' => 4.3, 'stock' => 0],
    ['name' => 'Monitor', 'price' => 299.99, 'rating' => 4.7, 'stock' => 8],
];

echo "Original products:\n";
foreach ($products as $p) {
    printf("  %s: $%.2f (Rating: %.1f, Stock: %d)\n", 
        $p['name'], $p['price'], $p['rating'], $p['stock']);
}

// Sort by price (ascending)
$byPrice = $products;
usort($byPrice, function($a, $b) {
    return $a['price'] <=> $b['price'];
});

echo "\nSorted by Price (Low to High):\n";
foreach ($byPrice as $p) {
    printf("  %s: $%.2f\n", $p['name'], $p['price']);
}

// Sort by rating (descending)
$byRating = $products;
usort($byRating, function($a, $b) {
    return $b['rating'] <=> $a['rating'];
});

echo "\nSorted by Rating (High to Low):\n";
foreach ($byRating as $p) {
    printf("  %s: %.1f stars\n", $p['name'], $p['rating']);
}

// Complex sort: In stock first, then by rating
$byAvailability = $products;
usort($byAvailability, function($a, $b) {
    // First priority: stock availability
    if (($a['stock'] > 0) !== ($b['stock'] > 0)) {
        return ($b['stock'] > 0) <=> ($a['stock'] > 0);
    }
    // Second priority: rating
    return $b['rating'] <=> $a['rating'];
});

echo "\nSorted by Availability & Rating:\n";
foreach ($byAvailability as $p) {
    $status = $p['stock'] > 0 ? "✓ In Stock" : "✗ Out of Stock";
    printf("  %s: %s (%.1f stars)\n", $p['name'], $status, $p['rating']);
}

echo "\n";

// Real-world example: Validator factory
echo "5. Validation Factory Pattern\n";
echo str_repeat("-", 50) . "\n";

class ValidatorFactory
{
    public static function email(): callable
    {
        return function($value) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
        };
    }
    
    public static function minLength(int $min): callable
    {
        return function($value) use ($min) {
            return strlen($value) >= $min;
        };
    }
    
    public static function maxLength(int $max): callable
    {
        return function($value) use ($max) {
            return strlen($value) <= $max;
        };
    }
    
    public static function range(float $min, float $max): callable
    {
        return function($value) use ($min, $max) {
            return is_numeric($value) && $value >= $min && $value <= $max;
        };
    }
    
    public static function pattern(string $regex): callable
    {
        return function($value) use ($regex) {
            return preg_match($regex, $value) === 1;
        };
    }
}

$validators = [
    'email' => ValidatorFactory::email(),
    'password' => ValidatorFactory::minLength(8),
    'age' => ValidatorFactory::range(18, 100),
    'username' => ValidatorFactory::pattern('/^[a-zA-Z0-9_]{3,20}$/'),
];

$testData = [
    'email' => 'user@example.com',
    'password' => '1245',
    'age' => 25,
    'username' => 'john_doe_2024',
];

echo "Validating user data:\n\n";
foreach ($testData as $field => $value) {
    $validator = $validators[$field];
    $isValid = $validator($value);
    $status = $isValid ? "✓ Valid" : "✗ Invalid";
    echo "$field: '$value' - $status\n";
}

echo "\n";

// Real-world example: Memoization with closures
echo "6. Memoization Pattern\n";
echo str_repeat("-", 50) . "\n";

function memoize(callable $func): callable
{
    $cache = [];
    
    return function(...$args) use ($func, &$cache) {
        $key = serialize($args);
        
        if (!isset($cache[$key])) {
            echo "  [Cache MISS] Computing result...\n";
            $cache[$key] = $func(...$args);
        } else {
            echo "  [Cache HIT] Using cached result\n";
        }
        
        return $cache[$key];
    };
}

// Expensive operation
$expensiveCalculation = function($n) {
    usleep(100000); // Simulate 0.1 second delay
    return $n * $n;
};

$memoized = memoize($expensiveCalculation);

echo "Calculating square of 5:\n";
$result1 = $memoized(5);
echo "  Result: $result1\n\n";

echo "Calculating square of 5 again:\n";
$result2 = $memoized(5);
echo "  Result: $result2\n\n";

echo "Calculating square of 10:\n";
$result3 = $memoized(10);
echo "  Result: $result3\n";

echo "\n💡 Best Practice: Use closures for callbacks, event handlers, and custom\n";
echo "   logic. Capture variables with 'use' for accessing outer scope.\n";
