<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Задание 1-8</h1>
        <?php
        class User {
            private $firstName;
            private $lastName;
            private $email;
            public function __construct($firstName, $lastName, $email) {
                $this->firstName = $this->correctName($firstName);
                $this->lastName = $this->correctName($lastName);
                $this->email = $email;
                if (!$this->isNameCorrect($this->firstName)) {
                    echo "<b>Имя некорректно при создании пользователя:</b> {$this->firstName}", '<br>';
                }
                if (!$this->isNameCorrect($this->lastName)) {
                    echo "<b>Фамилия некорректна при создании пользователя:</b> {$this->lastName}", '<br>';
                }
                if (!$this->isEmailCorrect($this->email)) {
                    echo "<b>Email некорректен при создании пользователя:</b> {$this->email}", '<br>';
                }
            }
            public function getFirstName() {
                return $this->firstName;
            }
            public function setFirstName($firstName) {
                $firstName = $this->correctName($firstName);
                if (!$this->isNameCorrect($firstName)) {
                    echo "<b>Имя некорректно при изменении:</b> {$firstName}", '<br>';
                } else {
                    $this->firstName = $firstName;
                }
            }
            public function getLastName() {
                return $this->lastName;
            }
            public function setLastName($lastName) {
                $lastName = $this->correctName($lastName);
                if (!$this->isNameCorrect($lastName)) {
                    echo "<b>Фамилия некорректна при изменении:</b> {$lastName}", '<br>';
                } else {
                    $this->lastName = $lastName;
                }
            }
            public function getEmail() {
                return $this->email;
            }
            public function setEmail($email) {
                if (!$this->isEmailCorrect($email)) {
                    echo "<b>Email некорректен при изменении:</b> {$email}", '<br>';
                } else {
                    $this->email = $email;
                }
            }
            public function sayAboutMe() {
                echo "<b>Пользователь:</b> {$this->firstName} {$this->lastName}", '<br>';
            }

            private function isNameCorrect($name) {
                return mb_strlen($name) <= 128;
            }
            private function isEmailCorrect($email) {
                $atPos = strpos($email, '@');
                $dotPos = strrpos($email, '.');
                return $atPos !== false && $dotPos !== false && $dotPos > $atPos;
            }
            private function correctName($name) {
                $name = strip_tags($name);
                if (mb_strlen($name) > 128) {
                    $name = mb_substr($name, 0, 128);
                }
                return $name;
            }
        }
        $user1 = new User("Иван", "Иванов", "ivan@mail.com");
        $user2 = new User("Петр", "Петров", "petr.mail.com");
        $user1->setFirstName("Сергей");
        $user1->setEmail("sergey@mail.com");
        echo "<b>Пользователь 1: </b>", $user1->getFirstName(), " " , $user1->getLastName(), ", Email: ", $user1->getEmail(), '<br>';
        echo "<b>Пользователь 2: </b>", $user2->getFirstName(), " ", $user2->getLastName(), ", Email: ", $user2->getEmail(), '<br>';
        ?>
    </body>
</html>