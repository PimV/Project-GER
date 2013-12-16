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
class BeoordelingController {

    private $klassen;

    public function __construct() {
        include_once('Model'.DIRECTORY_SEPARATOR.'Klassen.php');
        $this->klassen = new Klassen();
    }

    public function invoke() {
        $page = "View" . DIRECTORY_SEPARATOR . "Beoordeling.php";
        $klassen_view = $this->klassen->getAllClassesNoResult_array();
        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
