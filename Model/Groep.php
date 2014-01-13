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
    private $_rubics = array();
    
    public function __construct($id = null) {
        if(!is_null($id)) {
            $this->id = $id;
            $this->loadGroup($id);
        }
    }
    
    public function get_id() {
        return $this->_id;
    }

    public function get_naam() {
        return $this->_naam;
    }

    public function get_omschrijving() {
        return $this->_omschrijving;
    }

    public function get_rubics() {
        return $this->_rubics;
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

    public function set_rubics($_rubics) {
        $this->_rubics = $_rubics;
    }

    
    public function loadGroup($groupId){
        $result = DatabaseConnector::executeQuery(
                "SELECT 
                    id, naam, omschrijving                    
                    FROM rol                       
                    WHERE id = " . $groupId);
        
        $this->_naam = $result[0]['naam'];
        $this->_omschrijving = $result[0]['omschrijving'];
        
        
        return $result;
    }
    
    public function getEnabledRubics($groupId){
        $result = DatabaseConnector::executeQuery(
                "SELECT DISTINCT 
                    rb.id AS id, rb.naam AS naam                   
                    FROM rol_rubriek rr
                    LEFT JOIN rubriek rb ON rb.id = rr.rubriek_id
                    WHERE verwijderd = 0 && rr.rol_id = " . $groupId);
        $this->_rubics = $result;
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
    
    public function saveToDb(){
        if(empty($this->_id)) {
            $this->addGroup();
        } else {
            $this->updateGroep();
        }
    }
    
    private function addGroup(){
        DatabaseConnector::executeQuery("INSERT INTO rol "
                . "(naam, omschrijving, verwijderd) "
                . "VALUES "
                . "('" .  $this->_naam . "', '" . $this->_omschrijving . "', 0)");
        
        $idQuery = DatabaseConnector::executeQuery("SELECT max(id) AS id from rol");
        
        $this->_id = $idQuery['0']['id'];
        
        foreach($this->_rubics as $key => $rol) {            
            DatabaseConnector::executeQuery("INSERT INTO rol_rubriek SET "
                    . "rol_id = " . $this->_id . ", "
                    . "rubriek_id = " . $rol);
        }
    }

    private function updateGroep(){
        DatabaseConnector::executeQuery("UPDATE rol SET naam = '" . $this->_naam . "', 
                                                omschrijving = '" . $this->_omschrijving . "',
                                                verwijderd = 0
                                                WHERE id = " . $this->_id);

        DatabaseConnector::executeQuery("DELETE FROM rol_rubriek WHERE rol_id = " . $this->_id);
        
        foreach($this->_rubics as $key => $rol) {            
            DatabaseConnector::executeQuery("INSERT INTO rol_rubriek SET "
                    . "rol_id = " . $this->_id . ", "
                    . "rubriek_id = " . $rol);
        }
    }    
}


