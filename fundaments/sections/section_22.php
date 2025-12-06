<?php

/**
 * Classes
 */


class Person {
    // Using property promotion to declare and initialize properties
    // public string $name;
    // public int $age;

    public function __construct(public string $name, public int $age) {
        // Use property promotion (PHP 8.0+) instead of manual assignments
        // $this->name = $name;
        // $this->age = $age;
        
        $this->name = ucwords($name);
    }

    public function introduce(): string {
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
class Employee extends Person {
    public function __construct(public Person $person, public string $position) {
        parent::__construct($person->name, $person->age);
    }

    public function introduce(): string {
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
function displayIntroduction(Person $individual): void {
    echo $individual->introduce() . "\n";
}

displayIntroduction($person);
displayIntroduction($worker);

// Encapsulation example
// Encapsulation restricts direct access to some of an object's components
echo "\nEncapsulation\n";
echo str_repeat("-", 50) . "\n";

class BankAccount {
    private float $balance;

    public function __construct(float $initialBalance = 0) {
        $this->balance = $initialBalance;
    }

    public function deposit(float $amount): void {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }

    public function withdraw(float $amount): bool {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return true;
        }
        return false;
    }

    public function getBalance(): float {
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