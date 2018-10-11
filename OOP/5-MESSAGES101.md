## Messages 101

MEssgaes a re a core component of OOP design.

**Hunt for the Nouns**

In this example we are going to look at a BUSINESS that hires a PERSON to join the STAFF

```php

class Person {
    protected $name;

    public function __construct($name){
        $this->name = $name;
    }
}

class Business {

protected $staff;

public function __construct(Staff $staff){
    $this->staff = $staff;
}

//Since we want to add the person, we can use what is called type hinting and inject the Person class into the method
    public function hire(Person $person){
            $this->staff->add($person);
    }

    public function getStaffMembers(){
        return $this->staff->members();
    }

}

class Staff {

    protected $members = [];

    public function __construct($members = []){

        $this->members = $members;
    }

    public function add (Person $person){

        $this->members[] = $person;

    }

    public function members(){
        return $this->members;
    }
}


$brendon = new Person('Brendon Douglas');

$staff = new Staff([$brendon]);

$acme = new Business($staff);

$acme->hire(new Person('Jane Doe'));

 var_dump($acme->getStaffMembers());

```