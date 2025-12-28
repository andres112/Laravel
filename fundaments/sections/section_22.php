<?php
/**
 * CLASSES & OBJECT-ORIENTED PROGRAMMING
 * 
 * Classes are blueprints for creating objects that encapsulate data and behavior.
 * PHP's OOP features enable code reusability, maintainability, and scalability.
 * 
 * Key concepts:
 * - Classes & Objects: Blueprints and instances
 * - Properties & Methods: Data and behavior
 * - Constructor: Initialize object state (__construct)
 * - Property Promotion: PHP 8.0+ shorthand for declaring properties
 * - Visibility: public, private, protected
 * - Inheritance: Extending classes (extends)
 * - Polymorphism: Method overriding and type substitution
 * - Encapsulation: Controlling access to data
 * - Static: Class-level properties and methods
 * - Interfaces: Contracts for implementation
 * - Abstract Classes: Partial implementations
 * 
 * Real-world uses: User management, payment processing, API integrations,
 * database models, service classes, design patterns (Singleton, Factory, etc.)
 * 
 * Best practices: Single responsibility, dependency injection, favor composition
 * over inheritance, program to interfaces, keep classes focused and cohesive.
 */

echo "=== CLASSES & OBJECT-ORIENTED PROGRAMMING ===\n\n";

// Real-world example: User account management
echo "1. Basic Class Structure - User Account\n";
echo str_repeat("-", 50) . "\n";

class Person
{
    // Using property promotion to declare and initialize properties
    // public string $name;
    // public int $age;

    public function __construct(public string $name, public int $age)
    {
        // Use property promotion (PHP 8.0+) instead of manual assignments
        // $this->name = $name;
        // $this->age = $age;

        $this->name = ucwords($name);
    }

    public function introduce(): string
    {
        return "Hello, my name is {$this->name} and I am {$this->age} years old.";
    }
}

$person = new Person("John Doe", 30);
echo "Creating user accounts:\n";
echo "  " . $person->introduce() . "\n";

$anotherPerson = new Person("jane smith", 25);
echo "  " . $anotherPerson->introduce() . "\n";
echo "\nNote: Constructor automatically formats names using ucwords()\n\n";

// Real-world example: Employee management system
echo "2. Inheritance - Employee Management\n";
echo str_repeat("-", 50) . "\n";

// Inheritance allows a class to inherit properties and methods from another class
class Employee extends Person
{
    public function __construct(public Person $person, public string $position)
    {
        parent::__construct($person->name, $person->age);
    }

    public function introduce(): string
    {
        return parent::introduce() . " I work as a {$this->position}.";
    }
}

$worker = new Employee($person, "Software Developer");
echo "Employee System:\n";
echo "  " . $worker->introduce() . "\n";

$anotherWorker = new Employee($anotherPerson, "Designer");
echo "  " . $anotherWorker->introduce() . "\n";
echo "\nEmployee class extends Person, adding position information\n\n";

// Real-world example: Polymorphic behavior
echo "3. Polymorphism - Dynamic Method Behavior\n";
echo str_repeat("-", 50) . "\n";

// Polymorphism allows methods to do different things based on the object it is acting upon
// Here, both Person and Employee have an introduce() method, but they behave differently
function displayIntroduction(Person $individual): void
{
    echo "  " . $individual->introduce() . "\n";
}

echo "Same function, different behavior:\n";
displayIntroduction($person);
displayIntroduction($worker);
echo "\nThe function accepts Person type, but works with Employee too (polymorphism)\n\n";

// Real-world example: Banking system with encapsulation
echo "4. Encapsulation - Bank Account Security\n";
echo str_repeat("-", 50) . "\n";

// Encapsulation restricts direct access to some of an object's components

class BankAccount
{
    private float $balance;

    public function __construct(float $initialBalance = 0)
    {
        $this->balance = $initialBalance;
    }

    public function deposit(float $amount): void
    {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }

    public function withdraw(float $amount): bool
    {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return true;
        }
        return false;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}

$account = new BankAccount(100);
echo "Bank Account Transactions:\n";
echo "  Initial balance: $" . $account->getBalance() . "\n";

$account->deposit(50);
echo "  Deposited $50, new balance: $" . $account->getBalance() . "\n";

$account->withdraw(30);
echo "  Withdrew $30, new balance: $" . $account->getBalance() . "\n";

if (!$account->withdraw(150)) {
    echo "  Attempted to withdraw $150 - DENIED (insufficient funds)\n";
}
echo "  Current balance: $" . $account->getBalance() . "\n";
echo "\nPrivate property \$balance cannot be accessed directly (protected)\n\n";

// Real-world example: Utility functions and constants
echo "5. Static Properties & Methods - Math Utilities\n";
echo str_repeat("-", 50) . "\n";

class MathHelper
{
    public static float $pi = 3.14159;

    public static function calculateCircumference(float $radius): float
    {
        return 2 * self::$pi * $radius;
    }

