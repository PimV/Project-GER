<?php

class MailController {

    private $default;
    private $_teacherData;
    private $_rubricData;
    private $teacherRubrics;
    private $teacherFormattedRubrics;
    private $_mails;
    private $teachers;
    private $teacherNames;
    private $blokName;
    private $deadline;

    public function __construct($name, $deadline) {
        $this->blokName = $name;
        $this->deadline = $deadline;
        $this->init();
    }

    public function init() {
        $this->fetchTeacherInfo();
        $this->convertTeacherData();
        $this->fetchRubrics();
        $this->storeFormattedRubrics();
        foreach ($this->teachers as $teacherId => $mail) {
            //echo $mail . "<br>";
            // echo $this->teacherFormattedRubrics[$teacherId] . "<br>";
        }
        $this->sendMail();
    }

    private function storeFormattedRubrics() {
        foreach ($this->teacherRubrics as $teacherId => $rubrics) {
            $this->formatRubrics($this->teacherRubrics[$teacherId]);
            $this->teacherFormattedRubrics[$teacherId] = $this->formatRubrics($this->teacherRubrics[$teacherId]);
        }
    }

    private function fetchTeacherInfo() {
        include_once 'Model' . DIRECTORY_SEPARATOR . 'Docenten.php';
        $teacherModel = new Docenten();
        $this->_teacherData = $teacherModel->fetchMailData();
    }

    private function convertTeacherData() {
        $this->teachers = array();
        foreach ($this->_teacherData as $teacher) {
            $this->teachers[$teacher['id']] = $teacher['mail'];
            $fullName = "";
            $fullName .= $teacher['voornaam'];
            if (isset($teacher['tussenvoegsel']) && !empty($teacher['tussenvoegsel'])) {
                $fullName .= " " . $teacher['tussenvoegsel'];
            }
            $fullName .= " " . $teacher['achternaam'];
            $this->teacherNames[$teacher['id']] = $fullName;
        }
    }

    public function fetchRubrics() {
        include_once 'Model' . DIRECTORY_SEPARATOR . 'Rubrieken.php';
        $rubricModel = new Rubrieken();

        foreach ($this->teachers as $teacherId => $value) {
            $_rubricsData = $rubricModel->getAllRubricsInclRole($teacherId);
            $rubrics = array();
            foreach ($_rubricsData as $rubric) {
                $rubrics[$rubric['id']] = $rubric['naam'];
            }
            $this->teacherRubrics[$teacherId] = $rubrics;
        }
    }

    public function formatRubrics($rubrics) {
        $formattedText = "";
        foreach ($rubrics as $rubric) {
            $formattedText .= "- " . $rubric . "\n";
        }
        if (empty($formattedText)) {
            $formattedText = "Geen specifieke rubrieken te beoordelen. Beoordeel naar eigen inzicht.";
        }
        return $formattedText;
    }

    public function setDefault($teacherId) {
        $this->default = ""
                . "*Dit is een automatisch gegenereerd bericht. Gelieve niet hierop te antwoorden!*"
                . "\n \n"
                . "Beste " . $this->teacherNames[$teacherId] . ","
                . "\n \n"
                . "Vanaf nu staat het blok '$this->blokName' open voor beoordelingen. Verzocht wordt minimaal de volgende rubrieken te beoordelen:"
                . "\n \n"
                . $this->teacherFormattedRubrics[$teacherId]
                . "\n"
                . "Gelieve voor '$this->deadline' (yyyy/MM/dd) te beoordelen. Beoordelen kan via " . GlobalSettings::getCurrentURL() . "."
                . "\n \n"
                . "Met vriendelijke groet,"
                . "\n \n"
                . "De beheerder"
                . "\n \n"
                . "*Dit is een automatisch gegenereerd bericht. Gelieve niet hierop te antwoorden!*";
        return $this->default;
    }

    public function sendMail() {
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();  // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = "ger.automail@gmail.com";
        $mail->Password = "Ab12345!";
        $mail->SetFrom('ger.automail@gmail.com', "noreply@projectger.com");
        $mail->Subject = "Beoordelingen opengezet";

        $majorFailure = "";

        foreach ($this->teachers as $teacherId => $address) {
            $mail->ClearAllRecipients();
            $mail->AddAddress($address);
            $mail->Body = $this->setDefault($teacherId);

            if (!$mail->Send()) {
                $error = 'Mail error: ' . $mail->ErrorInfo;
            } else {
                $error = 'Message sent!';
            }
        }
        echo $majorFailure;
    }

}
