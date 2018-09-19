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