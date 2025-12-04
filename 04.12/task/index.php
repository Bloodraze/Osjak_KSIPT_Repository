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
foreach ($animals as $animal) {
    $animal->sayHello();
    echo '<br>';
}
?>
