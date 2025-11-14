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
            private $role;
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
            public static function makeAdmin($user) {
                $user->role = 'Admin';
            }
            public static function createAdmin($name, $age) {
                $admin = new User($name, $age);
                $admin->role = 'Admin';
                return $admin;
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
                self::$numberStudents++;
            }
            public function __destruct() {
                self::$numberStudents--;
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
            public static function getnumberStudents() {
                return self::$numberStudents;
            }
            public static function printStudentInfo($student) {
                echo "Студент: <b>{$student->getName()}</b>, возраст: <b>{$student->getAge()}</b>, курс: <b>{$student->getCourse()}</b>, группа: <b>{$student->getGroupe()}</b>.<br>";
            }
            public function sayAboutMe() {
                parent::sayAboutMe();
                echo "Курс: <b>{$this->course}</b>, Группа: <b>{$this->groupe}</b>.<br>";
            }
        }
        $students = [
            new Student("Аня Петрова", 20, 2, "Б123"),
            new Student("Максим Сидоров", 22, 3, "А456"),
            new Student("Елена Смирнова", 19, 1, "В789"),
            new Student("Дмитрий Козлов", 21, 4, "Г321"),
            new Student("Ольга Иванова", 23, 5, "Д654"),
        ];
        echo "Количество студентов: ", '<b>', Student::getnumberStudents(),'</b>', "<br>";
        unset($students[0], $students[1]);
        echo "Количество студентов после удаления: ", '<b>', Student::getnumberStudents(), '</b>', "<br>";
        foreach ($students as $student) {
            Student::printStudentInfo($student);
        }
        User::makeAdmin($students[2]);
        echo "Роль студента {$students[2]->getName()}: ", '<b>', $students[2]->getRole(), '</b>', "<br>";
        $admin = User::createAdmin("Администратор Новиков", 40);
        $admin->sayAboutMe();
        ?>
    </body>
</html>