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
class AccountEditController {

    private $docentenModel;
    private $docentModel;
    private $rechtenModel;
    private $accountModel;

    public function __construct() {
        include_once("Model" . DIRECTORY_SEPARATOR . "Docent.php");
        include_once("Model" . DIRECTORY_SEPARATOR . "Docenten.php");
        include_once("Model" . DIRECTORY_SEPARATOR . "Rechten.php");
        include_once("Model" . DIRECTORY_SEPARATOR . "Account.php");
        $this->docentenModel = new Docenten();
        $this->docentModel = new Docent();
        $this->rechtenModel = new Rechten();
        $this->accountModel = new Account();
    }

    public function invoke() {

        if (!empty($_POST)) {
            $this->saveData();
        }
        $levels = $this->rechtenModel->getAllLevels();
        $bestaatAl = false;
        if (isset($_GET['id'])) {
            $bestaatAl = true;

            $account = $this->accountModel->getAccountByKey($_GET['id'])[0];
        }




        $page = "View" . DIRECTORY_SEPARATOR . "AccountEdit.php";
        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

    private function saveData() {
        $pass = null;
        if (isset($_POST['newPass1']) && !(empty($_POST['newPass1']))) {
            $pass = $_POST['newPass1'];
        }
        if (isset($_GET["id"])) {

            $newUsername = $_POST['username'];
            include_once("Model" . DIRECTORY_SEPARATOR . "Accounten.php");
            $accountenModel = new Accounten();
            $oldUsername = "";
            $oldAccounts = $accountenModel->getAllActiveAccounts();
            $userExists = false;
            foreach ($oldAccounts as $oldAccount) {
                if ($newUsername === $oldAccount['gebruikersnaam']) {
                    $oldUsername = $oldAccount['gebruikersnaam'];
                    $userExists = true;
                    break;
                }
            }

            if ($newUsername === $_GET['id']) {
                
            } else {
                if ($userExists) {
                    $_SESSION['editError'] = "Deze gebruikersnaam is al in gebruik en kan dus niet opgeslagen worden.";
                    header("location: index.php?p=accountedit&id=" . $_GET['id']);
                    die;
                } else {
                    
                }
            }





            $activated = 1;
            if ($_POST['activated'] === 'true') {
                $activated = 0;
            }


            $this->accountModel->update(null, $_POST['username'], $pass, $_POST['level'], $activated, $_GET["id"]);
        } else {
            $this->accountModel->save($_POST['username'], $pass, $_POST['level']);
        }
        header("location: index.php?p=account");
    }

}
