<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BeoordelingController
 *
 * @author PimGame
 */
class DocentController {

    private $docentenModel;
    private $accountenModel;

    public function __construct() {
        if(!$_SESSION["admin"]) { header("location: index.php?p=home"); }
        include_once('Model' . DIRECTORY_SEPARATOR . 'Docenten.php');
        include_once('Model' . DIRECTORY_SEPARATOR . 'Accounten.php');
        $this->docentenModel = new Docenten();
        $this->accountenModel = new Accounten();
    }

    public function invoke() {

        if (isset($_GET["del"])) {
            $this->docentenModel->removeTeacher($_GET["del"]);
            $this->accountenModel->disableAccount($_GET["del"]);
            header("Location: index.php?p=docent");
        }

        $page = "View" . DIRECTORY_SEPARATOR . "Docent.php";

        $docenten = $this->docentenModel->getAllTeachers();


        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
