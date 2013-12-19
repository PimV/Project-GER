<?php

class ProfielController
    {

    private $loginModel;
    private $PasswordError;

    public function __construct()
        {
        include_once 'Model' . DIRECTORY_SEPARATOR . 'Account.php';
        $this->loginModel = new Account();

        if (!empty($_POST))
        {
            $this->changePassRequest();
        }
        }

    /*
     * Vraag het model om de userpass aan te passen.
     */

    private function changePassRequest()
        {
        $passChanged = $this->loginModel->changeUserPass($_SESSION['username'], $_POST['oldPass'], $_POST['newPass'], $_POST['newPassRepeat']);

        switch ($passChanged)
        {
            case '1':
                $this->PasswordError = "Uw wachtwoord is nu veranderd.";
                $_SESSION['profielError'] = $this->PasswordError;
                header("location: index.php?p=profiel&e=error");
                break;
            case '2':
                $this->PasswordError = "Uw nieuw opgegeven wachtwoord is hetzelfde als uw oude wachtwoord.";
                $_SESSION['profielError'] = $this->PasswordError;
                header("location: index.php?p=profiel&e=error");
                break;
            case '3':
                $this->PasswordError = "Uw nieuw ingevoerde wachtwoorden komen niet overeen.";
                $_SESSION['profielError'] = $this->PasswordError;
                header("location: index.php?p=profiel&e=error");
                break;
            case '4':
                $this->PasswordError = "Uw oude wachtwoord is verkeerd.";
                $_SESSION['profielError'] = $this->PasswordError;
                header("location: index.php?p=profiel&e=error");
                break;
        }
        }

    public function invoke()
        {
        $page = "View" . DIRECTORY_SEPARATOR . "Profiel.php";

        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
        }

    }

?>