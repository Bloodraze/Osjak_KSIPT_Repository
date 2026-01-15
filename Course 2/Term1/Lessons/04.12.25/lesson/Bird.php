<?php
class Bird extends Animal {
    public $wingspan;
    public function __construct( $height, $weight, $type, $wingspan){
        parent::__construct( $height, $weight, $type);
    }
    public function sayHello(){
        parent::sayHello();
        echo  "у меня крылья $this->wingspan см ";
    }
}