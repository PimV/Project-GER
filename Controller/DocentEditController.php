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
    private $docentModel;
    private $rechtenModel;
    private $accountModel;

    public function __construct() {
        if (!$_SESSION["admin"]) {
            header("location: index.php?p=home");
        }
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

        $docent = null;
        $docentId = null;
        $account = null;
        $bestaatAl = false;
        $levels = $this->rechtenModel->getAllLevels();
        $temp_rollen_not_assigned = $this->docentenModel->getRollenNotAssignedByTeacher($docentId);
        $temp_rubrieken_not_assigned = $this->docentenModel->getRubricsNotAssignedByTeacher($docentId);
        if (isset($_GET['id'])) {
            $docentId = (int) $_GET['id'];
            $account = $this->accountModel->getAccount($docentId)[0];
            $temp_docent = $this->docentenModel->getTeacher($docentId)[0];
            $temp_rubrieken_assigned = $this->docentenModel->getRubricsByTeacher($docentId);
            $temp_rollen_assigned = $this->docentenModel->getRollenByTeacher($docentId);
            $temp_rollen_not_assigned = $this->docentenModel->getRollenNotAssignedByTeacher($docentId);
            $temp_rubrieken_not_assigned = $this->docentenModel->getRubricsNotAssignedByTeacher($docentId);
            $docent = new Docent();
            $docent->setFirstName($temp_docent['voornaam']);
            $docent->setInsert($temp_docent['tussenvoegsel']);
            $docent->setLastName($temp_docent['achternaam']);
            $docent->setMail($temp_docent['mail']);
            $docent->setRollen($temp_rollen_assigned);
            $docent->setRubrics($temp_rubrieken_assigned);
            $bestaatAl = true;
        }




        $page = "View" . DIRECTORY_SEPARATOR . "DocentEdit.php";
        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

    private function saveData() {
        $pass = null;
        if (isset($_POST['newPass1']) && !(empty($_POST['newPass1']))) {

            $pass = $_POST['newPass1'];
        }
        if (isset($_GET["id"])) {
            //Update class.

            $newMail = $_POST['mail'];
            $allMailsRaw = $this->docentenModel->fetchMailsOnly();
            $newMailExists = false;
            foreach ($allMailsRaw as $row) {
                if ($newMail === $row['mail']) {
                    $newMailExists = true;
                    break;
                }
            }
            $oldDocent = $this->docentenModel->getTeacher($_GET['id']);
            if (count($oldDocent) > 0) {
                $oldDocent = $oldDocent[0];
                if ($oldDocent['mail'] === $newMail) {
                    
                } else {

                    if ($newMailExists) {
                        $_SESSION['editError'] = "Dit e-mailadres bestaat al en kan niet worden opgeslagen.";
                        header("location: index.php?p=docentedit&id=" . $_GET['id']);
                        die;
                    } else {
                        $this->docentModel->setMail($_POST["mail"]);
                    }
                }
            }

            $newUsername = $_POST['username'];
            include_once("Model" . DIRECTORY_SEPARATOR . "Accounten.php");
            $accountenModel = new Accounten();
            $allUsersRaw = $accountenModel->getAllActiveAccounts();
            $userExists = false;
            foreach ($allUsersRaw as $userRaw) {
                if ($newUsername === $userRaw['gebruikersnaam']) {
                    $userExists = true;
                    break;
                }
            }

            $oldAccount = $this->accountModel->getAccount($_GET['id']);
            if (count($allUsers) > 0) {
                $oldAccount = $oldAccount[0];
                $oldUserName = $oldAccount['gebruikersnaam'];
                if ($oldUserName === $newUsername) {
                    //Niets aanpassen
                } else {
                    if ($userExists) {
                        $_SESSION['editError'] = "Username kan niet aangepast worden, bestaat namelijk al!";
                        header("location: index.php?p=docentedit&id=" . $_GET['id']);
                        die;
                    } else {
                        var_dump("Username aangepast!");
                    }
                }
            }

            unset($_SESSION['editError']);




            $this->docentModel->setFirstName($_POST["voornaam"]);
            $this->docentModel->setInsert($_POST["tussenvoegsel"]);
            $this->docentModel->setLastName($_POST["achternaam"]);
            $this->docentModel->setMail($_POST["mail"]);
            $this->docentModel->setRollen($_POST["rollen"]);
            $this->docentModel->setRubrics($_POST["rubrieken"]);
            $this->docentModel->setId($_GET["id"]);

            $this->docentModel->update();
            $this->accountModel->update($_GET["id"], $_POST['username'], $pass, $_POST['level']);
        } else {
            //Create new class.
            $this->docentenModel->addTeacher(
                    $_POST["voornaam"], $_POST["tussenvoegsel"], $_POST["achternaam"], $_POST["mail"], $_POST["rollen"], $_POST["rubrieken"]);
            $this->accountModel->save($_POST['username'], $pass, $_POST['level']);
        }
        header("location: index.php?p=docent");
    }

}
