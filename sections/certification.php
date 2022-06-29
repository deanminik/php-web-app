<?php
require('../libraries/fpdf/fpdf.php');
include_once("../settings/bd.php");

$bdconnectionBD = BD::createInstance();


function addText($pdf, $text, $x, $y, $size = 10, $font, $align = 'L', $r = 0, $g = 0, $b = 0)
{
    $pdf->SetFont($font, "", $size);
    $pdf->SetXY($x, $y);
    $pdf->SetTextColor($r, $g, $b);
    $pdf->Cell(0, 10, $text, 0, 0, $align);

    // $pdf->Text($x, $y, $text);
}
function addImage($pdf, $image, $x, $y)
{
    $pdf->Image($image, $x, $y, 0);
}

//In this case is get, beacuse we are getting the result by the url  
//print_r($_GET); // Exmaple -> Array ( [idcourse] => 1 [idstudent] => 2 ) After the submited form 

$idcourse = isset($_GET['idcourse']) ? $_GET['idcourse'] : '';
$idstudent = isset($_GET['idstudent']) ? $_GET['idstudent'] : '';

$sql = "SELECT students.name, students.Lastname, courses.course_name
FROM students, courses 
WHERE students.id=:idstudent AND courses.id=:idcourse";
$query = $bdconnectionBD->prepare($sql);
$query->bindParam(':idstudent', $idstudent);
$query->bindParam(':idcourse', $idcourse);
$query->execute();
$student = $query->fetch(PDO::FETCH_ASSOC);

// print_r($student['name'] . "" . $student['Lastname']);
// print_r($student['course_name']);

$pdf = new FPDF("L", "mm", array(254, 194));
$pdf->AddPage();
$pdf->setFont("Arial", "B", 16);
addImage($pdf, "../src/certification.jpg", 0, 0);
// addText($pdf, "Dean", 60, 70, 'L', "Helvetica", 30, 0, 84, 115);
addText($pdf, ucwords(utf8_decode($student['name'] . "" . $student['Lastname'])), 60, 70, 'L', "Helvetica", 30, 0, 84, 115);
// addText($pdf, "Sitio web", 60, 100, 'C', "Helvetica", 20, 0, 84, 115);
addText($pdf, ucwords(utf8_decode($student['course_name'])), 60, 100, 'C', "Helvetica", 20, 0, 84, 115);
// addText($pdf, "01/01/2022", -350, 155, 'L', "Helvetica", 11, 0, 84, 115);
addText($pdf, date("d/m/Y"), -350, 150, 'C', "Helvetica", 11, 0, 84, 115);
$pdf->Output();



// connectedArray ( [name] => Oscar Nery [Lastname] => Fernández Bryant [course_name] => Webs site tutorial ) 


/*

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Hello World!');
$pdf->Output();
*/