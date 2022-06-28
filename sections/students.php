<?php

include_once '../settings/bd.php';
$bdconnectionBD = BD::createInstance();



$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$Lastname = isset($_POST['Lastname']) ? $_POST['Lastname'] : '';

$courses = isset($_POST['courses']) ? $_POST['courses'] : '';

$action = isset($_POST['action']) ? $_POST['action'] : '';

// print_r($_POST['action']);


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
                $query = $bdconnectionBD->prepare($sql);
                $query->bindParam(':id_student', $idStudent); //from the last student inserted $idStudent
                $query->bindParam(':id_course', $course);
                $query->execute();
            }
            break;

        case 'Select':
            // echo 'Press select';
            // echo $id;
            $sql = "SELECT * FROM students WHERE id=:id";
            $query = $bdconnectionBD->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $student = $query->fetch(PDO::FETCH_ASSOC);
            // $id = $student['id'];
            $name = $student['name'];
            $Lastname = $student['Lastname'];

            //Select of the courses
            /**
             * 1- we select the id of table course_student (this the table with relationship)
             * 2- Then we add it with courses
             * 3- course, the id, will be equal to course_student table, the id_course
             * 4- when, course_student table, id_student will be equal to id_student" 
             */
            $sql = "SELECT courses.id FROM course_student INNER JOIN courses ON courses.id = course_student.id_course
            WHERE course_student.id_student=:id_student";
            $query = $bdconnectionBD->prepare($sql);
            $query->bindParam(':id_student', $id);
            $query->execute();
            $coursesOfStudent = $query->fetchAll(PDO::FETCH_ASSOC);
            print_r($coursesOfStudent);

            foreach ($coursesOfStudent as $course) {

                // echo $course['id'];
                $coursesArray[] = $course['id']; // we add all courses in a list 

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
$courses = $coursesList->fetchAll();
// var_dump($courses);
