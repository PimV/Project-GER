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
            if ($_POST["forgetUsername"] != null)
            {

                $this->forgetPass($_POST["forgetUsername"]);
            }
            else
            {
                $this->validateLoginRequest();
            }
        }
        }

    public function validateLoginRequest()
        {
        $loginpassed = (string) $this->loginModel->validateLogin($_POST['username'], $_POST['password']);

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

    public function forgetPass($username)
        {
        include_once 'Controller' . DIRECTORY_SEPARATOR . 'MailController.php';

        $mailController = new MailController();

        //$mail = $this->loginModel->getAccountEmail($username)[0]['mail'];
        $account = $this->loginModel->getAccountByKey($username);
        $mail = $this->loginModel->getAccountEmail($username)[0]['mail'];




        if ($mail != null)
        {
            $mailController->setMail($mail);
            $success = $mailController->sendForgetMail();
            $newPass = $mailController->getNewPass();
            if ($success)
            {
                $newAccount = new Account();
                $newAccount->update(null, $username, $newPass, null, null, $username);

                $this->LoginErrorMessage = "E-mail verstuurd";
                $_SESSION['loginError'] = $this->LoginErrorMessage;
                header("location: index.php?p=login&e=error");
            }
            else
            {
                $this->LoginErrorMessage = "Geen e-mail verstuurd.";
                $_SESSION['loginError'] = $this->LoginErrorMessage;
                header("location: index.php?p=login&e=error");
            }
        }
        else
        {
            $this->LoginErrorMessage = "Geen e-mail bekend vraag de admin voor een nieuw wachtwoord.";
            $_SESSION['loginError'] = $this->LoginErrorMessage;
            header("location: index.php?p=login&e=error");
        }
        }

    public function invoke()
        {
        $page = "View" . DIRECTORY_SEPARATOR . "Login.php";

        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
        }

    }

?>
