<?php

/**
 * Login model. Gaat login aanvragen valideren, user passwoorden aanpassen.
 *
 * @author Gijs van der Venne
 */
class Account
    {

    private $username;
    private $password;
    private $enabled;

    /*
     * Valideer als de gebruiker de goede gegevens ingevold heeft.
     * zo ja: log de gebruiker in
     * zo nee: log de gebruiker niet in en geef een error.
     */

    public function validateLogin($inputUsername, $inputPassword)
        {

        $this->username = $inputUsername;
        $this->password = $inputPassword;

        if ($this->CheckIfUserExcists() === true)
        {
            //doe iets enzo
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
        $this->md5pass = md5($this->password);

        $query = "SELECT a.gebruikersnaam, a.wachtwoord, a.disabled 
            FROM account a where a.gebruikersnaam =  $this->username AND a.wachtwoord = $this->md5pass";
        
        $result = DatabaseConnector::executeQuery($query);

        $this->enabled = $result[0]["disabled"];

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
     * Haalt de waarde op van de variable $enabled.
     */

    private function getEnabled()
        {
        return $enabled;
        }

    }

?>
