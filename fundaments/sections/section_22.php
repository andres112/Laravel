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

echo "Inheritance\n";
echo str_repeat("-", 50) . "\n";

// Inheritance example
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