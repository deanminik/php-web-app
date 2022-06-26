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
          /**
           * When we insert the student, we recover the id with this, $idStudent = $bdconnectionBD->lastInsertId();
           * this will be useful to make the relationship the student with the courses 
           */
            foreach ($courses as $course) {
              $sql = "INSERT INTO course_student (id, id_student, id_course) VALUES (NULL,:id_student,:id_course)";
              $query=$bdconnectionBD->prepare($sql);
              $query->bindParam(':id_student', $idStudent);//from the last student inserted $idStudent
              $query->bindParam(':id_course', $course);
              $query->execute();
            }
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
    $studentCourses = $query->fetchAll();
    //We save the request in an array
    $students[$key]['courses'] = $studentCourses;
}
// print_r($students);

//here is to give al course to select in the select tag of the form
$sql = "SELECT * FROM courses";
$coursesList = $bdconnectionBD->query($sql);
$courses=$coursesList->fetchAll();
// var_dump($courses);

