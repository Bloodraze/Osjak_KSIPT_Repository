<?php
class User {
    private $type;
    private $name;
    private $age;
    public function __construct($type, $arr = null) {
        $this->setType($type);
        if ($arr !== null) {
            $this->setName($arr['Name']);
            $this->setAge($arr['Age']);
        }
    }
    public function getType() {
        return $this->type;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getAge() {
        return $this->age;
    }
    public function setAge($age) {
        $this->age = $age;
    }
}
class Student extends User {
    private $course;
    private $group;
    public function __construct($arr) {
        parent::__construct('student', $arr);
        $this->setCourse($arr['Course']);
        $this->setGroup($arr['Group']);
    }
    public function getCourse() {
        return $this->course;
    }
    public function setCourse($course) {
        $this->course = $course;
    }
    public function getGroup() {
        return $this->group;
    }
    public function setGroup($group) {
        $this->group = $group;
    }
    public function SayAboutMe() {
        return "<b>Студент:</b> " . $this->getName()
            . ", <b>возраст:</b> " . $this->getAge()
            . ", <b>курс:</b> " . $this->getCourse()
            . ", <b>группа:</b> " . $this->getGroup();
    }
}
class Teacher extends User {
    private $subjects;
    public function __construct($arr) {
        parent::__construct('teacher', $arr);
        $this->setSubjects($arr['Subjects']);
    }
    public function getSubjects() {
        return $this->subjects;
    }
    public function setSubjects($subjects) {
        $this->subjects = $subjects;
    }
    public function SayAboutMe() {
        $subjectsStr = is_array($this->getSubjects())
            ? implode(', ', $this->getSubjects())
            : $this->getSubjects();
        return "<b>Учитель:</b> " . $this->getName()
            . ", <b>возраст:</b> " . $this->getAge()
            . ", <b>предметы:</b> " . $subjectsStr;
    }
}
class Manager extends User {
    private $positions;
    private $jobDuties;
    public function __construct($arr) {
        parent::__construct('manager', $arr);
        $this->setPositions($arr['Positions']);
        $this->setJobDuties($arr['jobDuties']);
    }
    public function getPositions() {
        return $this->positions;
    }
    public function setPositions($positions) {
        $this->positions = $positions;
    }
    public function getJobDuties() {
        return $this->jobDuties;
    }
    public function setJobDuties($jobDuties) {
        $this->jobDuties = $jobDuties;
    }
    public function SayAboutMe() {
        $dutiesStr = is_array($this->getJobDuties())
            ? implode(', ', $this->getJobDuties())
            : $this->getJobDuties();
        return "<b>Менеджер:</b> " . $this->getName()
            . ", <b>возраст:</b> " . $this->getAge()
            . ", <b>должность:</b> " . $this->getPositions()
            . ", <b>обязанности:</b> " . $dutiesStr;
    }
}
if (file_exists('users1.json')) {
    $data = file_get_contents('users1.json');
    $users = json_decode($data, true)['users'];
} else {
    $users = [];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['Name'])) {
    $newStudent = [
        'Type'   => 'student',
        'Name'   => $_POST['Name'],
        'Age'    => $_POST['Age'],
        'Course' => $_POST['Course'],
        'Group'  => $_POST['Group']
    ];
    $users[] = $newStudent;
    file_put_contents(
        'users1.json',
        json_encode(['users' => $users], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
    );
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
$factory = function($user) {
    switch ($user['Type']) {
        case 'student':
            return new Student($user);
        case 'teacher':
            return new Teacher($user);
        case 'manager':
            return new Manager($user);
        default:
            return null;
    }
};
$objUsers = array_map($factory, $users);
$objUsers = array_filter($objUsers);
$lines = array_map(fn($obj) => $obj->SayAboutMe(), $objUsers);
?>
<form method="POST" style="margin-bottom:20px;">
    <input type="text"   name="Name"   placeholder="Имя"     required>
    <input type="number" name="Age"    placeholder="Возраст" required>
    <input type="number" name="Course" placeholder="Курс"    required>
    <input type="text"   name="Group"  placeholder="Группа"  required>
    <button type="submit">Добавить студента</button>
</form>
<?php
echo implode('<br>', $lines);
?>