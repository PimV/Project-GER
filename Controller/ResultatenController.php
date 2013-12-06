<?php

/**
 * Description of ResultatenController
 *
 * @author Bas van den Heuvel
 */
class ResultatenController {
    
    public function __construct()
    {
        
    }
    
    public function invoke()
    {
        $page = 'Resultaten.php';
       // $pagehead = 'ResultatenHead.php';

        include 'View/Template.php';
    }
}

?>
