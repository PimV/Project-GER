<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BeoordelingEditController
 *
 * @author PimGame
 */
class BeoordelingEditController {

    private $studentenModel;
    private $rubriekenModel;

    public function __construct() {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Studenten.php');
        include_once('Model' . DIRECTORY_SEPARATOR . 'Rubrieken.php');
        $this->studentenModel = new Studenten();
        $this->rubriekenModel = new Rubrieken();
    }

    public function invoke() {
        $page = "View" . DIRECTORY_SEPARATOR . "BeoordelingEdit.php";
        $rubrieken = $this->rubriekenModel->getAllRubrics();
        $studenten = $this->studentenModel->getStudentsFromClass($_GET["id"]);



        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
