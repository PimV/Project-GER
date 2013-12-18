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
class WaarderingEditController {

    private $waarderingenModel;

    public function __construct() {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Waarderingen.php');
        include_once('Model' . DIRECTORY_SEPARATOR . 'Waardering.php');
        $this->waarderingenModel = new Waarderingen();
    }

    public function invoke() {

        if (!empty($_POST)) {
            $this->saveData();
        }

        if (isset($_GET['id'])) {
            $result = $this->waarderingenModel->getRating($_GET['id']);
            $waardingResult = $result[0];
            $waardering = new Waardering();
            $waardering->setDescription($waardingResult['omschrijving']);
            $waardering->setRating($waardingResult['waardering']);
            $waardering->setId($_GET['id']);
        }

        $page = "View" . DIRECTORY_SEPARATOR . "WaarderingEdit.php";
        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

    private function saveData() {

        $waardering = new Waardering();
        if (isset($_GET['id'])) {
            $rawWaardering = $this->waarderingenModel->getRating($_GET['id']);
            $waardering->setDescription($_POST['omschrijving']);
            $waardering->setRating($_POST['cijfer']);
            $waardering->setId($_GET['id']);
            $waardering->update();
        } else {
            $waardering->setDescription($_POST['omschrijving']);
            $waardering->setRating($_POST['cijfer']);
            $waardering->save();
        }

        header("location: index.php?p=waardering");
    }

}
