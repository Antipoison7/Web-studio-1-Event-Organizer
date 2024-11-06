<?php
session_start();
include_once('./Resources/Helper/loginHelper.php');
$_SESSION["issues"]["adminStuff"] = null;

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
                $stmt = $db->prepare("SELECT DISTINCT accounts.login_name FROM accounts JOIN users ON accounts.login_name = users.username WHERE login_name = :name AND  accounts.login_name NOT IN (SELECT DISTINCT login_username FROM achievementLink WHERE achieved_id <= 3);");
            }
            else if($type == "email")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.login_name FROM accounts JOIN users ON accounts.login_name = users.username WHERE email = :name AND accounts.login_name NOT IN (SELECT DISTINCT login_username FROM achievementLink WHERE achieved_id <= 3);");
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

function flipArchived($userlogin)
{
    try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $lookupName = $userlogin;

            if(strpos($userlogin, '@') !== false)
            {
                $stmt = $db->prepare("SELECT login_name FROM accounts WHERE email = :lookupEmail;");
                $stmt->bindParam(':lookupEmail', $userlogin, PDO::PARAM_STR);
                $lookupName = $stmt->fetchColumn(0);
                $stmt = null;
            }
            
            $stmt = $db->prepare("SELECT archived FROM users WHERE username = :name;");
            $stmt->bindParam(':name', $lookupName, PDO::PARAM_STR);
            $stmt->execute();

            $archivedVal = $stmt->fetchColumn();

            if($archivedVal == 0)
            {
                $stmt = $db->prepare("UPDATE users SET archived = 1 WHERE username = :name;");
                $stmt->bindParam(':name', $lookupName, PDO::PARAM_STR);
            }
            else
            {
                $stmt = $db->prepare("UPDATE users SET archived = 0 WHERE username = :name;");
                $stmt->bindParam(':name', $lookupName, PDO::PARAM_STR);
            }

            $stmt->execute();

            $db = null;
            $stmt = null;
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
}




//Program Logic
if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"]))
{
    $isAdmin = isValidAdminLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]);
}
else
{
  $isAdmin = false;
}

if($isAdmin)
{
    if(isset($_POST["deleteRadio"]))
    {
        if(doesUserExist($_POST["deleteRadio"]))
        {
            flipArchived($_POST["deleteRadio"]);
            $_SESSION["issues"]["adminStuff"] = "Changed";
            header("Location: ./archiveAccount.php");
        }
        else
        {
            $_SESSION["issues"]["adminStuff"] = "What happened?";
            header("Location: ./archiveAccount.php");
        }
    }
    else
    {
        $_SESSION["issues"]["adminStuff"] = "NotSet";
        header("Location: ./archiveAccount.php");
    }
}
else
{
    header("Location: ../HomePage.php");
}
?>