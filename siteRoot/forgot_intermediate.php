<?php

function doesUserExist($userlogin)
{
    try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $type = "username";

            if(strpos($userlogin, '@') !== false)
            {
                $type = "email";
            }

            if($type == "username")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.login_name FROM accounts JOIN users ON accounts.login_name = users.username WHERE login_name = :name AND archived = 0;");
            }
            else if($type == "email")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.login_name FROM accounts JOIN users ON accounts.login_name = users.username WHERE email = :name AND archived = 0;");
            }
            
            $stmt->bindParam(':name', $userlogin, PDO::PARAM_STR);

            $stmt->execute();

            // echo(var_dump($stmt->fetchColumn()));

            $passVal = $stmt->fetchColumn();

            $db = null;
            $stmt = null;
            
            return $passVal;
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
}

function getEmail($username)
{
    try
    {
        $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT email FROM accounts WHERE login_name = :name;");
        echo(var_dump($username));

        if(strpos($username, '@') !== false)
        {
            $setName = getUsername($username);
        }
        else
        {
            $setName = $username;
        }

        $stmt->bindParam(':name', $setName, PDO::PARAM_STR);
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

$email = "";

if(isset($_POST["emailUser"]))
{
    if(strlen($_POST["emailUser"])>0)
    {
        
        if(strpos($_POST["emailUser"], '@') === false)
        {
            $typeVal = "username";
        }
        else
        {
            $typeVal = "email";
        }

        if(doesUserExist($_POST["emailUser"]) != false)
        {
            // echo($typeVal);
            if($typeVal == "username")
            {
                $email = getEmail($_POST["emailUser"]);
            }
            else
            {
                $email = $_POST["emailUser"];
            }
        }
        else
        {

        }
    }
}
?>