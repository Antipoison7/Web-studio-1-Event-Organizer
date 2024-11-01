<?php
    function updateCache()
    {
        try{
        $_SESSION["imageCache"] = [];

        $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM resourcesKey;");
        $stmt->execute();

        $classArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("SELECT * FROM fileNameKey;");
        $stmt->execute();

        $keyArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null;
        $stmt = null;

        foreach($classArray as $xval)
        {
            $_SESSION["imageCache"]["class"][$xval["category_name"]] = $xval["category_path"];
        }

        // echo(var_dump($_SESSION["imageCache"]["class"]));
        // echo(var_dump($_SESSION["imageCache"]["class"]["events_thumbnails"]));

        foreach($keyArray as $yval)
        {
            $_SESSION["imageCache"]["key"][$yval["lookup_name"]] = $yval["actual_name"];
        }

        }
        catch(PDOException $e)
        {
            echo("Image caching failed, reload the page, if errors persist message an admin");
        }
    }

    function getImg($className, $keyName)
    {
        if((isset($_SESSION["imageCache"]["class"][$className]))&&(isset($_SESSION["imageCache"]["key"][$keyName])))
        {
            return $_SESSION["imageCache"]["class"][$className] . $_SESSION["imageCache"]["key"][$keyName];
        }
        else
        {
            //This is intentionally hard coded as a failed image load could indicate that the cache is broken
            return "/Resources/Images/Resources/error.png";
        }
    }
?>