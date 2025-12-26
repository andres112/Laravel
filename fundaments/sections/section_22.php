<?php

/**
 * Classes
 */


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
echo $person->introduce() . "\n\n";

$anotherPerson = new Person("jane smith", 25);
echo $anotherPerson->introduce() . "\n\n";

// Inheritance example
// Inheritance allows a class to inherit properties and methods from another class
echo "Inheritance\n";
echo str_repeat("-", 50) . "\n";
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
echo $worker->introduce() . "\n\n";

$anotherWorker = new Employee($anotherPerson, "Designer");
echo $anotherWorker->introduce() . "\n\n";

// Polymorphism example
// Polymorphism allows methods to do different things based on the object it is acting upon
// Here, both Person and Employee have an introduce() method, but they behave differently
echo "Polymorphism\n";
echo str_repeat("-", 50) . "\n";
function displayIntroduction(Person $individual): void
{
    echo $individual->introduce() . "\n";
}

displayIntroduction($person);
displayIntroduction($worker);

// Encapsulation example
// Encapsulation restricts direct access to some of an object's components
echo "\nEncapsulation\n";
echo str_repeat("-", 50) . "\n";

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
echo "Initial balance: $" . $account->getBalance() . "\n";
$account->deposit(50);
echo "Deposited $50, new balance: $" . $account->getBalance() . "\n";
$account->withdraw(30);
echo "Withdrawed $30, new balance: $" . $account->getBalance() . "\n";
$account->withdraw(150);
echo "Attempted to withdraw $150, balance remains: $" . $account->getBalance() . "\n";

// Static properties and methods
echo "\nStatic Properties and Methods\n";
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

var_dump(
    MathHelper::$pi,
    MathHelper::calculateCircumference(5),
    MathHelper::square(4)
);

// Singleton Pattern with static method
echo "\nSingleton Pattern\n";
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

echo Dog::type();     // Dog
echo "\n";
echo Dog::whoSelf() . "\n";  // Animal

// Interfaces
echo "\nInterfaces and Abstract Classes\n";
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

    public function processPayment(float $amount): bool
    {
        // Common processing logic can go here
        return true;
    }

    public function refundPayment(float $amount): bool
    {
        return true;
    }
}

// Implement interface
class StripeProcessor extends OnlinePaymentProcessor
{

}

// Extend from abstract class
class PaypalProcessor extends OnlinePaymentProcessor
{
}