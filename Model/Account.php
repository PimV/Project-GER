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




        $query = "SELECT a.gebruikersnaam FROM account a 
            WHERE a.gebruikersnaam = '$this->username'";

        $result = DatabaseConnector::executeQuery($query);

        if ($result != null)
        {
            $this->md5pass = md5($this->password);

            $query = "SELECT a.wachtwoord, a.disabled FROM account a 
                      WHERE a.wachtwoord = '$this->md5pass' AND a.gebruikersnaam = '$this->username'";

            $result = DatabaseConnector::executeQuery($query);

            if ($result != null)
            {
                $this->enabled = $result[0]["disabled"];

                if ($this->getEnabled())
                {

                    return true;
                }
                else
                {
                    echo 'Dit account is niet actief';
                    return false;
                }
            }
            else
            {
                echo 'Het wachtwoord is incorrect';
            }
        }
        else
        {
            echo 'account niet geregistreet';
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
     * Haalt de waarde op van de variable $enabled.
     */

    private function getEnabled()
        {
        return $this->enabled;
        }

    }
?>
