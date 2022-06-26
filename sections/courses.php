<?php

// INSERT INTO `courses` (`id`, `course_name`) VALUES (NULL, 'Webs site with PHP'); 
include_once '../settings/bd.php';
$bdconnectionBD = BD::createInstance();

print_r($_POST); //this will print the data of the form

$query = $bdconnectionBD->prepare("SELECT * FROM courses");
$query->execute();

$coursesList = $query->fetchAll();

// print_r($coursesList);
