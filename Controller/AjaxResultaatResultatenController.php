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
    
    public function __construct()
    {        
        include_once 'model/Studenten.php';
        include_once 'model/Klas.php';
        include_once 'model/Blok.php';
        $this->studentenModel = new Studenten();
    }
    
    public function invoke()
    {
        $student = $this->studentenModel->getStudent($_GET["id"]);
        $klas = $_GET["k"];
        $leerjaar = $_GET["s"];
            
        $saveAllowed = false;
        $hasfinal = false;
        $exportAllowed = true;
        
        if(is_numeric($klas)){
            $type = "klas";
            $result = $student->getResultsClass($klas);  
                    
            if(!empty($result)){
                $average= $student->getAverageResultClass($klas);            
                $hasfinal = $student->hasFinalResult($klas); 
                if($hasfinal){
                    $finalresults = $student->getFinalResults($klas);                                       
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
            $type = "leerjaar";
            $result = $student->getResultsYear($leerjaar); 
            $average= $student->getAverageResultYear($leerjaar);
        }
        
        //Zet de gegevens klaar om de chart te maken
        $chartData = array();
        
        if(!empty($result)){
            //voeg gegeven beoordeling toe aan array voor pdf bestand
            array_push($chartData, $result);
            
            //Vul de rubrieken array
            $rubrieken = array(); 
            $docent = $result[0]["docent"];
            foreach($result as $row){
                if($row["docent"] == $docent)
                array_push($rubrieken, $row["rubriek"]);
            }
            
            //Vul de gemiddelde punten array
            $punten = array();
            foreach($average as $row){
                array_push($punten, intval($row["gemiddelde"]));
            }
            
            $naam = $student->getVoornaam() . " " . $student->getTussenvoegsel() . " " . $student->getAchternaam() . " - Leerjaar " . $leerjaar;            
            if($type == "klas"){
                $naam .= " - " . $this->klasModel->getClassCode() . " - " . $this->blokModel->getName();    
            }            
            
            //Uit model halen
            $maximaal = 5;

            //Maak van de arrays eens javascript
            $r = json_encode($rubrieken);
            $p = json_encode($punten);
            
            if($hasfinal){
                //voeg gegeven eindbeoordeling toe aan array voor pdf bestand
                array_push($chartData, $finalresults);

                //Vul de rubrieken array
                $rubrieken2 = array(); 
                //Vul de gemiddelde punten array
                $punten2 = array();
                foreach($finalresults as $row){
                    array_push($rubrieken2, $row["rubriek"]);
                    array_push($punten2, intval($row["waardering"]));
                }

                $naam2 = "Eindbeoordeling: " . $student->getVoornaam() . " " . $student->getTussenvoegsel() . " " . $student->getAchternaam() . " - Leerjaar " . $leerjaar;            
                if($type == "klas"){
                    $naam2 .= " - " . $this->klasModel->getClassCode() . " - " . $this->blokModel->getName();    
                }            

                //Uit model halen
                $maximaal2 = 5;

                //Maak van de arrays eens javascript
                $r2 = json_encode($rubrieken2);
                $p2 = json_encode($punten2);
            
            }
        }
        
        include('View/AjaxResultaatDivResultaten.php');
        
        $save = intval($saveAllowed);
        $export = intval($exportAllowed);
        echo $export;
        //Voer de methode uit om de ggraph te generate, en de methode om de imageUrl te maken
        echo "<script type='text/javascript'> saveAllowed = $save; exportAllowed = $export;</script>";
        if(!empty($result)){
            echo "<script type='text/javascript'> createChart('cvs1', '$naam', $r, $p, $maximaal); createUrl('cvs1');</script>";
        }
        if($hasfinal){
            echo "<script type='text/javascript'> createChart('cvs2', '$naam2', $r2, $p2, $maximaal2); createUrl('cvs2');</script>";
        }
        //echo "<script type='text/javascript'>createChart($chartData); createUrl();</script>";
    }
}

?>
