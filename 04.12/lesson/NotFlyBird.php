<?php 
class NotFlyBird extends Bird{
    public function sayHello(){
        parent::sayHello();
        echo ", я не могу летать ):";
    }
}