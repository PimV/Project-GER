<?php

/**
 * Description of ExportController
 *
 * @author Bas van den Heuvel & Johan Beekers
 */
class ExportController {
        
    public function __construct()
    {
        require('Libraries/FPDF/fpdf.php');
    }
    
    public function invoke()
    {
        $type = $_POST["c"];
        $imgurl = $_POST["i"];
        
        switch($type)
        {
            case "resultaat":
                $this->createChartImage($imgurl);
                $this->createResultaatPDF();
                break;
            case "student":
                break;
            default:
                break;
        }
    }
    
    private function createChartImage($imgurl)
    {
        $img = $imgurl;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = 'tmp.png';
        $success = file_put_contents($file, $data);
    }
    
    private function createResultaatPDF()
    { 
        
        //TODO: ook nog de beoordeling per docent in die bepaalde blok of jaar laten zien
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        //                     x,y,size
        $pdf->Image('tmp.png',20,50,175);
        $pdf->Output('example1.pdf','I'); 
    }
}

?>
