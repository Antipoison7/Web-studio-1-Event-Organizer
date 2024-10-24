<?php
    session_start();
    include_once('./Resources/Helper/validation.php');
    include_once('./Resources/Helper/loginHelper.php');
    include_once('./Resources/Helper/fileUpload.php');

    echo(var_dump($_FILES));

    if(isset($_SESSION["issues"]))
    {
        unset($_SESSION["issues"]);
    }

    try
    {
        if(isset($_POST["displayName"])&&isset($_POST["realName"])&&isset($_POST["description"])&&isset($_POST["theme"]))
        {
            $displayName = $_POST["displayName"];
            $realName = $_POST["realName"];
            $description = $_POST["description"];
            $theme = $_POST["theme"];

            $_SESSION["customiseDetails"]["displayName"] = $displayName;
            $_SESSION["customiseDetails"]["realName"] = $realName;
            $_SESSION["customiseDetails"]["description"] = $description;
            $_SESSION["customiseDetails"]["theme"] = $theme;

            if(validateCustomise(["displayName" => $displayName,"realName" => $realName,"description" => $description,"theme" => $theme]))
            {
                $redirect = "./index.php";
                updateUser($_SESSION["loginDetails"]["username"], $displayName, $realName, $description, $theme);
                if(isset($_FILES["pfp"]["name"]))
                {
                    uploadFile();
                }
                // header("Location: ./index.php");
            }
            else
            {
                $redirect = "./profileCustomise.php";
                // header("Location: ./profileCustomise.php");
            }
        }
        else
        {
            // header("Location: ./index.php");
        }


    }
    catch(Exception $e)
    {
        header("Location: ./index.php");
        // $redirect = "./index.php";
    }
    
?>