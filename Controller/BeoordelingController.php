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

    public function __construct() {
        
    }

    public function invoke() {
        $page = "View" . DIRECTORY_SEPARATOR . "Beoordeling.php";

        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
