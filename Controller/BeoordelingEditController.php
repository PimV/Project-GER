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

    public function __construct() {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Studenten.php');
        $this->studentenModel = new Studenten();
    }

    public function invoke() {
        $page = "View" . DIRECTORY_SEPARATOR . "BeoordelingEdit.php";
        $studenten = $this->studentenModel->getAllStudents_array();
        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