    public static function square(float $number): float
    {
        return $number * $number;
    }
}

echo "Math Utility Functions (no instance needed):\n";
echo "  PI constant: " . MathHelper::$pi . "\n";
echo "  Circumference of circle (r=5): " . MathHelper::calculateCircumference(5) . "\n";
echo "  Square of 4: " . MathHelper::square(4) . "\n";
echo "\nStatic members accessed via class name, not object instance\n\n";

// Real-world example: Database connection singleton
echo "6. Singleton Pattern - Database Connection\n";
echo str_repeat("-", 50) . "\n";

class Connection
{
    private static ?Connection $instance = null;
    // Private constructor to prevent direct instantiation
    private function __construct()
    {
    }
    public static function singleton(): Connection
    {
        /**
         * static:: means “use the class that invoked the method,”
         * self:: means “use the class where this code is defined.”
         */
        if (static::$instance === null) {
            static::$instance = new Connection();
        }
        return static::$instance;
    }
}

$connection = Connection::singleton();

// Example of late static binding vs early binding
echo "\nLate Static Binding vs Early Binding\n";

class Animal
{
    public static function type()
    {
        return static::class; // late static binding
    }

    public static function whoSelf()
    {
        return self::class; // early binding
    }
}

class Dog extends Animal
{
}

echo "Understanding static:: vs self::\n";
echo "  Dog::type() returns: " . Dog::type() . " (uses static:: - late binding)\n";
echo "  Dog::whoSelf() returns: " . Dog::whoSelf() . " (uses self:: - early binding)\n";
echo "\nstatic:: resolves to calling class, self:: resolves to defining class\n\n";

// Real-world example: Payment processing system
echo "8. Interfaces & Abstract Classes - Payment Gateway\n";
echo str_repeat("-", 50) . "\n";

interface PaymentProcessor
{
    public function processPayment(float $amount): bool;
    public function refundPayment(float $amount): bool;
}

// Abstract class implementing the interface for common functionality
abstract class OnlinePaymentProcessor implements PaymentProcessor
{
    public function __construct(
        protected string $apiKey,
    ) {
    }

    abstract protected function validateApiKey(): bool;
    abstract protected function executeProcess(float $amount): bool;
    abstract protected function executeRefund(float $amount): bool;

    public function processPayment(float $amount): bool
    {
        if (!$this->validateApiKey()) {
            throw new Exception("Invalid API Key");
        }
        return $this->executeProcess($amount);
    }

    public function refundPayment(float $amount): bool
    {
        if (!$this->validateApiKey()) {
            throw new Exception("Invalid API Key");
        }
        return $this->executeRefund($amount);
    }
}

// Implement interface
class StripeProcessor extends OnlinePaymentProcessor
{
    public function validateApiKey(): bool
    {
        return strpos($this->apiKey, "sk_") === 0;
    }

    public function executeProcess(float $amount): bool
    {
        echo "Processing \${$amount} payment through Stripe.\n";
        return true;
    }

    public function executeRefund(float $amount): bool
    {
        echo "Refunding \${$amount} payment through Stripe.\n";
        return true;
    }
}

// Extend from abstract class
class PaypalProcessor extends OnlinePaymentProcessor
{
    public function validateApiKey(): bool
    {
        return strlen($this->apiKey) === 32;
    }

    public function executeProcess(float $amount): bool
    {
        echo "Processing \${$amount} payment through PayPal.\n";
        return true;
    }

    public function executeRefund(float $amount): bool
    {
        echo "Refunding \${$amount} payment through PayPal.\n";
        return true;
    }
}

// Extend directly from interface (API_KEY not required for cash payments)
class CashProcessor implements PaymentProcessor
{
    public function processPayment(float $amount): bool
    {
        echo "Processing \${$amount} cash payment.\n";
        return true;
    }

    public function refundPayment(float $amount): bool
    {
        echo "Refunding \${$amount} cash payment.\n";
        return true;
    }
}

// Composition pattern: OrderProcessor uses any PaymentProcessor implementation
class OrderProcessor
{
    public function __construct(private PaymentProcessor $paymentProcessor)
    {}

    public function processOrder(float $amount): void
    {
        if ($this->paymentProcessor->processPayment($amount)) {
            echo "  Order processed successfully.\n";
        } else {
            echo "  Order processing failed.\n";
        }
    }

    public function refundOrder(float $amount): void
    {
        if ($this->paymentProcessor->refundPayment($amount)) {
            echo "  Order refunded successfully.\n";
        } else {
            echo "  Order refund failed.\n";
        }
    }
}

echo "\nDemonstrating different payment processors:\n\n";

$stripeProcessor = new StripeProcessor("sk_test_123456");
$paypalProcessor = new PaypalProcessor("valid_32_character_api_key_12345");
$cashProcessor = new CashProcessor();

$stripeOrder = new OrderProcessor($stripeProcessor);
$paypalOrder = new OrderProcessor($paypalProcessor);
$cashOrder = new OrderProcessor($cashProcessor);

