<?php
session_start();
include_once('./Resources/Helper/validation.php');
include_once('./Resources/Helper/loginHelper.php');
include_once('./Resources/Helper/userDetailsHelper.php');

if(isset($_SESSION["issues"]["password"]))
{
    $_SESSION["issues"]["password"] = "";
}

if((isset($_POST["oldPassword"]))&&(isset($_POST["passwordUser"]))&&(isset($_SESSION["loginDetails"]["username"]))&&(isset($_SESSION["loginDetails"]["password"])))
{
    if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
    {
        if($_POST["oldPassword"] == $_SESSION["loginDetails"]["password"])
        {
            if(count(validatePassword($_POST["passwordUser"])) == 0)
            {
                $loginValue = $_SESSION["loginDetails"]["username"];
                
                if(strpos($_SESSION["loginDetails"]["username"], '@') === false)
                {
                    $loginValue = getEmail($_SESSION["loginDetails"]["username"]);
                }

                resetPassword($loginValue,$_POST["passwordUser"]);
                header("Location: ./login.php");
            }
            else
            {
                $_SESSION["issues"]["password"] = validatePassword($_POST["passwordUser"]);
                header("Location: ./changePassword.php");
            }
        }
        else
        {
            header("Location: ./changePassword.php");
        }
    }
    else
    {
        header("Location: ./changePassword.php");
    }
}
else
{
    header("Location: ./changePassword.php");
}
?>