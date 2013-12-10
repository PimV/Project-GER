<?php

/**
 * Static class with global variables.
 *
 * @author Johan Beekers
 */
class GlobalSettings {
    
    static private $titlePrefix = "GER - ";                 //A prefix to put in the tab title.
    static private $DatabaseLocation = "127.0.0.1:3306";    //URL of the database.
    static private $DatabaseName = "42in06soxager_db2";     //Name of the database.
    static private $DatabaseLogin = "root";                 //Login name to access the database.
    static private $DatabasePassword = "";                  //Database login password.
    
    static public function gettitlePrefix() { return self::$titlePrefix; }
    static public function getDatabaseLocation() { return self::$DatabaseLocation; }
    static public function getDatabaseName() { return self::$DatabaseName; }
    static public function getDatabaseLogin() { return self::$DatabaseLogin; }
    static public function getDatabasePassword() { return self::$DatabasePassword; }
    
}

?>
