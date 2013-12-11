<?php

// This file is the entry point of the website and acts like a router. 
// Depending on the URL received from the user, the correct controller will be created. 

//Start the session.
session_start();

//Sessie admin variable welke op true staat als volgens de DB de ingelogde een admin level heeft
$_SESSION["admin"] = true;
//Docent id in sessie opslaan als het om een docent gaat, hebben we nodig op resultaten pagina (voor coach)
$_SESSION["docentId"] = 3;

include_once 'Model/GlobalSettings.php';            //Static class with global settings.
include_once 'Controller/DatabaseConnector.php';    //Static class for database connections

//Get the page to open. Homepage default if none specified. 
if(isset($_GET["p"]) && !empty($_GET["p"]))
{
    $page = $_GET["p"];
}
else
{
    $page = "home";
}

//Main routing functionality.
switch ($page) {
    case "groep":
        include_once("Controller/GroepController.php"); 
        $groepController = new GroepController(); 
        $groepController->invoke(); 
        break;
    case "groepedit":
        include_once("Controller/GroepEditController.php"); 
        $groepEditController = new GroepEditController(); 
        $groepEditController->invoke(); 
        break;
    case "home":
        include_once("Controller/HomeController.php"); 
        $homeController = new HomeController(); 
        $homeController->invoke(); 
        break;
    case "studentsearch":
        include_once("Controller/StudentSearchController.php"); 
        $studentSearchController = new StudentSearchController(); 
        $studentSearchController->invoke(); 
        break;
    case "resultaat":
        include_once("Controller/ResultaatController.php"); 
        $resultaatController = new ResultaatController(); 
        $resultaatController->invoke(); 
        break;
    case "klas":
        include_once("Controller/KlasController.php");
        $klasController = new KlasController();
        $klasController->invoke();
        break;
    case "klasedit":
        include_once("Controller/KlasEditController.php");
        $klasEditController = new KlasEditController();
        $klasEditController->invoke();
        break;
    case "student":
        include_once("Controller/StudentController.php");
        $studentController = new StudentController();
        $studentController->invoke();
        break;
    case "studentedit":
        include_once("Controller/StudentEditController.php");
        $studentEditController = new StudentEditController();
        $studentEditController->invoke();
        break;
    case "export":
        include_once("Controller/ExportController.php");
        $exportController = new ExportController();
        $exportController->invoke();
        break;
    default:
        //Custom 'page does not exist' page.
        echo("This is not the page you are looking for.");
        break;
}

DatabaseConnector::closeConnection();
?>
