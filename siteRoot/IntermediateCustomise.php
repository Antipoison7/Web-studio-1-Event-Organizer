<?php
    include_once('./Resources/Helper/validation.php');
    include_once('./Resources/Helper/loginHelper.php');

    session_start();

    if(isset($_SESSION["issues"]))
    {
        unset($_SESSION["issues"]);
    }

    try
    {
        if(isset($_POST["pfp"])&&isset($_POST["displayName"])&&isset($_POST["realName"])&&isset($_POST["description"])&&isset($_POST["theme"]))
        {
            $pfp = $_POST["pfp"];
            $displayName = $_POST["displayName"];
            $realName = $_POST["realName"];
            $description = $_POST["description"];
            $theme = $_POST["theme"];

            $_SESSION["customiseDetails"]["pfp"] = $pfp;
            $_SESSION["customiseDetails"]["displayName"] = $displayName;
            $_SESSION["customiseDetails"]["realName"] = $realName;
            $_SESSION["customiseDetails"]["description"] = $description;
            $_SESSION["customiseDetails"]["theme"] = $theme;


            if(validateCustomise(["profilePicture" => $pfp, "displayName" => $displayName,"realName" => $realName,"description" => $description,"theme" => $theme]))
            {
                $redirect = "./index.php";
                updateUser($_SESSION["loginDetails"]["username"], $pfp, $displayName, $realName, $description, $theme);
                header("Location: ./index.php");
            }
            else
            {
                $redirect = "./profileCustomise.php";
                header("Location: ./profileCustomise.php");
            }
        }
        else
        {
            header("Location: ./index.php");
        }


    }
    catch(Exception $e)
    {
        header("Location: ./index.php");
        $redirect = "./index.php";
    }
    
?>