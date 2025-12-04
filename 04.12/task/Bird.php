<?php
require_once 'Animal.php';
class Bird extends Animal {
    public function sayHello() {
        parent::sayHello();
        echo ", я птица.";
    }
}
?>