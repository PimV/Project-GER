<?php

/**
 * Description of AjaxResultaatResultatenController
 *
 * @author Bas van den Heuvel & Johan Beekers
 */
class AjaxResultaatResultatenController {
    
    private $studentenModel;
    
    public function __construct()
    {        
        include_once 'model/Studenten.php';
        $this->studentenModel = new Studenten();
    }
    
    public function invoke()
    {
        $student = $this->studentenModel->getStudent($_GET["id"]);
        $klas = $_GET["k"];
        $leerjaar = $_GET["s"];
        
        if(is_numeric($klas)){
            $result = $student->getResultsClass($klas);  
            $average= $student->getAverageResultClass($klas);
            $type = "klas";
            
            $hasfinal = $student->hasFinalResult($klas);
        }else{
            $result = $student->getResultsYear($leerjaar); 
            $average= $student->getAverageResultYear($leerjaar);
            $type = "leerjaar";
        }
        
        //Pak definitieve resultaten
        
            //Pak alle beoordelingen maar......
            //$klassen = $this->studentenModel->getAllClassesOfStudent_array($studentId, $schooljaar);
            //Uit model halen
            $rubrieken = [	"Vakinhoudelijke kennis en vaardigheden", 
                                            "Technische vaardigheden", 
                                            "Exact", 
                                            "Kwaliteit en zorgvuldigheid",
                                            "Communicatie", 
                                            "Sociale vaardigheid", 
                                            "Initiatief nemen", 
                                            "Plannen en organiseren",
                                            "Ondernemerschap", 
                                            "Verantwoordelijkheid", 
                                            "Zelfstandigheid", 
                                            "Transfervaardigheid", ];
            //Uit model halen
            $punten = [2,3,1,2,2,0,4,1,2,3,0,2];

            //Uit model halen
            $maximaal = 5;

            //Maak van de arrays eens javascript
            $r = json_encode($rubrieken);
            $p = json_encode($punten);
        
        include('View/AjaxResultaatDivResultaten.php');
        
        //Voer de methode uit om de ggraph te generate, en de methode om de imageUrl te maken
        echo "<script type='text/javascript'> createChart($r, $p, $maximaal); createUrl(); </script>";
    }
}

?>