echo "Stripe Payment Gateway:\n";
$stripeOrder->processOrder(100);
$stripeOrder->refundOrder(50);

echo "\nPayPal Payment Gateway:\n";
$paypalOrder->processOrder(150.12);
$paypalOrder->refundOrder(75.06);

echo "\nCash Payment:\n";
$cashOrder->processOrder(200);
$cashOrder->refundOrder(100);

echo "\nInterface defines contract, abstract class provides shared logic,\n";
echo "concrete classes implement specific payment gateway behavior.\n\n";

// Real-world example: Reusable functionality with traits
echo "9. Traits - Code Reuse Without Inheritance\n";
echo str_repeat("-", 50) . "\n";

interface Logger
{
    public function log(string $message): void;
}

trait Loggable
{
    public function log(string $message): void
    {
        echo "  [LOG " . date('H:i:s') . "]: " . $message . "\n";
    }
}

trait Timestampable
{
    protected readonly string $createdAt;
    
    public function setTimestamp(): void
    {
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    public function getCreatedAt(): string
    {
        return $this->createdAt ?? 'Not set';
    }
}

// Class using multiple traits
class User implements Logger
{
    use Loggable, Timestampable;
    
    public function __construct(public string $username)
    {
        $this->setTimestamp();
    }

    public function save(): void
    {
        $this->log("Saving user: {$this->username}");
        echo "  User created at: {$this->getCreatedAt()}\n";
    }
}

echo "Demonstrating traits for reusable functionality:\n";
$user = new User("alice");
$user->save();

echo "\nTraits allow horizontal code reuse across unrelated classes\n\n";

// Real-world example: Preventing inheritance for security and integrity
echo "10. Final Classes - Preventing Inheritance\n";
echo str_repeat("-", 50) . "\n";

/**
 * Value Object: Money
 * 
 * This class is marked as 'final' because:
 * 1. It represents a value object that should maintain integrity
 * 2. Any modification should create a new instance (immutability)
 * 3. Inheritance could break the mathematical operations logic
 * 4. Security: prevents malicious extensions that could manipulate amounts
 */
final class Money
{
    public function __construct(
        private float $amount,
        private string $currency
    ) {
        if ($amount < 0) {
            throw new Exception("Amount cannot be negative");
        }
    }
    
    public function add(Money $other): Money
    {
        if ($this->currency !== $other->currency) {
            throw new Exception("Cannot add different currencies");
        }
        return new Money($this->amount + $other->amount, $this->currency);
    }
    
    public function format(): string
    {
        return number_format($this->amount, 2) . ' ' . $this->currency;
    }
}

echo "Money value object (final class):\n";
$price = new Money(100.50, 'USD');
$tax = new Money(15.00, 'USD');
$total = $price->add($tax);

echo "  Price: " . $price->format() . "\n";
echo "  Tax: " . $tax->format() . "\n";
echo "  Total: " . $total->format() . "\n";

// This would cause an error if uncommented:
// class CustomMoney extends Money {} // Fatal error: Class CustomMoney may not inherit from final class Money

echo "\n✓ Final class prevents inheritance, ensuring Money's logic remains intact\n";
echo "  This protects against breaking changes and security vulnerabilities\n\n";

// Real-world example: Final methods
echo "11. Final Methods - Preventing Method Override\n";
echo str_repeat("-", 50) . "\n";

/**
 * Base authentication class with critical security method
 */
class Authentication
{
    protected array $sessions = [];
    
    // This method is final - cannot be overridden in child classes
    final public function validateToken(string $token): bool
    {
        // Critical security logic that must not be altered
        echo "  [SECURITY] Validating token: " . substr($token, 0, 8) . "...\n";
        return hash('sha256', $token) === hash('sha256', 'secret_token_123');
    }
    
    // This method can be overridden
    public function login(string $username): string
    {
        $token = bin2hex(random_bytes(16));
        $this->sessions[$username] = $token;
        return $token;
    }
}

class OAuth2Authentication extends Authentication
{
    // We can override login method
    public function login(string $username): string
    {
        echo "  [OAuth2] Enhanced login for: $username\n";
        return parent::login($username);
    }
    
    // But we CANNOT override validateToken() - it's final
    // Uncommenting this would cause an error:
    // public function validateToken(string $token): bool {
    //     return true; // Fatal error: Cannot override final method
    // }
}

echo "Authentication with final methods:\n";
$auth = new OAuth2Authentication();
$token = $auth->login("john_doe");
echo "  Generated token: " . substr($token, 0, 16) . "...\n";

$isValid = $auth->validateToken("secret_token_123");
echo "  Token validation: " . ($isValid ? "✓ Valid" : "✗ Invalid") . "\n";

echo "\n✓ Final method validateToken() cannot be overridden in child classes\n";
echo "  This ensures critical security logic remains unchanged\n";
