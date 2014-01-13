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
        $this->_id = $groupId;
        $query = "SELECT 
                    id, naam, omschrijving                    
                    FROM rol                       
                    WHERE id = ?";
        $result = DatabaseConnector::executeQuery($query, array($this->_id));
        
        $this->_naam = $result[0]['naam'];
        $this->_omschrijving = $result[0]['omschrijving'];
                
        return $result;
    }
    
    public function getEnabledRubics($groupId){
        $this->_id = $groupId;
        $query = "SELECT DISTINCT 
                    rb.id AS id, rb.naam AS naam                   
                    FROM rol_rubriek rr
                    LEFT JOIN rubriek rb ON rb.id = rr.rubriek_id
                    WHERE verwijderd = 0 && rr.rol_id = ?";
        
        $result = DatabaseConnector::executeQuery($query, array($this->_id));
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
        $this->_id = $groupId;
        $query = "INSERT INTO rol "
                . "(naam, omschrijving, verwijderd) "
                . "VALUES "
                . "(?, ?, 0)";
        
        DatabaseConnector::executeQuery($query, array($this->_naam, $this->_omschrijving));        
        $idQuery = DatabaseConnector::executeQuery("SELECT max(id) AS id from rol");
        
        $this->_id = $idQuery['0']['id'];
        
        foreach($this->_rubics as $key => $rol) {    
            $query = "INSERT INTO rol_rubriek SET "
                    . "rol_id = ?, "
                    . "rubriek_id = ?";

            DatabaseConnector::executeQuery($query, array($this->_id, $rol)); 
        }
    }

    private function updateGroep(){
        $query = "UPDATE rol SET naam = ?, 
                    omschrijving = ?,
                    verwijderd = 0
                    WHERE id = ?";
        
        DatabaseConnector::executeQuery($query, array($this->_naam, $this->_omschrijving, $this->_id));

        $query = "DELETE FROM rol_rubriek WHERE rol_id = ?";
        
        DatabaseConnector::executeQuery($query, array($this->_id));        
        
        foreach($this->_rubics as $key => $rol) {    
            $query = "INSERT INTO rol_rubriek SET "
                    . "rol_id = ?, "
                    . "rubriek_id = ?";

            DatabaseConnector::executeQuery($query, array($this->_id, $rol)); 
        }
    }    
}


