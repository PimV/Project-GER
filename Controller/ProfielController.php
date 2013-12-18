<?php

class ProfielController
    {

    private $loginModel;

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
        $passChanged = $this->loginModel->changeUserPass($_SESSION['username'], 
                                                         $_POST['oldPass'], 
                                                         $_POST['newPass'], 
                                                         $_POST['newPassRepeat']);
        
        if($passChanged == true)
        {
            echo 'pass changed';
        }
        else
        {
            echo'pass not changed';
        }
        }

    public function invoke()
        {
        $page = "View" . DIRECTORY_SEPARATOR . "Profiel.php";

        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
        }

    }

?>