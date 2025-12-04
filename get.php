<?php
$data = file_get_contents('users.json');
$users = json_decode($data, true);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    $users['students'] = array_filter($users['students'], fn($user) => (int)$user['id'] !== $deleteId);
    $users['teachers'] = array_filter($users['teachers'], fn($user) => (int)$user['id'] !== $deleteId);
    $users['managers'] = array_filter($users['managers'], fn($user) => (int)$user['id'] !== $deleteId);
    $users['students'] = array_values($users['students']);
    $users['teachers'] = array_values($users['teachers']);
    $users['managers'] = array_values($users['managers']);
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
$students = $users['students'];
$teachers = $users['teachers'];
$managers = $users['managers'];
class User {
    private $name, $age;
    public function __construct($arr) {
        $this->setName($arr['Name']);
        $this->setAge($arr['Age']);
    }
    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }
    public function getAge() { return $this->age; }
    public function setAge($age) { $this->age = $age; }
}
class Student extends User {
    private $course, $group;
    public function __construct($arr) {
        parent::__construct($arr);
        $this->setCourse($arr['Course']);
        $this->setGroup($arr['Group']);
    }
    public function getCourse() { return $this->course; }
    public function setCourse($course) { $this->course = $course; }
    public function getGroup() { return $this->group; }
    public function setGroup($group) { $this->group = $group; }
    public function SayAboutMe() {
        return "<b>Студент:</b> " . $this->getName() . ", <b>возраст:</b> " . $this->getAge()
            . ", <b>курс:</b> " . $this->getCourse() . ", <b>группа:</b> " . $this->getGroup();
    }
    public static function getAll($data) {
        return array_map(fn($s) => ['obj' => new Student($s), 'id' => $s['id'] ?? null], $data);
    }
}
class Teacher extends User {
    private $subjects;
    public function __construct($arr) {
        parent::__construct($arr);
        $this->setSubjects($arr['Subjects']);
    }
    public function getSubjects() { return $this->subjects; }
    public function setSubjects($subjects) { $this->subjects = $subjects; }
    public function SayAboutMe() {
        $subjectsStr = is_array($this->getSubjects()) ? implode(', ', $this->getSubjects()) : $this->getSubjects();
        return "<b>Учитель:</b> " . $this->getName() . ", <b>возраст:</b> " . $this->getAge() . ", <b>предметы:</b> " . $subjectsStr;
    }
    public static function getAll($data) {
        return array_map(fn($t) => ['obj' => new Teacher($t), 'id' => $t['id'] ?? null], $data);
    }
}
class Manager extends User {
    private $positions, $jobDuties;
    public function __construct($arr) {
        parent::__construct($arr);
        $this->setPositions($arr['Positions']);
        $this->setJobDuties($arr['jobDuties']);
    }
    public function getPositions() { return $this->positions; }
    public function setPositions($positions) { $this->positions = $positions; }
    public function getJobDuties() { return $this->jobDuties; }
    public function setJobDuties($jobDuties) { $this->jobDuties = $jobDuties; }
    public function SayAboutMe() {
        $dutiesStr = is_array($this->getJobDuties()) ? implode(', ', $this->getJobDuties()) : $this->getJobDuties();
        return "<b>Менеджер:</b> " . $this->getName() . ", <b>возраст:</b> " . $this->getAge()
            . ", <b>должность:</b> " . $this->getPositions() . ", <b>обязанности:</b> " . $dutiesStr;
    }
    public static function getAll($data) {
        return array_map(fn($m) => ['obj' => new Manager($m), 'id' => $m['id'] ?? null], $data);
    }
}
function generateNewId($users) {
    $allIds = [];
    foreach (['students', 'teachers', 'managers'] as $key) {
        foreach ($users[$key] ?? [] as $user) {
            if (isset($user['id'])) $allIds[] = (int)$user['id'];
        }
    }
    return empty($allIds) ? 1 : max($allIds) + 1;
}
$studentObjects = Student::getAll($students);
$teacherObjects = Teacher::getAll($teachers);
$managerObjects = Manager::getAll($managers);
$userObjects = array_merge($studentObjects, $teacherObjects, $managerObjects);
foreach ($userObjects as $userData) {
    $obj = $userData['obj'];
    $id = $userData['id'];
    if ($id === null) continue;
    echo $obj->SayAboutMe() . ' ';
    echo '<form method="POST" style="display: inline;">';
    echo '<input type="hidden" name="delete_id" value="' . $id . '">';
    echo '<button type="submit" onclick="return confirm(\'Удалить пользователя?\')">Удалить</button>';
    echo '</form><br>';
}
?>