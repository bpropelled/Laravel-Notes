# Getters and Setters
This topic can be confusiong for newbies but let's follow the example to get a better understanding of getters and setters

```php
class Person {

    public $name;
    public $age;

    public function __construct($name){
        $this->name = $name;
    }

}

$john = new Person('John Doe');
//assignm johns age
$john->age =30;

//Lets say we want to chan ge his age later, we could
$john->age++;
```

### So how do getters and setters fit into this situation
The reason why we use getter and setter methods is to give ourselves a bit of protection and security

Let's say our application does not allow people under the age of 18.
```php
$john->age = 17;
```

## Setter Method
So let's create a setter method.  **Setter method names always start with "set"**  
```php

class Person {

    public $name;
    public $age;

    public function __construct($name){
        $this->name = $name;
    }

    public function setAge($age){

        if($age < 18){
            throw new Exception('Person is not old enough to access this app');
        }else{
            $this->age = $age;
        }
    }

}

$john = new Person('John Doe');
$john->setAge(30);

$dave = new Person('Dave Snow');
$dave->setAge(17);
//Exception:  Person is not old enough to access this app

```

See how the setAge setter method has not allowed us to create an age for Dave because he is under 18.  Cool right.  This way were are not setting the age explicitly.

So basically there could be behaviour that we want when setting and getting properties (eg. age restriction) so if we just allow explicit property assignment like $john->age = 30, we have no way of binding that behaviour to the assignment.

Also, when creating classes, just because there is no behaviour of property assignment now, does not mean there wont be in the future.  So it is always best to use getter and setter methods to future proof an application

## Getter Methods
similar to above, getter methods start with 'get'  in the method name like so
```php
class Person {
    public $name, $age;

    public function __construct($name){
        $this->name = $name;
    }

      public function setAge($age){

        if($age < 18){
            throw new Exception('Person is not old enough to access this app');
        }else{
            $this->age = $age;
        }
    }

    //Getter
    public function getAge(){
        return $this->age;
    }
}
```

So why use a getter instead of just using return $john->age?  Well because there could be "BEHAVIOR" needed down the line that we can not do just be using the property.  For exmaple, let's say donw the road, a manager wants the age returned in days now.  We can do this by modifying the getter method.
```php
class Person {
    public $name, $age;

    public function __construct($name){
        $this->name = $name;
    }

      public function setAge($age){

        if($age < 18){
            throw new Exception('Person is not old enough to access this app');
        }else{
            $this->age = $age;
        }
    }

    //Getter
    public function getAge(){
        // old Way
        // return $this->age;
        //Behaviour way
        return $this->age * 365;
    }
}

$john = new Person('john doe');
$john->setAge(30);
$john->getAge();
//10,950
```

## BUT
so everything looks good, we have an exception for if the age is under 18, but what if the age property is changed directly like so
```php
$john->age = 3;
$john->getAge();
//1095
```

See what happened there, even though we have the exception for under 18, the proeprty can still be accessed outside the class and changed.  no no no no..

**ENTER ENCAPSUALTION**

