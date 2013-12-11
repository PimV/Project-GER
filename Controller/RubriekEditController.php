<?php

/**
 * Description of RubriekEditController
 *
 * @author Niek Willems
 */
class RubriekEditController {
    
    public function __construct()
    {
        
    }
    
    public function invoke()
    {
        $page = 'RubriekEdit.php';
        //$pagehead = 'RubriekHead.php';

        include 'View/Template.php';
    }
}

?>
