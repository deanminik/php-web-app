<?php

// INSERT INTO `courses` (`id`, `course_name`) VALUES (NULL, 'Webs site with PHP'); 
include_once '../settings/bd.php';
$bdconnectionBD = BD::createInstance();

//Conditional: Is there a value in ID? no, ok add empty space ''
$id = isset($_POST['id']) ? $_POST['id'] : '';
$course_name = isset($_POST['course_name']) ? $_POST['course_name'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';

// print_r($_POST); //this will print the data of the form
// echo $id;
// echo $course_name;

if ($action != '') {
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO courses (id, course_name) VALUES (NULL,:course_name)";
            $query = $bdconnectionBD->prepare($sql);
            $query->bindParam(':course_name', $course_name);
            $query->execute();
            echo $sql;
            break;

        case 'edit':
            $sql = "UPDATE courses SET course_name='$course_name' WHERE id=$id";
            echo $sql;
            break;

        case 'delete':
            $sql = "DELETE FROM courses WHERE id=$id";
            echo $sql;
            break;

        case 'select':
            $sql = "SELECT *FROM courses WHERE id=:id";
            $query = $bdconnectionBD->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();

            $course = $query->fetch(PDO::FETCH_ASSOC);
            break;
    }
}

//__________________________________________________


$query = $bdconnectionBD->prepare("SELECT * FROM courses");
$query->execute();

$coursesList = $query->fetchAll();

// print_r($coursesList);
