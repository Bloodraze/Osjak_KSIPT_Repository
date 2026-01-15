<?php
class Animal {
    protected $weight, $height, $name, $speed;
    public function __construct($weight, $height, $name, $speed = 0) {
        $this->weight = $weight;
        $this->height = $height;
        $this->name = $name;
        $this->speed = $speed;
    }
    public function sayHello() {
        echo "Привет, я " . $this->name;
    }
    public function __toString() {
        return get_class($this) . ": " . $this->name;
    }
}
?>