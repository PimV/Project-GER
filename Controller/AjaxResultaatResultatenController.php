<?php

/**
 * Description of AjaxResultaatResultatenController
 *
 * @author Bas van den Heuvel & Johan Beekers
 */
class AjaxResultaatResultatenController {
    
    private $studentenModel;
    private $klasModel;
    private $blokModel;
    private $student;
    private $type;
    private $leerjaar;
    //Maak een array aan welke gebruikt word op de FPDF pagina
    private $chartData = array();
    
    public function __construct()
    {        
        include_once 'model/Studenten.php';
        include_once 'model/Klas.php';
        include_once 'model/Blok.php';
        $this->studentenModel = new Studenten();
    }
    
    public function invoke()
    {
        $this->student = $this->studentenModel->getStudent($_GET["id"]);
        $klas = $_GET["k"];
        $this->leerjaar = $_GET["s"];
            
        $saveAllowed = false;
        $hasfinal = false;
        $exportAllowed = true;
        
        if(is_numeric($klas)){
            $this->type = "klas";
            $result = $this->student->getResultsClass($klas);  
                    
            if(!empty($result)){
                $average= $this->student->getAverageResultClass($klas);            
                $hasfinal = $this->student->hasFinalResult($klas); 
                if($hasfinal){
                    $finalresults = $this->student->getFinalResults($klas);                                       
                }else{
                    $saveAllowed = true;  
                }
            }else{
                $exportAllowed = false;
            }
            
            //Uit database ophalen?
            $waarderingen = array(  array(1,0),
                                    array(2,1),
                                    array(3,2),
                                    array(4,3),
                                    array(5,4),
                                    array(6,5),
                                 );
            $this->klasModel = new Klas($klas);
            $this->blokModel = new Blok($this->klasModel->getBlockID());
        }else{
            $this->type = "leerjaar";
            $result = $student->getResultsYear($this->leerjaar); 
            $average= $student->getAverageResultYear($this->leerjaar);
        }
               
        
        include('View/AjaxResultaatDivResultaten.php');
        
        $save = intval($saveAllowed);
        $export = intval($exportAllowed);
        echo "<script type='text/javascript'> saveAllowed = $save; exportAllowed = $export;</script>";
        
        //Voer de methode uit om de ggraph te generate, en de methode om de imageUrl te maken
        if(!empty($result)){
            $this->createChart("cvs1", $result, $average);
        }
        if($hasfinal){
            $this->createChart("cvs2", $finalresults);
        }
    }
    
    private function createChart($canvas, $result, $average = NULL){
            array_push($this->chartData, $result);
            
            //Vul de gemiddelde punten array            
            $punten = array();
            //Vul de rubrieken array
            $rubrieken = array(); 
            if(!is_null($average)){   
                $docent = $result[0]["docent"];
                foreach($result as $row){
                    if($row["docent"] == $docent)
                    array_push($rubrieken, $row["rubriek"]);
                }
                
                foreach($average as $row){
                    array_push($punten, intval($row["gemiddelde"]));
                }
            }else{
                foreach($result as $row){            
                    array_push($punten, intval($row["waardering"]));
                    array_push($rubrieken, $row["rubriek"]);
                }
            }
            
            //Zet de naam van de chart goed
            if(is_null($average)){
               $name = "Eindbeoordeling: " . $this->student->getVoornaam() . " " . $this->student->getTussenvoegsel() . " " . $this->student->getAchternaam() . " - Leerjaar " . $this->leerjaar; 
            }else{
               $name = $this->student->getVoornaam() . " " . $this->student->getTussenvoegsel() . " " . $this->student->getAchternaam() . " - Leerjaar " . $this->leerjaar;    
            }         
            if($this->type == "klas"){
                $name .= " - " . $this->klasModel->getClassCode() . " - " . $this->blokModel->getName();    
            }            
            
            //Uit model halen
            $maximaal = 5;

            //Maak van de arrays eens javascript
            $r = json_encode($rubrieken);
            $p = json_encode($punten);
            
            echo "<script type='text/javascript'> createChart('$canvas', '$name', $r, $p, $maximaal); createUrl('cvs1');</script>";
    }
}

?>
