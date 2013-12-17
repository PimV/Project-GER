<?php

// This file is the entry point of the website and acts like a router. 
// Depending on the URL received from the user, the correct controller will be created. 
//Start the session.
session_start();

//Sessie admin variable welke op true staat als volgens de DB de ingelogde een admin level heeft
$_SESSION["admin"] = true;
//Docent id in sessie opslaan als het om een docent gaat, hebben we nodig op resultaten pagina (voor coach)
$_SESSION["docentId"] = 0;

include_once 'Model/GlobalSettings.php';            //Static class with global settings.
include_once 'Controller/DatabaseConnector.php';    //Static class for database connections
//Get the page to open. Homepage default if none specified. 
if (isset($_GET["p"]) && !empty($_GET["p"])) {
    $page = $_GET["p"];
} else {
    $page = "login";
}

$array = array(
    "login",
    "home",
    "beoordeling",
    "beoordelingedit",
    "groep",
    "groepedit",
    "studentsearch",
    "student",
    "studentedit",
    "resultaat",
    "export",
    "klas",
    "klasedit",
    "rubriek",
    "rubriekedit",
    "ajaxresultaatklassen",
    "ajaxresultaatresultaten",
    "blok",
    "blokedit",
    "docent",
    "docentedit"
);

foreach ($array as $arrayPage)
{
    if ($page == $arrayPage)
    {
        if ($page == $arrayPage)
        {
            $page .= "Controller";
            include_once ("Controller" . DIRECTORY_SEPARATOR . "$page.php");
            $displayPage = new $page();
            $displayPage->invoke();
            return;
        }
    }
}
DatabaseConnector::closeConnection();
?>
