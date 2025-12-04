<?php
echo '<h2>Приватные свойства</h2>';

class User{
    private $name;
    private $animals = [];
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

public function sayAboytMe(){
    echo "Меня зовут: $this->name <br>";
    echo "Мои животные:<br>";
    foreach($this->animals as $animal){
        echo $animal->getName(), '<br>';
    }
    }

    public function addAnimal($animal){
        $this->animals[] = $animal;
    }
}

$user1 = new  User ('Воучик');
$res = $user1->setName ('Томас');
echo $res ? 'Имя изменено' : 'Имя не изменено';
?>
<p><?= $user1->getName() ?></p>

<?php
// echo '<h2>Задание 1</h2>';

// class Users {

//     private $firstName;
//     private $lastName;
//     private $email; 

//     public function __construct($firstName, $lastName, $email) {
//         $this->firstName = $firstName;
//         $this->lastName = $lastName;
//         $this->email = $email;
//     }

//     public function getFirstName() {
//         return $this->firstName;
//     }

//     public function getLastName() {
//         return $this->lastName;
//     }

//     public function getEmail() {
//         return $this->email;
//     }

//     public function sayAboutMe() {
//         echo "Имя фамилия: " . $this->firstName . " " . $this->lastName;
//     }


//     private function isNameCorrect($lastName) {
//         return strlen($lastName) <= 128;
//     }
//         public function isEmailCorrect($email) {
//         if (strpos($email, '@') == false or strpos($email, '.') == false) {
//             return false;
//         }
//         $atPosition = strpos($email, '@');
//         $lastDotPosition = strrpos($email, '.');

        
//         return $lastDotPosition > $atPosition;
//         }
//          public function setFirstName($firstName) {
//         if ($this->isNameCorrect($firstName)) {
//             $this->firstName = $firstName;
//             return true;
//         }
//         return false;
//     }
//     public function setLastName($lastName) {
//         if ($this->isNameCorrect($lastName)) {
//             $this->lastName = $lastName;
//             return true;
//         }
//         return false;
//     }

//     public function setEmail($email) {
//         if ($this->isEmailCorrect($email)) {
//             $this->email = $email;
//             return true;
//         }
//         return false;
//     }
// }

// $user1 = new Users("Паша", "Лотков; ", "pashok2008@gmail.com");
// $user1->sayAboutMe(); 
// echo "Email: " . $user1->getEmail();

// echo "<br></br>Проверка:";
// echo "<br>Слишком длинного имени: " . ($user1->setFirstName(str_repeat("", 129)) ? "Нет ошибки" : "Ошибка");
// echo "<br>Корректного email (без @): " . ($user1->setEmail("pashok2008@gmail.com") ? "Нет ошибки" : "Ошибка");
// echo "<br>Корректного email (точка до @): " . ($user1->setEmail("pashok2008@gmail.com") ? "Нет ошибки" : "Ошибка");
?>
<?php
echo '<h2>Задание 1</h2>';

class Users {
    private $firstName;
    private $lastName;
    private $email; 

    public function __construct($firstName, $lastName, $email) {
        if (!$this->isNameCorrect($firstName)) {
            echo "<br><strong>Ошибка:</strong> Имя '$firstName' слишком длинное (более 128 символов)!<br>";
        } else {
            $this->firstName = $firstName;
        }

        if (!$this->isNameCorrect($lastName)) {
            echo "<br><strong>Ошибка:</strong> Фамилия '$lastName' слишком длинная (более 128 символов)!<br>";
        } else {
            $this->lastName = $lastName;
        }

        if (!$this->isEmailCorrect($email)) {
            echo "<br><strong>Ошибка:</strong> Email '$email' некорректен (нет @, нет точки после @ или точка до @)!<br>";
        } else {
            $this->email = $email;
        }
    }

    public function getFirstName() { 
        return $this->firstName; 
}
    public function getLastName()  { 
        return $this->lastName; 
}
    public function getEmail()     { 
        return $this->email; 
}

    public function sayAboutMe() {
        echo "Имя фамилия: " .  $this->getFirstName() . " " . $this->getLastName() . "<br>";
}

    private function isNameCorrect($name): bool {
        return is_string($name) and strlen(trim($name)) <= 128 and trim($name) !== '';
}

    private function isEmailCorrect($email): bool {
        $email = trim($email);
        $atPos = strpos($email, '@');
        if ($atPos == false) return false;

        $afterAt = substr($email, $atPos + 1);
        $lastDotPos = strrpos($afterAt, '.');

        return $lastDotPos != false and $lastDotPos < strlen($afterAt) - 1;
}

    public function setFirstName($firstName) {
        if ($this->isNameCorrect($firstName)) {
            $this->firstName = $firstName;
            return true;
        }
        return false;
}

    public function setLastName($lastName) {
        if ($this->isNameCorrect($lastName)) {
            $this->lastName = $lastName;
            return true;
        }
        return false;
}

    public function setEmail($email) {
        if ($this->isEmailCorrect($email)) {
            $this->email = $email;
            return true;
        }
        return false;
}
}


echo "<h3>Пользователь 1 (корректный):</h3>";
$user1 = new Users("Паша", "Лотков", "pashok2008@gmail.com");
$user1->sayAboutMe();
echo "Email: " . $user1->getEmail() . "<br>";

echo "<h3>Пользователь 2 (с ошибками):</h3>";
$user2 = new Users(
    str_repeat("Арик", 130),           
    "Мастросов",                       
    "invalid.email@com"            
);

echo "Имя: " .  $user2->getFirstName() . '<br>' ;
echo "Фамилия: " .  $user2->getLastName() . '<br>' ;
echo "Email: " .  $user2->getEmail() . '<br>' ;
?>