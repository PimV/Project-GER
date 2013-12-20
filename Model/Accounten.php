<?php

/**
 * Login model. Gaat login aanvragen valideren, user passwoorden aanpassen.
 *
 * @author Gijs van der Venne
 */
class Accounten {

    public function __construct() {
        
    }

    public function disableAccount($docentId) {
        $parameters = array($docentId);
        $query = "UPDATE account SET disabled = 1 WHERE docent_id = ?";

        DatabaseConnector::executeQuery($query, $parameters);
    }

    public function getAllAccounts() {
        $query = "SELECT * FROM account ORDER BY disabled";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function removeAccount($accountId) {
        $parameters = array($accountId);

        $query = "DELETE FROM account WHERE gebruikersnaam = ?";

        DatabaseConnector::executeQuery($query, $parameters);
    }

}

?>