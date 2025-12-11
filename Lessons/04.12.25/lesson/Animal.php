<?php
class Animal {
    public function __construct(public $height = 80 ,public $weight = 50,public $type = 'Тигр'){
        $this->height = $height;
        $this->weight = $weight;
        $this->type = $type;

    }
    public function sayHello(){
        echo "<br>Привет! Я $this->type ";
    }
} 