# Encapsulation

As we saw before, even though we created a setter method that would restrict the age of a property, the property inside the class had a visibility of public, so this property could be changed after, defeating the purpose of having the age exception in our app.

When creating classes for an application, the goal is to hide as much properties and behaviour as possible.

The Person class in the previous example had public on all tyhe properties and methods, not good so let's look at how we can refine this class to be much more secure and protected

Encapsulation may be intimidating and a scary sounding word but in computer programming, its definition is:

**_Encapsulation is one of the fundamentals of OOP (object-oriented programming). It refers to the bundling of data with the methods that operate on that data.[5] Encapsulation is used to hide the values or state of a structured data object inside a class, preventing unauthorized parties' direct access to them. Publicly accessible methods are generally provided in the class (so-called getters and setters) to access the values, and other client classes call these methods to retrieve and modify the values within the object._**

Think about Encapsulation as putting a blackbox around your object and controlling what properties and methods will get exposed. (props and methods that are RELEVANT to the PUBLIC interface)

Here is an exmaple to illustrate that:

```php
//think of a light switch
class Switch {

    //The user ONLY needs to turn the switch ON or OFF, they are abstracted from the rest of the information in the switch
    public function on(){

    }

    public function off(){

    }

    public function connect(){

    }

    public function activate(){

    }

}

$switch = new Switch();
$switch->on();
$switch->connect();

```

Now there could be additional methods needed for the control of the switch like CONNECT and ACTIVATE but the public doesn't even need to know these exist. They just need ON or OFF, they should be allowed to do.  

## the Car Analogy
Think of it this way too.  You have a car and you turn the car on.  That is a public method, and that is all you need to know because the blueprint of a car has abstracted the user from all the other little things that are involved mechanically to turn the car on after the key is turned.  Same with brakes, sterring, accelerating etc.  these are all high level methods the owner has access to, but there are so many other processes (methods) that go along with performing those tasks that the owner has no idea of and has no control over. 

## PRIVATE and PROTECTED
The only real difference between the two is that the private keyword says this method or property can only be accessed within the class itself.  The PROTECTED keyword will make sure the props and methods using this word are protected from the public interface.  they can be accessed from instantiated classes, but not on the public interface.

So with PROTECTED, it comes down to inheritance.  If I create an object from the class, I can still have access to the inherited protected methods, not private.  PRIVATE says outside this class, no one or no extended class can have access to this property/method.

Let's look at the previous example of the Person class where we could override the public property of Age and how changing the visibility of the property can prevent this....easily.

```php
class Person {
    private $name;
    private $age;

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
$john->age = 3;
//Error -> Can not access private property Person $age.
$john->name = 'Dave';
//Error -> Can not access private property Person $name.

```

And that is encapsulation in a nutshell.