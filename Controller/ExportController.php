<?php

/**
 * Description of ExportController
 *
 * @author Bas van den Heuvel & Johan Beekers
 */
class ExportController {
        
    private $boolImageTwo = false;
    
    public function __construct()
    {
        require('Libraries/FPDF/fpdf.php');
    }
    
    public function invoke()
    {
        $type = $_POST["c"];
        
        switch($type)
        {
            case "resultaat":
                $this->exportResultaat();                
                break;
            case "student":
                break;
            default:
                break;
        }
    }
    
    private function exportResultaat(){
        //Get chart data
        $data = $_POST["d"];
        
        //Create image 1
        $img1= $_POST["i1"];
        $this->createChartImage($img1, "chart1"); 
        
        //Create image 2
        if(isset($_POST["i2"])){
            $img2 = $_POST["i2"];
            $this->createChartImage($img2, "chart2");
            $this->boolImageTwo = true;
        }
        
        $this->createResultaatPDF();
        
    }
    
    private function createChartImage($imgurl, $name)
    {
        $img = $imgurl;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = 'Images/temp/'.$name.'.png';
        $success = file_put_contents($file, $data);
    }
    
    private function createResultaatPDF()
    { 
        //TODO: ook nog de beoordeling per docent in die bepaalde blok of jaar laten zien
        
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',20);
        $pdf->SetX(70);
        $pdf->Cell(40,15,'Student beoordeling');
        //                                   x,y,size
        $pdf->Image('Images/temp/chart1.png',20,35,175);
        if($this->boolImageTwo)
        {
            $pdf->Image('Images/temp/chart2.png',20,160,175);
        }
        $pdf->Output('beoordeling.pdf','I'); 
    }
}

?>
