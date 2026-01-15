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
            protected $role;
            public function __construct($name, $age) {
                $this->name = $this->correctName($name);
                $this->age = $age;
                $this->role = 'User';
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
            public function getRole() {
                return $this->role;
            }
            protected function correctName($name) {
                $name = strip_tags($name);
                if (mb_strlen($name) > 128) {
                    $name = mb_substr($name, 0, 128);
                }
                return $name;
            }
            public function sayAboutMe() {
                echo "Меня зовут <b>{$this->name}</b>, мне <b>{$this->age}</b> лет, роль: <b>{$this->role}</b>.<br>";
            }
        }
        class Student extends User {
            private $course;
            private $groupe;
            private static $numberStudents = 0;
            public function __construct($name, $age, $course, $groupe) {
                parent::__construct($name, $age);
                $this->course = $course;
                $this->groupe = $groupe;
                $this->role = 'Студент';
                self::$numberStudents++;
            }
            public function __destruct() {
                self::$numberStudents--;
            }
            public function getCourse() {
                return $this->course;
            }
            public function getGroupe() {
                return $this->groupe;
            }
            public static function getnumberStudents() {
                return self::$numberStudents;
            }
            public function sayAboutMe() {
                echo "Я студент.<br>";
                parent::sayAboutMe();
                echo "Курс: <b>{$this->course}</b>, Группа: <b>{$this->groupe}</b>.<br>";
            }
        }
        class Teacher extends User {
            private $subjects;
            public function __construct($name, $age, $subjects=[]) {
                parent::__construct($name, $age);
                $this->subjects = $subjects;
                $this->role = 'Преподаватель';
            }
            public function getSubjects() {
                return $this->subjects;
            }
            public function setSubjects($subjects) {
                $this->subjects = $subjects;
            }
            public function sayAboutMe() {
                echo "Я преподаватель.<br>";
                parent::sayAboutMe();
                echo "Веду предметы: <b>", implode(', ', $this->subjects), "</b>.<br>";
            }
        }
        class Manager extends User {
            private $position;
            private $jobDuties;
            public function __construct($name, $age, $position, $jobDuties=[]) {
                parent::__construct($name, $age);
                $this->position = $position;
                $this->jobDuties = $jobDuties;
                $this->role = 'Администрация';
            }
            public function getPosition() {
                return $this->position;
            }
            public function setPosition($position) {
                $this->position = $position;
            }
            public function getJobDuties() {
                return $this->jobDuties;
            }
            public function setJobDuties($duties) {
                $this->jobDuties = $duties;
            }
            public function sayAboutMe() {
                echo "Я сотрудник администрации.<br>";
                parent::sayAboutMe();
                echo "Должность: <b>{$this->position}</b>.<br>";
                echo "Обязанности: <b>", implode(', ', $this->jobDuties), "</b>.<br>";
            }
        }
        $persons = [
            new Student("Анна Петрова", 20, 2, "Б123"),
            new Teacher("Иван Иванов", 45, ["Математика", "Физика"]),
            new Manager("Сергей Смирнов", 38, "Директор", ["Управление", "Контроль", "Организация"]),
            new Student("Максим Сидоров", 22, 3, "А456"),
            new Teacher("Мария Кузнецова", 34, ["История"]),
            new Manager("Елена Новикова", 30, "Зам. директора", ["Документооборот", "Координация"]),
            new Student("Ольга Иванова", 21, 1, "В789")
        ];
        usort($persons, function($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });
        foreach ($persons as $person) {
            $person->sayAboutMe();
            echo "<hr>";
        }
        $winnerIndex = rand(0, count($persons) - 1);
        $winner = $persons[$winnerIndex];
        echo "<h3>Победитель розыгрыша:</h3>";
        $winner->sayAboutMe();
        ?>
    </body>
</html>