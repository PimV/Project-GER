<?php

class LoginController
    {

    private $loginModel;

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
        $loginpassed = $this->loginModel->validateLogin($_POST['username'], $_POST['password']);

        if ($loginpassed === true)
        {
            echo "hoera";
        }
        else
        {
            echo "boeeee";
        }
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
