<?php

// abstract class Shape {

// private $color;
//     public function __construct($color = 'blue'){
//             $this->color = $color;
//     }

//     public function getColor(){
//         return $this->color;
//     }

//     public function setColor($color){
//         $this->color = $color;
//     }   

// }

// class Circle extends Shape {



// }

// $c = new Circle();

// $c->setColor('red');    

// echo $c->getColor();

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
        return pi() * pow($this->radius,2);
    }
}

$c = new Circle('red');

echo $c->getArea();