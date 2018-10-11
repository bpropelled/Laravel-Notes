# Inheritance

Inheritance should be easy to understand.  Think of it like this, just like you inherited traits from your mom and dad, the same goes for objects (kids) from classes (parents).

In PHP, this can be done using the "extend" keyword like this

```php
class Mother {
    public function getEyeCount(){
        return 2;
    }
}

//The child class extends the Mother class
class Child extends Mother {
    
}
```

In the example above, the child class will inherit the getEyeCount method automatically because we extended the mother class, so this is an exmaple:

```php
$child = new Child();
$child->getEyeCount(); //-> 2
//OR a simpler way (new Child)->getEyeCount()//->2;
```

Cool right!

You see this a lot in laravel, let's say you are making a model and need access to the wonderful Eloquent methods.  By extending a subclass (Post), it INHERITS things from the BASE CLASS (Eloquent)
```php

class Post extends Eloquent {
    //...
}

$post = new Post();
//Now you can use Eloqueent methods because our SUBCLASS extended the BASE CLASS of Eloquent
//so you can do things like 
$post->save();
$post->update();
$post->first();
//and so on and so on

```

There is also another useful way to use inheritance.

## Overriding Base Class props/methods in a subclass
In this example, we will have a method on the base class that calculates the area.  this is all good, but a calulating the area of a triangle is much different than a square.

```php
class Shape {

    protected length = 4;

    public function getArea(){
        return pow($this->length, 2);//16
        //or
        // return $this->length * $this->length;
    }

}

class Square extends Shape {

}

class Triangle extends Shape {
    protected $base = 4;
    protected $height = 7;

    public function getArea(){
        return .5 * $this->base * $this->height;
    }

}

$square = new Square();
$triangle = new Triangle();

$square->getArea(); // => 16
$triangle->getArea();//=> 14
```

This is important to understand because even though the subclass inherited the getArea from the Shape class, it was able to override it with it's own getArea method.

#### In OOP, the SubClass will override the Parent class

In a crude way, you can think of it like this.  A girl inherits traits from her mother, let's say breast size.  i know i know, this is not PC but let's continue.  If the daughter gets older and decides she is not happy with her breast size, her being the subclass can override her inherited breast size and get them augmented.  Therefore she has overridden her inherited traits with her own property for the same trait.

## Abstract Classes
In the exmaple above, they all inherit from the SHAPE class, but the getArea method is different for each shape, so consider this.
```php
class Shape {
// can keep this blank so we have flec
}

class Square extends Shape {
   protected length = 4;
    public function getArea(){
        return pow($this->length, 2);//16
        //or
        // return $this->length * $this->length;
    }
}

class Triangle extends Shape {
    protected $base = 4;
    protected $height = 7;
    public function getArea(){
        return .5 * $this->base * $this->height;
    }

class Circle extends Shape {

}

}

(new Circle)->getArea();
//ERRORCall to undefined Method
```

But what if we wanted to enforce that everytime you create a shape inheritted object, that you must include a getArea method.  Sort of like a contract.  Well we can do this using abstract classes or an interface (which will be reviewed in later notes).

Abstract classes are confusing and most of the time it is hard to grasp what they are and used for, but let's see if we can define it here.

1. So yes we can instantite a blank/empty parent class like shape
```php
$shape = new Shape();
//=> 
```
In this case, we never want to instantitate a base class, only subclasses like Circle, Square, TRiangle etc
2. So we make the Shapew base class an  abstract class like so
```php
abstract class Shape{
    //
}
```

**__So ABSTRACT CLASSES mean Yes I want to add functionility (props/methods) to the base class BUT I NEVER WANT IT TO BE INSTANTIATED, ONLY INHERITED__**

EXAMPLE:
```PHP
$shape = new Shape();
//FATAL ERROR => Can't instantiate abstract class Shape
```

Let's look at adding a construct to the abstract shape class so it will REQUIRE a color in order to be created
```php
abstract class Shape {
    protected $color;
    public function __construct($color){
        $this->color = $color;
    }
}
```
So if we now try to instantiate a subclass without the required property
```php
$square = new Square();
// ERROR: Missing Argument for Shape::construct
$square = new Sqaure('blue');
$square->color;
//blue
```

Now what if we wanted our base class to have a default color so if no argumenst were provided, it will use the default.  This is simple and you have probably seen it before, simply assign the argument a value in the construct method

```php
abstract class Shape{
    protected $color;

    public function __construct($color = 'red'){
        $this->color = color;
    }
}

//So we can either pass a color as an argument and it will use that
$circle = new Circle('blue');
$circle->color;//blue

//Or if no argument is supplied it will use the default we defgined in the base class
$square = new Square();
$square->color; //red
```
#### Even better, use Encapsulation (Getter and Setter) on the abstract

```php

abstract class Shape {
    protected $color;

    public function __construct($color = 'red'){
        $this->color = color;
    }

    public function getColor(){
        return $this->color;
    }

}
$circle = new Circle('blue');
$circle->getColor();//blue

$square = new Square();
$square->getColor(); //red
```

## Abstract Methods
Just like providing an abstract class, you can create abstract methods too.  An abstract method is an empty function that requires instantiated onjects to have the method defined in the base class.  So like in the Shape example, where every subclass has a getArea() method, and each one of these methods is different depending on the subclass of shape (eg.  getting the area of a circle is different than getting the area of a square), you define the method on the subclass as well.

**If an abstract method is defined, any subclass must have the same method defined inside the subclass**

Example:

```php

abstract class Shape {

    protected $color;

    public function __construct($color){
        $this->color = $color;
    }

//Notice an abstract method is blank and does not need curly braces
    abstract public function getArea();

}

class Circle extends Shape {
    protected $radius = 5;

    public function getArea() {
        return pi() * pow($radius,2);
    }
}
```
