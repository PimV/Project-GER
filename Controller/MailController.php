<?php

class MailController
    {

    private $default;
    private $_teacherData;
    private $_rubricData;
    private $teacherRubrics;
    private $teacherFormattedRubrics;
    private $_mail;
    private $teachers;
    private $teacherNames;
    private $blokName;
    private $deadline;
    private $newPass;

    public function __construct()
        {
        
        }

    public function init()
        {
        $this->fetchTeacherInfo();
        $this->convertTeacherData();
        $this->fetchRubrics();
        $this->storeFormattedRubrics();
        $this->sendMail();
        }

    private function storeFormattedRubrics()
        {
        foreach ($this->teacherRubrics as $teacherId => $rubrics)
        {
            $this->formatRubrics($this->teacherRubrics[$teacherId]);
            $this->teacherFormattedRubrics[$teacherId] = $this->formatRubrics($this->teacherRubrics[$teacherId]);
        }
        }

    private function fetchTeacherInfo()
        {
        include_once 'Model' . DIRECTORY_SEPARATOR . 'Docenten.php';
        $teacherModel = new Docenten();
        $this->_teacherData = $teacherModel->fetchMailData();
        }

    private function convertTeacherData()
        {
        $this->teachers = array();
        foreach ($this->_teacherData as $teacher)
        {
            $this->teachers[$teacher['id']] = $teacher['mail'];
            $fullName = "";
            $fullName .= $teacher['voornaam'];
            if (isset($teacher['tussenvoegsel']) && !empty($teacher['tussenvoegsel']))
            {
                $fullName .= " " . $teacher['tussenvoegsel'];
            }
            $fullName .= " " . $teacher['achternaam'];
            $this->teacherNames[$teacher['id']] = $fullName;
        }
        }

    public function fetchRubrics()
        {
        include_once 'Model' . DIRECTORY_SEPARATOR . 'Rubrieken.php';
        $rubricModel = new Rubrieken();

        foreach ($this->teachers as $teacherId => $value)
        {
            $_rubricsData = $rubricModel->getAllRubricsInclRole($teacherId);
            $rubrics = array();
            foreach ($_rubricsData as $rubric)
            {
                $rubrics[$rubric['id']] = $rubric['naam'];
            }
            $this->teacherRubrics[$teacherId] = $rubrics;
        }
        }

    public function formatRubrics($rubrics)
        {
        $formattedText = "";
        foreach ($rubrics as $rubric)
        {
            $formattedText .= "- " . $rubric . "\n";
        }
        if (empty($formattedText))
        {
            $formattedText = "Geen specifieke rubrieken te beoordelen. Beoordeel naar eigen inzicht.";
        }
        return $formattedText;
        }

    public function setDefault($teacherId)
        {
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

    public function sendForgetMail()
        {
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();  // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->Port = 465;
        //$mail->Username = "ger.automail@gmail.com";
        $mail->Username = "ger.automail@gmail.com";
        $mail->Password = "Ab12345!";
        $mail->SetFrom('ger.automail@gmail.com', "noreply@projectger.com");

        $mail->Subject = "Wachtwoord vergeten";
        $mail->ClearAllRecipients();
        $mail->AddAddress($this->_mail);
        $mail->Body = $this->newPassMail();

        var_dump($this->_mail);
        //die;

        if (!$mail->Send())
        {
            $error = 'Mail error: ' . $mail->ErrorInfo;
            return false;
        }
        else
        {
            $error = 'Message sent!';
            return true;
        }
        var_dump("Mail moet verzonden zijn");
        }

    public function sendMail()
        {
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

        foreach ($this->teachers as $teacherId => $address)
        {
            $mail->ClearAllRecipients();
            $mail->AddAddress($address);
            $mail->Body = $this->setDefault($teacherId);

            if (!$mail->Send())
            {
                $error = 'Mail error: ' . $mail->ErrorInfo;
            }
            else
            {
                $error = 'Message sent!';
            }
        }
        echo $majorFailure;
        }

    public function newPassMail()
        {

        $this->generateNewPass();
        
        $this->defaultForgetPass = ""
                . "*Dit is een automatisch gegenereerd bericht. Gelieve niet hierop te antwoorden!*"
                . "\n \n"
                . "Beste Gebruiker,"
                . "\n \n"
                . "Uw nieuwe wachtwoord is " . $this->newPass . "."
                . "\n \n"
                . "\n \n"
                . "Met vriendelijke groet,"
                . "\n \n"
                . "De beheerder"
                . "\n \n"
                . "*Dit is een automatisch gegenereerd bericht. Gelieve niet hierop te antwoorden!*";

        return $this->defaultForgetPass;
        }

    public function generateNewPass()
        {
        $this->newPass = "";
        for ($i = 0; $i < 9; $i++)
        {
            $this->newPass .= rand(0, 9);
        }
        return $this->newPass;
        }
        
        public function getNewPass() {
            return $this->newPass;
            }

    public function setName($name)
        {
        $this->blokName = $name;
        }

    public function setDeadline($deadline)
        {
        $this->deadline = $deadline;
        }

    public function setMail($mail)
        {
        $this->_mail = $mail;
        }

    }
