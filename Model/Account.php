<?php

/**
 * Login model. Gaat login aanvragen valideren, user passwoorden aanpassen.
 *
 * @author Gijs van der Venne
 */
class Login
    {

    private $username;
    private $password;
    private $enabled;

    /*
     * Valideer als de gebruiker de goede gegevens ingevold heeft.
     * zo ja: log de gebruiker in
     * zo nee: log de gebruiker niet in en geef een error.
     */

    private function validateLogin($inputUsername, $inputPassword)
        {

        $this->$username = $usernameinput;
        $this->$password = $inputPassword;

        if (CheckIfUserExcists() == true)
        {
            return true;
        }
        else
        {
            return false;
        }
        }

    /*
     * Kijkt in de database als de gebruiker wel echt bestaat.
     */

    private function CheckIfUserExcists()
        {
        $md5pass = md5($password);

        $query = "SELECT * FROM account where gebruikernaam = $username AND wachtwoord = $md5pass";

        if (getEnabled() === true)
        {
            return true;
        }
        else
        {
            return false;
        }
        }

    /*
     * Verander het passwoord van de gebruiker die ingelogd is.
     */

    private function changeUserPass($username, $password)
        {
        //doe iets met gegevens
        }

    /*
     * Log de user uit, en sluit de sessie gooi de sessie leeg.
     */

    private function logoff()
        {
        //doe iets
        }

    /*
     * Zet de waarde van enabled 
     * true = account is actief en bruikbaar
     * false = account is inactief en niet bruikbaar
     */

    private function setEnabled()
        {
        $this->$enabled = $inputEnabled;
        }

    /*
     * Haalt de waarde op van de variable $enabled.
     */

    private function getEnabled()
        {
        return $enabled;
        }

    }

?>
