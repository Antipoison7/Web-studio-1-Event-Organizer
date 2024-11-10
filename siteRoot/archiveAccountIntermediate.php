<?php
session_start();
include_once('./Resources/Helper/loginHelper.php');
include_once('./Resources/Helper/userDetailsHelper.php');

function archiveUser($username)
{
    try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $db->prepare("UPDATE users SET archived = 1 WHERE username = :name;");
                $stmt->bindParam(':name', $username, PDO::PARAM_STR);

            $stmt->execute();

            $db = null;
            $stmt = null;
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
}

if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"])&&isset($_POST["loginName"])&&isset($_POST["passwordUser"])&&isset($_POST["confirmationText"]))
{
    if(isValidLogin($_SESSION["loginDetails"]["username"],$_SESSION["loginDetails"]["password"]))
    {
        if(($_SESSION["loginDetails"]["username"] == $_POST["loginName"])&&($_SESSION["loginDetails"]["password"] == $_POST["passwordUser"])&&($_POST["confirmationText"] == "I Wish To Delete My Account Forever"))
        {
            if(strpos($_SESSION["loginDetails"]["username"], '@') !== false)
            {
                $archiveName = getUsername($_SESSION["loginDetails"]["username"]);
            }
            else
            {
                $archiveName = $_SESSION["loginDetails"]["username"];
            }

            archiveUser($archiveName);
            header("Location: ./login.php");
        }
        else
        {
            header("Location: ./archiveAccount.php");
        }
    }
    else
    {
        header("Location: ./archiveAccount.php");
    }
}
else
{
    header("Location: ./archiveAccount.php");
}
?>