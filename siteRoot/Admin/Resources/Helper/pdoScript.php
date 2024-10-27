<?php
    $dbType = "mysql";
    $dbhost = "talsprddb02.int.its.rmit.edu.au";
    $dbName = "COSC3046_2402_UGRD_1479_G4";
    $dbusername = "COSC3046_2402_UGRD_1479_G4";
    $dbpassword = "GYS3sfUkzIqA";

    function createDB()
    {
        global $dbType, $dbhost, $dbName, $dbusername, $dbpassword;
        $newDB = new PDO($dbType.":host=" . $dbhost . ";dbname=" . $dbName, $dbusername, $dbpassword);
        $newDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $newDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
        return $newDB;
    }
    
?>