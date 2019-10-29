<?php
/*
 / Decorator Pattern allows us to add functionality to existing object without modifying that object
 / by wrapping around that object.
 */

interface IShape {
   function draw();
}

class Circle implements IShape {

    function draw()
    {
        return "Drawing Circle";
    }
}


class Triangle implements IShape {

    function draw()
    {
        return "Drawing Triangle";
    }
}

abstract class ShapeDecorator implements IShape {
    protected $shape;

    public function __construct(IShape $shape)
    {
        $this->shape = $shape;
    }
    abstract public function draw();
}

class BorderShape extends ShapeDecorator {

    public function draw()
    {
        $result = $this->shape->draw();
        return "$result has border";
    }
}

class RedShape extends ShapeDecorator {

    public function draw()
    {
        $result = $this->shape->draw();
        return "$result is red";
    }
}

$circle = new Circle();
$circle = new RedShape($circle);
$circle = new BorderShape($circle);
echo $circle->draw();
