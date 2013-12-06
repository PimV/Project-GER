<?php

// This file is the entry point of the website and acts like a router. 
// Depending on the URL received from the user, the correct controller will be created. 

//Start the session.
session_start();

include_once 'Model/GlobalSettings.php';            //Static class with global settings.
include_once 'Controller/DatabaseConnector.php';    //Static class for database connections

//Get the page to open. Homepage default if none specified. 
if(isset($_GET['p']) && !empty($_GET['p']))
{
    $page = $_GET['p'];
}
else
{
    $page = "home";
}

//Main routing functionality.
switch ($page) {
    case "home":
        include_once("Controller/HomeController.php"); 
        $homeController = new HomeController(); 
        $homeController->invoke(); 
        break;
    case "resultaten":
        include_once("Controller/ResultatenController.php"); 
        $resultatenController = new ResultatenController(); 
        $resultatenController->invoke(); 
        break;
    case "resultaat":
        include_once("Controller/ResultaatController.php"); 
        $resultaatController = new ResultaatController(); 
        $resultaatController->invoke(); 
        break;
    default:
        //Custom 'page does not exist' page.
        echo("This is not the page you are looking for.");
        break;
}

DatabaseConnector::closeConnection();
?>