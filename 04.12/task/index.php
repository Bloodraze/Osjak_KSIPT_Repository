<?php
spl_autoload_register(function ($class_name) {
    $filename = $class_name . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    }
});
$json = file_get_contents('animals.json');
$animalsData = json_decode($json, true);
function createAnimal($data) {
    $type = $data['type'];
    $weight = $data['weight'] ?? 0;
    $height = $data['height'] ?? 0;
    $name = $data['name'] ?? '';
    $speed = $data['speed'] ?? 0;
    if (class_exists($type)) {
        return new $type($weight, $height, $name, $speed);
    }
    return new Animal($weight, $height, $name, $speed);
}
$animals = [];
foreach ($animalsData as $animalData) {
    $animals[] = createAnimal($animalData);
}
$keeper1 = new ZooKeeper("Иван");
$keeper2 = new ZooKeeper("Мария");
$keeper3 = new ZooKeeper("Петр");
$keeper1->addAnimal($animals[0] ?? new Animal());
$keeper2->addAnimal($animals[1] ?? new Animal());
$keeper3->addAnimal($animals[2] ?? new Animal());
foreach ($animals as $animal) {
    $animal->sayHello();
    echo '<br>';
}
echo "<h3>Информация о смотрителях:</h3>";
$keeper1->printMyAnimals();
echo '<br>';
$keeper2->printMyAnimals();
echo '<br>';
$keeper3->printMyAnimals();
?>