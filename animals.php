<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <!-- <h1>Задание 1</h1>
        <h2>Задание 1.1</h2>
        <?php
        // class User {
        //     public $firstName;
        //     public $lastName;
        //     public $email;
        //     public function __construct($firstName, $lastName, $email) {
        //         $this->firstName = $firstName;
        //         $this->lastName = $lastName;
        //         $this->email = $email;
        //     }
        //     public function sayAboutMe() {
        //         echo "Пользователь: $this->firstName $this->lastName<br>";
        //     }
        // }
        // $user1 = new User("Иван", "Иванов", "ivan@example.com");
        // $user2 = new User("Мария", "Петрова", "maria@example.com");
        // $user1->sayAboutMe();
        // $user2->sayAboutMe();
        // ?>
        // <h2>Задание 1.2</h2>
        // <?php
        // class Car {
            // public $brand;
            // public $model;
            // public $type;
            // public $color;
            // public $weight;
            // public function __construct($brand, $model, $type, $color, $weight) {
            //     $this->brand = $brand;
            //     $this->model = $model;
            //     $this->type = $type;
            //     $this->color = $color;
            //     $this->weight = $weight;
            // }
        //     public function getInfo() {
        //         echo "Модель: $this->brand $this->model $this->type, Цвет: $this->color<br>";
        //     }
        //     public function getWeight() {
        //         echo "Вес машины: $this->weight кг<br>";
        //     }
        // }
        // $car = new Car("Toyota", "Camry", "Sedan", "Черный", 1500);
        // $car->getInfo();
        // $car->getWeight();
        // ?>
        // <h2>Задание 1.3</h2>
        // <?php
        // class CarCollector extends Car {
        //     public $year;
        //     public $price;
        //     public function __construct($brand, $model, $type, $color, $weight, $year, $price) {
        //         parent::__construct($brand, $model, $type, $color, $weight);
        //         $this->year = $year;
        //         $this->price = $price;
        //     }
        //     public function getPrice() {
        //         return $this->price;
        //     }
        // }
        // $car1 = new CarCollector("Ferrari", "F40", "Sports", "Красный", 1100, 1987, 1200000);
        // $car2 = new CarCollector("Lamborghini", "Countach", "Sports", "Желтый", 1350, 1985, 1000000);
        // $car3 = new CarCollector("Bugatti", "EB110", "Sports", "Синий", 1595, 1991, 1500000);
        // $car4 = new CarCollector("Porsche", "911", "Sports", "Белый", 1400, 1998, 800000);
        // $car5 = new CarCollector("Mercedes", "300SL", "Classic", "Серебристый", 1350, 1955, 700000);
        // $totalPrice = $car1->getPrice() + $car2->getPrice() + $car3->getPrice() + $car4->getPrice() + $car5->getPrice();
        // echo "Общая стоимость коллекции: $totalPrice руб.<br>";
        ?>-->
        <h1>Задание 2</h1>
        <h2>Задание 2.1</h2>
        <?php
        class User {
            public $firstName;
            public $lastName;
            public $email;
            public function __construct($firstName, $lastName, $email) {
                $this->firstName = mb_substr($firstName, 0, 128);
                $this->lastName = mb_substr($lastName, 0, 128);
                $this->email = $email;
            }
            public function sayAboutMe() {
                echo "Пользователь: {$this->firstName} {$this->lastName}<br>";
            }
        }
        $user1 = new User("Иван", "Иванов", "ivan@example.com");
        $user2 = new User("Мария", "Петрова", "maria@example.com");
        $user1->sayAboutMe();
        $user2->sayAboutMe();
        ?>
        <h2>Задание 2.2</h2>
        <?php
        class Car {
            public $brand, $model, $type, $color, $weight;
            public function __construct($brand, $model, $type, $color = 'черный', $weight = 0) {
                $this->brand = $brand;
                $this->model = $model;
                $this->type = $type;
                $this->color = $color;
                $this->weight = $weight;
            }
            public function getInfo() {
                echo "{$this->brand} {$this->model} ({$this->type}), цвет: {$this->color}<br>";
            }
            public function getWeight() {
                return $this->weight;
            }
        }
        $myCar = new Car('Toyota', 'Camry', 'Sedan');
        $myCar->getInfo();
        ?>
        <h2>Задание 2.3</h2>
        <?php
        $cars = [
            ['brand' => 'BMW', 'model' => 'X5', 'type' => 'SUV', 'color' => 'белый', 'weight' => 2200],
            ['brand' => 'Audi', 'model' => 'A4', 'type' => 'седан', 'color' => 'черный', 'weight' => 1800],
            ['brand' => 'Mercedes', 'model' => 'C200', 'type' => 'седан', 'color' => 'синий', 'weight' => 1900],
            ['brand' => 'Toyota', 'model' => 'RAV4', 'type' => 'кроссовер', 'color' => 'зеленый', 'weight' => 2100],
            ['brand' => 'Honda', 'model' => 'Civic', 'type' => 'седан']
        ];
        echo "<pre>";
        echo "Массив машин:<br>";
        print_r($cars);
        echo "</pre>";
        ?>
        <h2>Задание 2.4</h2>
        <?php
        $objCars = [];
        foreach ($cars as $car) {
            $color = $car['color'] ?? 'черный';
            $weight = $car['weight'] ?? 0;
            $objCars[] = new Car($car['brand'], $car['model'], $car['type'], $color, $weight);
        }
        echo "Созданы объекты класса Car:<br>";
        foreach ($objCars as $objCar) {
            echo $objCar->getInfo();
        }
        ?>
        <h2>Задание 2.5</h2>
        <?php
        echo $objCars[0]->getInfo();
        echo $objCars[1]->getInfo();
        echo $objCars[2]->getInfo();
        echo $objCars[3]->getInfo();
        echo $objCars[4]->getInfo();
        ?>
    </body>
</html>