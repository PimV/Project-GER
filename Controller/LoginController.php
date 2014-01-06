<?php

class LoginController
    {

    private $loginModel;
    private $LoginErrorMessage;

    public function __construct()
        {
        include_once 'Model' . DIRECTORY_SEPARATOR . 'Account.php';
        $this->loginModel = new Account();

        if (!empty($_POST))
        {
            $this->validateLoginRequest();
        }
        }

    public function validateLoginRequest()
        {
        $loginpassed = (string)$this->loginModel->validateLogin($_POST['username'], $_POST['password']);
        
        switch ($loginpassed)
        {
            case '1':
                header("location: index.php?p=home");
                break;
            case '2':
                $this->LoginErrorMessage = "Dit account is niet actief";
                $_SESSION['loginError'] = $this->LoginErrorMessage;
                header("location: index.php?p=login&e=error");
                break;
            case '3':
                $this->LoginErrorMessage = "Het opgegeven wachtwoord of gebruikersnaam is fout.";
                $_SESSION['loginError'] = $this->LoginErrorMessage;
                header("location: index.php?p=login&e=error");
                break;
            default:
                break;
        }
        }

    public function invoke()
        {

        $page = "View" . DIRECTORY_SEPARATOR . "Login.php";

        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
        }

    }

?>
