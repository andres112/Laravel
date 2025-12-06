<?php

/**
 * Classes
 */


class Person {
    public string $name;
    public int $age;

    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function introduce(): string {
        return "Hello, my name is {$this->name} and I am {$this->age} years old.";
    }
}

$person = new Person("John Doe", 30);
echo $person->introduce() . "\n\n";

$anotherPerson = new Person("Jane Smith", 25);
echo $anotherPerson->introduce() . "";