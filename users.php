<?php
$data = file_get_contents('users.json');
$users = json_decode($data, true);
$students = $users['students'];
$teachers = $users['teachers'];
$managers = $users['managers'];
class User {
    private $name;
    private $age;
    public function __construct($arr) {
        $this->setName($arr['Name']);
        $this->setAge($arr['Age']);
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
        parent::__construct($arr);
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
        return "<b>Студент:</b> " . $this->getName() . ", <b>возраст:</b> " . $this->getAge()
            . ", <b>курс:</b> " . $this->getCourse() . ", <b>группа:</b> " . $this->getGroup();
    }
}
class Teacher extends User {
    private $subjects;
    public function __construct($arr) {
        parent::__construct($arr);
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
        return "<b>Учитель:</b> " . $this->getName() . ", <b>возраст:</b> " . $this->getAge()
            . ", <b>предметы:</b> " . $subjectsStr;
    }
}
class Manager extends User {
    private $positions;
    private $jobDuties;
    public function __construct($arr) {
        parent::__construct($arr);
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
        return "<b>Менеджер:</b> " . $this->getName() . ", <b>возраст:</b> " . $this->getAge()
            . ", <b>должность:</b> " . $this->getPositions() . ", <b>обязанности:</b> " . $dutiesStr;
    }
}
$studentObjects = array_map(fn($s) => new Student($s), $students);
$teacherObjects = array_map(fn($t) => new Teacher($t), $teachers);
$managerObjects = array_map(fn($m) => new Manager($m), $managers);
$userObjects = array_merge($studentObjects, $teacherObjects, $managerObjects);
$lines = array_map(fn($obj) => $obj->SayAboutMe(), $userObjects);
echo implode('<br>', $lines);
?>