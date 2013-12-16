<?php

/**
 * Static class with global variables.
 *
 * @author Johan Beekers
 */
class GlobalSettings {

    static private $titlePrefix = "GER - ";                         //A prefix to put in the tab title.
    static private $DatabaseLocation = "5.199.151.136:3306";            //URL of the database.
    static private $DatabaseName = "mydb";                          //Name of the database.
    static private $DatabaseLogin = "PimVerlangen";                 //Login name to access the database.
    static private $DatabasePassword = "verlangen";                 //Database login password.

//    static private $titlePrefix = "";                         //A prefix to put in the tab title.
//    static private $DatabaseLocation = "";            //URL of the database.
//    static private $DatabaseName = "";                          //Name of the database.
//    static private $DatabaseLogin = "";                 //Login name to access the database.
//    static private $DatabasePassword = "";

    static public function gettitlePrefix() {
        return self::$titlePrefix;
    }

    static public function getDatabaseLocation() {
        return self::$DatabaseLocation;
    }

    static public function getDatabaseName() {
        return self::$DatabaseName;
    }

    static public function getDatabaseLogin() {
        return self::$DatabaseLogin;
    }

    static public function getDatabasePassword() {
        return self::$DatabasePassword;
    }

}

?>
