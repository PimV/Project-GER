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

}

?>