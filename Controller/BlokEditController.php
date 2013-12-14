<?php

/**
 * Description of BlokEditController
 *
 * @author Niek Willems
 */
class BlokEditController {
    
    public function __construct()
    {
        
    }
    
    public function invoke()
    {
        $page = 'BlokEdit.php';
        //$pagehead = 'BlokHead.php';

        include 'View/Template.php';
    }
}

?>
