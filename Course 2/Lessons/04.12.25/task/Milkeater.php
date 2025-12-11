<?php
require_once 'Animal.php';
class Milkeater extends Animal {
    public function sayHello() {
        parent::sayHello();
        echo ", я млекопитающее.";
    }
}
?>