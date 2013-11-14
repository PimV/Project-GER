<?php

/**
 * Description of HomeController
 *
 * @author johan
 */
class HomeController {
    
    public function __construct()
    {
        
    }
    
    public function invoke()
    {
        $page = 'Home.php';
        $pagehead = 'HomeHead.php';

        include 'View/Template.php';
    }
}

?>
