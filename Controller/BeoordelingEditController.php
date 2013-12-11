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

    public function __construct() {
        
    }

    public function invoke() {
        //$klasId = $_GET["klas_id"];
        $page = "View" . DIRECTORY_SEPARATOR . "BeoordelingEdit.php";
        $pagehead = "BeoordelingHead.php";

        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
