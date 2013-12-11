<?php

/**
 * Description of RubriekController
 *
 * @author Niek Willems
 */
class RubriekController {
    
    public function __construct()
    {
        
    }
    
    public function invoke()
    {
        $page = 'Rubriek.php';
        //$pagehead = 'RubriekHead.php';

        include 'View/Template.php';
    }
}

?>
