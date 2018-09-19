# OOP 101 - Classes
These are my notes from Laracasts OOP course.

You can think of classes as a blueprint for what you want to do.  Let's say you are building a task class, well this would be a blueprint for what a task is and does.

One thing to note right off that bat is that variables inside classes shouldn't really be seen as variables, but more like PROPERTIES.  

```php

class Task {
//class variables should have visibility defined, like public, private or protected
//Public means this property can be accessed by anyone outside the class and this is the default visibility
public $description = "this is a test";

}
```

Once you have a class defined, you can then go ahead and instantiate this class to create **A NEW OBJECT**.  That is key, we are not creating a class, we are using classes to be the blueprints for our objects.  OOP!
```php
$task = new Task();

$task->description;
//-> This is a test
```

## Construct
The above example is all good if you intend on having your objects all the same, but remeber classes are blueprints for obnjects and not all objects are the same.  Think of it like this, a Car is a class that has some similar properties across all amkes and models.  It has four tires, a sterring wheel, brakes etc. This is the blueprint for a Car.  But make, model, color, options; these are all things that are different for each object.  yes they inherit the blueprint of the Car but you will need to define what is different for each object.  This is where the __contruct magic method comes in.  This allows us to construct a new object using defined properties when the class is instantiated.

When you have a __construct method, this method will be immediatly called evertyime you instantiate a new object of that class.

NOTE: The parameters you supply the __construct function are called ARGUMENTS.  

**Methods**
Below you will see a function and the word public in front of it.  normally with functions you can just go ahead and use the function word, but **if a function is inside a class, it is not called a function, it is called a method**.


```php
class Task {

    public $description;

    public function __construct($description){
//this syntax will assign the description property with what was supplied as an argument in the __construct method during instantitation
            $this->description = $description;
    }

}

$task = new Task('This is a test');
//and here is how it works as a blueprint, we will instantiate another object from the same class but with different properties
$task2 = new Task(' This is the second object');
$task->description;
//->This is a test
$task2->description;
//->This is the second object
```

### Okay okay, so what is "$this"
In the above example, you see there is a property called $this.  You can think of this property as a way of referring to this object.  This instance of our class.


##Using Methods
as stated before, a method is a function that is inside a class/object

```php
class Task {

    public $description;
    public $completed = false;

    public function __construct($description){
//this syntax will assign the description property with what was supplied as an argument in the __construct method during instantitation
            $this->description = $description;
    }

    //Add a method to complete the task
    public function complete(){
        $this->completed = true;
    }

}

$task = new Task('this is a test');
$task2 = new Task('get groceries');
//complete the task using a method
$task->complete();

Var_dump($task->completed);
//-> true
var_dump($task2->complete);
//->false
```

## Multiple properties from construct arguments
Let's say you want to add a title and description for each task 
```php
class Task {
    public $title, $description;

    public function __construct($title, $description){
        $this->title = $title;
        $this->description = $description;
    }

}

$task = new Task('Get Dogs', 'Go to the house and pickup the friggin dogs');

$task->title; // Get Dogs
$task->description; // Go to the house and pickup the friggin dogs
```