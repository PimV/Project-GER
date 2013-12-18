<?php

/**
 * Groep model
 *
 * Contains data and methods of single group
 * 
 * @author Pieter School
 */
class Groep {
    
    private $_id;
    private $_naam;
    private $_omschrijving;
    private $_rubics;
    
    public function __construct() {
        
    }

// <editor-fold defaultstate="collapsed" desc="Getters & Setters">
    
    public function get_id() {
        return $this->_id;
    }

    public function get_naam() {
        return $this->_naam;
    }

    public function get_omschrijving() {
        return $this->_omschrijving;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_naam($_naam) {
        $this->_naam = $_naam;
    }

    public function set_omschrijving($_omschrijving) {
        $this->_omschrijving = $_omschrijving;
    }
    
// </editor-fold>

    public function getGroup($groupId){
        $result = DatabaseConnector::executeQuery(
                "SELECT 
                    id, naam, omschrijving                    
                    FROM rol                       
                    WHERE id = " . $groupId);
        return $result;
    }
    
    public function getEnabledRubics($groupId){
        $result = DatabaseConnector::executeQuery(
                "SELECT DISTINCT 
                    rb.id AS id, rb.naam AS naam                   
                    FROM rol_rubriek rr
                    LEFT JOIN rubriek rb ON rb.id = rr.rubriek_id
                    WHERE verwijderd = 0 && rr.rol_id = " . $groupId);
        return $result;
    }
    
    public function getDisabledRubics($groupId){
        $result = DatabaseConnector::executeQuery(
                "SELECT DiSTINCT 
                    rb.id AS id, rb.naam AS naam
                    FROM rubriek rb
                    WHERE verwijderd = 0 && rb.id NOT IN(
                        SELECT rr.rubriek_id
                        FROM rol_rubriek rr
                        WHERE rr.rol_id = ". $groupId .")");
        return $result;
    }

    public function addRubic($rubicId){
        
    }
    
    public function removeRubric($rubicId){
        
    }
    
    public function saveToDb(){
        
    }
    
}


