<?php

/**
 * Description of BlokController
 *
 * @author Niek Willems
 */
class BlokController {
    
    public function __construct()
    {
        
    }
    
    public function invoke()
    {
        $page = 'Blok.php';
        //$pagehead = 'BlokHead.php';

        include 'View/Template.php';
    }
}

?>
