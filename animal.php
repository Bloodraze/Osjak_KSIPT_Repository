<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        class User {
            protected $name;
            protected $age;
            public function __construct($name, $age) {
                $this->name = $this->correctName($name);
                $this->age = $age;
            }
            public function getName() {
                return $this->name;
            }
            public function setName($name) {
                $this->name = $this->correctName($name);
            }
            public function getAge() {
                return $this->age;
            }
            public function setAge($age) {
                $this->age = $age;
            }
            public function sayAboutMe() {
                echo "Меня зовут <b>{$this->name}</b>, мне <b>{$this->age}</b> лет.<br>";
            }
            protected function correctName($name) {
                $name = strip_tags($name);
                if (mb_strlen($name) > 128) {
                    $name = mb_substr($name, 0, 128);
                }
                return $name;
            }
        }
        class Student extends User {
            private $course;
            private $groupe;
            public function __construct($name, $age, $course, $groupe) {
                parent::__construct($name, $age);
                $this->course = $course;
                $this->groupe = $groupe;
            }
            public function getCourse() {
                return $this->course;
            }
            public function setCourse($course) {
                $this->course = $course;
            }
            public function getGroupe() {
                return $this->groupe;
            }
            public function setGroupe($groupe) {
                $this->groupe = $groupe;
            }
            public function sayAboutMe() {
                parent::sayAboutMe();
                echo "Курс: <b>{$this->course}</b>, Группа: <b>{$this->groupe}</b>.<br>";
            }
        }
        $user = new User("Иван <b>Иванов</b>", 30);
        $student1 = new Student("Аня Петрова", 20, 2, "Б123");
        $student2 = new Student("Максим Сидоров", 22, 3, "А456");
        $user->sayAboutMe();
        $student1->sayAboutMe();
        $student2->sayAboutMe();
        ?>
    </body>
</html>