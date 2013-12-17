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
class DocentEditController {

    private $docentenModel;

    public function __construct() {
        include_once("Model" . DIRECTORY_SEPARATOR . "Docent.php");
        include_once("Model" . DIRECTORY_SEPARATOR . "Docenten.php");
        $this->docentenModel = new Docenten();
    }

    public function invoke() {


        $docent = null;
        if (isset($_GET['id'])) {
            $docentId = (int) $_GET['id'];
            $temp_docent = $this->docentenModel->getTeacher($docentId)[0];
            $temp_rubrieken = $this->docentenModel->getRubricsByTeacher($docentId);
            $temp_rollen = $this->docentenModel->getRollenByTeacher($docentId);
          //TODO $temp_all_rollen = $this->rollenModel->getAllRollen();
          //TODO  $temp_all_rubrieken = $this->rubriekenModel->getAllRubrics();
            $docent = new Docent();
            $docent->setFirstName($temp_docent['voornaam']);
            $docent->setInsert($temp_docent['tussenvoegsel']);
            $docent->setLastName($temp_docent['achternaam']);
            $docent->setMail($temp_docent['mail']);
            $docent->setRollen($temp_rollen);
            $docent->setRubrics($temp_rubrieken);
        }
        $page = "View" . DIRECTORY_SEPARATOR . "DocentEdit.php";
        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
