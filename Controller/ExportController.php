<?php

/**
 * Description of ExportController
 *
 * @author Bas van den Heuvel & Johan Beekers
 */
class ExportController {
        
    public function __construct()
    {
        require('Libraries/PHP/FPDF/fpdf.php');
    }
    
    public function invoke()
    {
        $type = $_GET["c"];
        
        switch($type)
        {
            case "resultaat":
                $this->createResultaatPDF();
                break;
            case "student":
                break;
            default:
                break;
        }
    }
    
    private function createResultaatPDF(){
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output('example1.pdf','I'); 
    }
}

?>
