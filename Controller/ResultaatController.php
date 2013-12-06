<?php

/**
 * Description of ResultatController
 *
 * @author Bas van den Heuvel
 */
class ResultaatController {
    
    public function __construct()
    {
        
    }
    
    public function invoke()
    {
        $page = 'Resultaat.php';
       // $pagehead = 'ResultaatHead.php';

        include 'View/Template.php';
    }
}

?>
