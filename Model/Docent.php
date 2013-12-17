<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Docent
 *
 * @author Pim
 */
class Docent {

    private $firstName;
    private $insert;
    private $lastName;
    private $mail;
    private $rubrics;
    private $rollen;
    private $id;

    public function __construct() {
        
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setInsert($insert) {
        $this->insert = $insert;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setRollen($rollen) {
        $this->rollen = $rollen;
    }

    public function setRubrics($rubrics) {
        $this->rubrics = $rubrics;
    }

    public function getRollen() {
        return $this->rollen;
    }

    public function getRubrics() {
        return $this->rubrics;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getInsert() {
        return $this->insert;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getId() {
        return $this->id;
    }

    public function save() {
        $parameters = array(
            $this->getId(),
            $this->getFirstName(),
            $this->getInsert(),
            $this->getLastName(),
            $this->getMail()
        );
    }

    public function update() {
        $parameters = array(
            $this->getId(),
            $this->getFirstName(),
            $this->getInsert(),
            $this->getLastName(),
            $this->getMail()
        );
    }

}
