<?php

spl_autoload_register();

// require_once('Animal.php');
// require_once('Bird.php');
// require_once('Milkeater.php');
// require_once('NotFlyBird.php');

$animals  = [];

$sparrow = new Bird(10, 100, 'Воробей', 50);
$animals [] = $sparrow;
$ant = new Animal(3,10,'Муравей');
$animals [] = $ant;
$monkey = new Milkeater(50, 40, 'Мартышка');
$animals [] = $monkey;
$penguin = new NotFlyBird(50,40, 'Пингвин', 100);
$animals [] = $penguin;

foreach ($animals as $animal){
    $animal->sayHello();
    echo '<br>';
}
?>
<p>

<!-- <?php 
echo '<h2> Задание 1</h2>';
class User{
    private $name;
    public function __construct($name){
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
    // public function setName($newName){
    //     $this->name = $newName;
    // }

    public function setName($newName){
        if($newName){
            $this->name = $newName;
            return true;
        }
        return false;
    }

}
$user1 = new User ('Воучик');
$res = $user1->setName ('Томас');
echo $res ? 'Имя изменено' : 'Имя не изменено';
?>
<p><?= $user1->getName() ?></p> -->

