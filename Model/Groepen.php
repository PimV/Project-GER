<?php

/**
 * Groep model
 *
 * Contains data and methods of single group
 * 
 * @author Pieter School
 */

class Groep {
    
    private  $_groups;
    
    public function __construct() {
        
    }
    
    public function addGroup() {
        return $this->_groups;
    }

    public function getGroup($name) {
        $this->_groups = $_groups;
    }
    
    public function getAllGroups() {
        return $this->_groups;
    }
    
    public function getAllGroups_Id_Name() {
        return $this->_groups;
    }

    
    
}