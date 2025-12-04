<?php
class ZooKeeper {
    private $name;
    private $animals = [];
    public function __construct($name) {
        $this->name = $name;
    }
    public function addAnimal($animal) {
        $this->animals[] = $animal;
    }
    public function printMyAnimals() {
    echo "Смотритель: {$this->name}\n";
    if (empty($this->animals)) {
        echo "- Животных нет\n";
    } else {
        foreach ($this->animals as $animal) {
            echo "- " . $animal . "\n";
        }
    }
}
}
?>
