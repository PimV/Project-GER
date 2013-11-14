<?php

/**
 * Static class with global variables.
 *
 * @author Johan Beekers
 */
class GlobalSettings {
    
    static private $rootFolder = "/ProjectGER/";                    //Root folder where the website is located. (Starting from webserver root)
    static private $titlePrefix = "GER - ";                         //A prefix to put in the tab title.
    static private $DatabaseLocation = "databases.aii.avans.nl";    //URL of the database.
    static private $DatabaseName = "";                 //Name of the database.
    static private $DatabaseLogin = "";                    //Login name to access the database.
    static private $DatabasePassword = "";                 //Database login password.
    
    static public function getRootFolder() { return self::$rootFolder; }
    static public function gettitlePrefix() { return self::$titlePrefix; }
    static public function getDatabaseLocation() { return self::$DatabaseLocation; }
    static public function getDatabaseName() { return self::$DatabaseName; }
    static public function getDatabaseLogin() { return self::$DatabaseLogin; }
    static public function getDatabasePassword() { return self::$DatabasePassword; }
    
}

?>
