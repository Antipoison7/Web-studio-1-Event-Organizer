<?php
//NOTE: ONLY USE THIS AFTER VERIFYING USERNAME AND PASSWORD IS SET
    function getProfilePicture($username)
    {
        if(isset($_SESSION["loginDetails"]))
        {
            if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
            {
                try
                {
                    $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare("SELECT profile_picture FROM users WHERE username = :name;");

                    $stmt->bindParam(':name', $username, PDO::PARAM_STR);
                    $stmt->execute();

                    $returnVal = $stmt->fetchColumn();

                    $db = null;
                    $stmt = null;

                    return $returnVal;
                }
                catch (PDOException $e)
                {
                    echo("oh great heavens: " . $e->getMessage());
                }
            }
        }
    }

    function getDisplayName($username)
    {
        if(isset($_SESSION["loginDetails"]))
        {
            if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
            {
                try
                {
                    $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare("SELECT display_name FROM users WHERE username = :name;");

                    $stmt->bindParam(':name', $username, PDO::PARAM_STR);
                    $stmt->execute();

                    $returnVal = $stmt->fetchColumn();

                    $db = null;
                    $stmt = null;

                    return $returnVal;
                }
                catch (PDOException $e)
                {
                    echo("oh great heavens: " . $e->getMessage());
                }
            }
        }
    }

    function getRealName($username)
    {
        if(isset($_SESSION["loginDetails"]))
        {
            if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
            {
                try
                {
                    $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare("SELECT real_name FROM users WHERE username = :name;");

                    $stmt->bindParam(':name', $username, PDO::PARAM_STR);
                    $stmt->execute();

                    $returnVal = $stmt->fetchColumn();

                    $db = null;
                    $stmt = null;

                    return $returnVal;
                }
                catch (PDOException $e)
                {
                    echo("oh great heavens: " . $e->getMessage());
                }
            }
        }
    }

    function getEmail($username)
    {
        if(isset($_SESSION["loginDetails"]))
        {
            if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
            {
                try
                {
                    $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare("SELECT email FROM accounts WHERE login_name = :name;");

                    $stmt->bindParam(':name', $username, PDO::PARAM_STR);
                    $stmt->execute();

                    $returnVal = $stmt->fetchColumn();

                    $db = null;
                    $stmt = null;

                    return $returnVal;
                }
                catch (PDOException $e)
                {
                    echo("oh great heavens: " . $e->getMessage());
                }
            }
        }
    }

    function getUsername($email)
    {
        if(isset($_SESSION["loginDetails"]))
        {
            if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
            {
                try
                {
                    $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare("SELECT login_name FROM accounts WHERE email = :name;");

                    $stmt->bindParam(':name', $email, PDO::PARAM_STR);
                    $stmt->execute();

                    $returnVal = $stmt->fetchColumn();

                    $db = null;
                    $stmt = null;

                    return $returnVal;
                }
                catch (PDOException $e)
                {
                    echo("oh great heavens: " . $e->getMessage());
                }
            }
        }
    }
?>