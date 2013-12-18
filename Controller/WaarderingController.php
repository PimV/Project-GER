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
class WaarderingController {

    private $waarderingenModel;

    public function __construct() {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Waarderingen.php');
        $this->waarderingenModel = new Waarderingen();
    }

    public function invoke() {

        if (isset($_GET["del"])) {
            $this->waarderingenModel->removeRating($_GET["del"]);
            header("Location: index.php?p=waardering");
        }

        $waarderingen = $this->waarderingenModel->getAllRatings();

        $page = "View" . DIRECTORY_SEPARATOR . "Waardering.php";
        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
