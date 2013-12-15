<?php

class LoginController
    {

    private $loginModel;

    public function __construct()
        {
        include_once "Model" . DIRECTORY_SEPARATOR . "Account.php";
        $this->loginModel = new login();
        }

    public function validateLoginRequest()
        {
        // vraag model om te valideren
        }

    public function changePasswordRequest()
        {
        // vraag model om login aan te passen
        }

    public function invoke()
        {
        $page = "View" . DIRECTORY_SEPARATOR . "Login.php";

        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
        }

    }

?>
