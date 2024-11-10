<?php
session_start();
include_once('./Resources/Helper/loginHelper.php');
$_SESSION["issues"]["adminStuff"] = null;

function doesPostExist($postID)
{
    try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $stmt = $db->prepare("SELECT DISTINCT id FROM replies WHERE id = :postIDVal;");
            
            $stmt->bindParam(':postIDVal', $postID, PDO::PARAM_STR);

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

function unArchive($postID)
{
    try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $db->prepare("UPDATE replies SET archived = 0 WHERE id = :postIDVal;");
                $stmt->bindParam(':postIDVal', $postID, PDO::PARAM_STR);

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
        if(doesPostExist($_POST["deleteRadio"]))
        {
            unArchive($_POST["deleteRadio"]);
            $_SESSION["issues"]["adminStuff"] = "Changed";
            header("Location: ./unarchiveReplies.php");
        }
        else
        {
            $_SESSION["issues"]["adminStuff"] = "What happened?";
            header("Location: ./unarchiveReplies.php");
        }
    }
    else
    {
        $_SESSION["issues"]["adminStuff"] = "NotSet";
        header("Location: ./unarchiveReplies.php");
    }
}
else
{
    header("Location: ../HomePage.php");
}
?>