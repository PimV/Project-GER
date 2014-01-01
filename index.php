<?php
// This file is the entry point of the website and acts like a router. 
// Depending on the URL received from the user, the correct controller will be created. 
//Start the session.
session_start();

if(!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = false; //True wanneer er een gebruiker is ingelogd.
    $_SESSION['username'] = NULL;
    $_SESSION['admin'] = false; //True wanneer een admin is ingelogd.
    $_SESSION['docentId'] = NULL; //Beschikbaar wanneer docent is ingelogd. Om onder andere zijn coach klassen op te halen.
}
//
////TODO: verwijder tijdelijke test waardes
//$_SESSION['loggedin'] = true;
//$_SESSION['username'] = "Admin+docent testUser";
//$_SESSION["admin"] = true;
//$_SESSION["docentId"] = 2;

include_once 'Model/GlobalSettings.php';            //Static class with global settings.
include_once 'Controller/DatabaseConnector.php';    //Static class for database connections

//Get the page to open. Homepage default if none specified. 
if (isset($_GET["p"]) && !empty($_GET["p"])) {
    $page = strtolower($_GET["p"]);
} else {
    $page = "home";
}

if(!$_SESSION['loggedin']) {
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
    "docentedit",
    "profiel",
    "waardering",
    "waarderingedit"
);

foreach ($array as $arrayPage) {
    if ($page == $arrayPage) {
        if ($page == $arrayPage) {
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
