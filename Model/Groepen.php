<?php

/**
 * Groep model
 *
 * Contains data and methods of single group
 * 
 * @author Pieter School
 */

class Groepen {
    
    private  $_groups;
    
    public function __construct() {
        
    }
    
    public function addGroup() {
        return $this->_groups;
    }

    public function getGroup($name) {
        $this->_groups = $name;
    }
    
    public function getAllGroups() {
        $result = DatabaseConnector::executeQuery(
                "SELECT 
                    r.id AS id, 
                    r.naam AS naam, 
                    
                    (select COUNT(*) from rol_rubriek rr where rr.rol_id = r.id) AS rubrieken, 
                    (select COUNT(*) from docent_rol dr where dr.rol_id = r.id) AS docenten 
                    
                    FROM rol r                    
                    WHERE verwijderd = 0                     
                    GROUP BY r.id");
        return $result;
    }
    
    public function getAllGroups_Id_Name() {
        return $this->_groups;
    }

    
    
}
