<?php

/**
 * Login model. Gaat login aanvragen valideren, user passwoorden aanpassen.
 *
 * @author Gijs van der Venne
 */
class Account {

    private $username;
    private $password;
    private $enabled;

    /*
     * Valideer als de gebruiker de goede gegevens ingevold heeft.
     * zo ja: log de gebruiker in
     * zo nee: log de gebruiker niet in en geef een error.
     */

    public function validateLogin($inputUsername, $inputPassword) {

        $this->username = $inputUsername;
        $this->password = $inputPassword;

        if ($this->CheckIfUserExcists() === '1') {
            $_SESSION['username'] = $this->username;
            $_SESSION['loggedin'] = true;
        }
        return $this->CheckIfUserExcists();
    }

    /*
     * Kijkt in de database als de gebruiker wel echt bestaat.
     */

    private function CheckIfUserExcists() {
        $query = "SELECT a.gebruikersnaam FROM account a 
            WHERE a.gebruikersnaam = '$this->username'";

        $result = DatabaseConnector::executeQuery($query);

        if ($result != null) {
            $md5pass = md5($this->password);

            $query = "SELECT a.wachtwoord, a.disabled FROM account a 
                      WHERE a.wachtwoord = '$md5pass' AND a.gebruikersnaam = '$this->username'";

            $result = DatabaseConnector::executeQuery($query);

            if ($result != null) {
                if ($result[0]['disabled'] === 0) {
                    $this->enabled = true;
                } else {
                    $this->enabled = false;
                }

                if ($this->getEnabled()) {
                    $_SESSION['username'] = $this->username;
                    $_SESSION['loggedin'] = true;

                    return '1';
                } else {
                    return '2';
                }
            } else {
                return '3';
            }
        } else {
            return '4';
        }
    }

    /*
     * Verander het passwoord van de gebruiker die ingelogd is.
     */

    public function changeUserPass($inputUsername, $inputPassword, $newPassword, $newPasswordRepeat) {
        $md5pass = md5($inputPassword);

        $query = "SELECT a.gebruikersnaam, a.wachtwoord FROM account a 
            WHERE a.gebruikersnaam = '$inputUsername' AND a.wachtwoord = '$md5pass'";

        $result = DatabaseConnector::executeQuery($query);

        if ($result != null) {
            if ($newPassword == $newPasswordRepeat && $newPassword != $inputPassword) {
                $newMd5Pass = md5($newPassword);

                $array = array($newMd5Pass, $inputUsername);

                $query = "UPDATE account SET wachtwoord = ? WHERE gebruikersnaam = ?";
                DatabaseConnector::executeQuery($query, $array);

                return '1';
            } else if ($newPassword == $inputPassword) {
                return '2';
            } else {
                echo'De nieuwe wachtwoorden komen niet overeen';
                return '3';
            }
        } else {
            echo 'Verkeerd wachtwoord ingetypt';
            return '4';
        }
    }

    /*
     * Haalt de waarde op van de variable $enabled.
     */

    private function getEnabled() {
        return $this->enabled;
    }

    public function save($userName, $passWord, $levelId) {


        $query = "SELECT LAST_INSERT_ID() AS id FROM docent LIMIT 1";
        $result = DatabaseConnector::executeQuery($query);
        $docentId = $result[0]['id'];

        var_dump($docentId);
        $parameters = array($userName, md5($passWord), $levelId, $docentId);

        $query = "INSERT INTO account (gebruikersnaam, wachtwoord, level_id, docent_id) VALUES (?, ?, ?, ?)";



        DatabaseConnector::executeQuery($query, $parameters);
    }

    public function update($docentId, $userName, $passWord = null, $levelId) {
        $parameters = array();

        $query = "UPDATE account SET ";

        if (isset($passWord)) {
            $parameters[] = md5($passWord);
            $query .= "wachtwoord = ?, ";
        }

        if (isset($userName)) {
            $parameters[] = $userName;
            $query .= "gebruikersnaam = ?, ";
        }

        if (isset($levelId)) {
            $parameters[] = $levelId;
            $query .= "level_id = ?, ";
        }

        $query = substr($query, 0, strlen($query) - 2);

        $parameters[] = $docentId;

        $query .= " WHERE docent_id = ?";

        var_dump($query);
        var_dump($parameters);


        DatabaseConnector::executeQuery($query, $parameters);
    }

    public function changePassByDocentId($docentId, $newPass) {
        $newPass = md5($newPass);
        $parameters = array($newPass, $docentId);

        $query = "UPDATE account SET wachtwoord = ? WHERE docent_id = ?";

        DatabaseConnector::executeQuery($query, $parameters);
    }

    public function getAccount($docentId) {
        $parameters = array($docentId);

        $query = "SELECT * FROM account WHERE docent_id = ?";

        $result = DatabaseConnector::executeQuery($query, $parameters);

        return $result;
    }

}

?>
