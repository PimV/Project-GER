<?php

/**
 * Description of StudentSearchController
 *
 * @author Bas van den Heuvel & James Hay
 */
class StudentSearchController {
    
    public function __construct()
    {
        
    }
    
    public function invoke()
    {
        $page = 'StudentSearch.php';
       // $pagehead = 'StudentSearchHead.php';

        include 'View/Template.php';
    }
}

?>
