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

    public function __construct() {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Docenten.php');
        $this->docentenModel = new Docenten();
    }

    public function invoke() {

        if (isset($_GET["del"])) {
            $this->docentenModel->removeTeacher($_GET["del"]);
            header("Location: index.php?p=docent");
        }

        $page = "View" . DIRECTORY_SEPARATOR . "Docent.php";

        $docenten = $this->docentenModel->getAllTeachers();


        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
