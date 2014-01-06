    

<?php

class ImportController {

    private $importSuccess;

    public function __construct() {

        if (isset($_POST['submit'])) {
            $fileName = $_FILES['file']['tmp_name'];

            $this->startImport($fileName);

            $_SESSION['importSuccess'] = $this->importSuccess;
            // if ($this->importSuccess) {                
            header('Location: index.php?p=studentsearch');
            // }

            die;
        }
        die;
    }

    public function startImport($fileName) {
        include 'Libraries/PHPExcel/PHPExcel/IOFactory.php';

        try {
            $inputFileType = PHPExcel_IOFactory::identify($fileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($fileName);

            $outputObj = new PHPExcel();
        } catch (Exception $e) {
            die();
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();

        $importCount = 0;
        for ($row = 2; $row <= $highestRow; $row++) {

            $studentId = $sheet->getCell('A' . $row)->getValue();
            $klasId = $sheet->getCell('B' . $row)->getValue();
            $achternaam = $sheet->getCell('C' . $row)->getValue();
            $tussenvoegsel = $sheet->getCell('D' . $row)->getValue();
            $voornaam = $sheet->getCell('E' . $row)->getValue();



            if (!empty($studentId)) {
                $imports[$row] = array(
                    "studentId" => $studentId,
                    "voornaam" => $voornaam,
                    "tussenvoegsel" => $tussenvoegsel,
                    "achternaam" => $achternaam
                );
                $this->formatStudent($studentId, $voornaam, $tussenvoegsel, $achternaam);
            }
        }
        $this->importSuccess = $this->saveImportedStudents($imports);
    }

    //Debug function to check if all data is correct
    public function formatStudent($studentId, $voornaam, $tussenvoegsel, $achternaam) {
        echo "StudentID: " . $studentId;
        echo '<br>';
        echo "Voornaam: " . $voornaam;
        echo '<br>';
        echo "Tussenvoegsel: " . $tussenvoegsel;
        echo '<br>';
        echo "Achternaam: " . $achternaam;
        echo '<br>';
    }

    //Save the imported students to the database
    public function saveImportedStudents($imports) {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Student.php');
        try {
            $importCount = 0;
            foreach ($imports as $newStudent) {
                $student = new Student();
                if (isset($newStudent['studentId'])) {
                    $student->setStudentId($newStudent['studentId']);
                    $student->setVoornaam($newStudent['voornaam']);
                    $student->setTussenvoegsel($newStudent['tussenvoegsel']);
                    $student->setAchternaam($newStudent['achternaam']);
                    $student->setMail('');
                    $student->saveNewStudent();
                    $importCount++;
                }
            }
            $_SESSION['importCount'] = (int) $importCount;
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
