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
            $_SESSION['username'] = $this->username;
            $_SESSION['loggedin'] = 'true';

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
            $md5pass = md5($this->password);

            $query = "SELECT a.wachtwoord, a.disabled FROM account a 
                      WHERE a.wachtwoord = '$md5pass' AND a.gebruikersnaam = '$this->username'";

            $result = DatabaseConnector::executeQuery($query);

            if ($result != null)
            {
                $this->enabled = $result[0]["disabled"];

                if ($this->getEnabled())
                {
                    $_SESSION['username'] = $this->username;
                    $_SESSION['loggedin'] = true;
                            
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

    public function changeUserPass($inputUsername, $inputPassword, $newPassword, $newPasswordRepeat)
        {
        $md5pass = md5($inputPassword);

        $query = "SELECT a.gebruikersnaam, a.wachtwoord FROM account a 
            WHERE a.gebruikersnaam = '$inputUsername' AND a.wachtwoord = '$md5pass'";

        $result = DatabaseConnector::executeQuery($query);

        if ($result != null)
        {
            if ($newPassword == $newPasswordRepeat && $newPassword != $inputPassword)
            {
                $newMd5Pass = md5($newPassword);

                $array = array($newMd5Pass, $inputUsername);

                $query = "UPDATE account SET wachtwoord = ? WHERE gebruikersnaam = ?";
                DatabaseConnector::executeQuery($query, $array);

                return true;
            }
            else if ($newPassword == $inputPassword)
            {
                echo 'Je mag niet hetzelde wachtwoord gebruiken';
                return false;
            }
            else
            {
                echo'De nieuwe wachtwoorden komen niet overeen';
                return false;
            }
        }
        else
        {


            echo 'Verkeerd wachtwoord ingetypt';
            return false;
        }
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