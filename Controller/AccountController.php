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
class AccountController {

    private $accountenModel;

    public function __construct() {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Accounten.php');
        $this->accountenModel = new Accounten();
    }

    public function invoke() {



        if (isset($_GET["del"])) {
            $this->accountenModel->removeAccount($_GET["del"]);
            header("Location: index.php?p=account");
        }

        $accounts = $this->accountenModel->getAllAccounts();

        $page = "View" . DIRECTORY_SEPARATOR . "Account.php";



        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
