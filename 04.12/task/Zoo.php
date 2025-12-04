<?php
class Zoo {
    private $name;
    private $zooKeepers = [];
    public function __construct($name) {
        $this->name = $name;
    }
    public function addKeeper($keeper) {
        $this->zooKeepers[] = $keeper;
    }
    public function printZoo() {
        echo "Зоопарк: {$this->name}\n";
        foreach ($this->zooKeepers as $keeper) {
            $keeper->printMyAnimals();
            echo "\n";
        }
    }
}
?>