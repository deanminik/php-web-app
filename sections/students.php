<?php

include_once '../settings/bd.php';
$bdconnectionBD = BD::createInstance();

// print_r($_POST);



$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$Lastname = isset($_POST['Lastname']) ? $_POST['Lastname'] : '';

$courses = isset($_POST['courses']) ? $_POST['courses'] : '';

$action = isset($_POST['action']) ? $_POST['action'] : '';



if ($action != '') {
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO students (id, name, Lastname) VALUES (NULL,:name,:Lastname)";
            $query = $bdconnectionBD->prepare($sql);
            $query->bindParam(':name', $name);
            $query->bindParam(':Lastname', $Lastname);
            $query->execute();
            $idStudent = $bdconnectionBD->lastInsertId();
            break;

    }
}



$sql = "SELECT * FROM students";
$studentList = $bdconnectionBD->query($sql);
$students = $studentList->fetchAll();

foreach ($students as $key => $student) {
//Select all Courses that the user has    
$sql = "SELECT * FROM courses WHERE id IN (SELECT id_course FROM course_student WHERE id_student = :id_student)"; 

$query = $bdconnectionBD->prepare($sql);
$query->bindParam(':id_student', $student['id']);
$query->execute();
$studentCourses=$query->fetchAll();
//We save the request in an array
$students[$key]['courses']=$studentCourses;
}
// print_r($students);
