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
    
    public function addGroup(){
        DatabaseConnector::executeQuery("INSERT INTO rol_rubriek SET "
                . "(naam, omschrijving, verwijderd) "
                . "VALUES "
                . "(" .  $this->_naam . ", " . $this->_omschrijving . ", false)");

        DatabaseConnector::executeQuery("DELET FROM rol_rubriek WHERE rol_id = " . $this->_id);
        
        foreach($this->_rubics as $value) {
            $rol = $value['rolId'];
            $rubriek = $value['rubriekId'];
            
            DatabaseConnector::executeQuery("INSERT INTO rol_rubriek SET (rol_id, rubriek_id) VALUES (" . $rol . ", " . $rubriek . ")");
        }
    }

    public function updateGroep(){
        DatabaseConnector::executeQuery("UPDATE rol SET naam = " . $this->_naam . ", 
                                                omschrijving = " . $this->_omschrijving . ",
                                                verwijderd = false,
                                                WHERE id = " . $this->_omschrijving);

        DatabaseConnector::executeQuery("DELET FROM rol_rubriek WHERE rol_id = " . $this->_id);
        
        foreach($this->_rubics as $value) {
            $rol = $value['rolId'];
            $rubriek = $value['rubriekId'];
            
            DatabaseConnector::executeQuery("INSERT INTO rol_rubriek SET (rol_id, rubriek_id) VALUES (" . $rol . ", " . $rubriek . ")");
        }
    }    
}


