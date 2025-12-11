<?php
require_once 'Animal.php';
class NotFlyBird extends Animal {
    public function sayHello() {
        parent::sayHello();
        echo ", я нелетающая птица.";
    }
}
?>