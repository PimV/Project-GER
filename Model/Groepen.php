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
                "SELECT r.id AS id, 
                    r.naam AS naam, 
                    count(rr.rol_id) rubrieken, 
                    count(dr.rol_id) docenten 

                    FROM rol r 
                    INNER JOIN rol_rubriek rr on r.id = rr.rol_id 
                    INNER JOIN docent_rol dr on r.id = dr.rol_id 
                    
                    WHERE verwijderd = 0
                    
                    GROUP BY r.id");
        return $result;
    }
    
    public function getAllGroups_Id_Name() {
        return $this->_groups;
    }

    
    
}