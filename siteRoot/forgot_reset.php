<?php
session_start();
include_once('./Resources/Helper/validation.php');
include_once('./Resources/Helper/loginHelper.php');

if(isset($_SESSION["issues"]["password"]))
{
    $_SESSION["issues"]["password"] = "";
}

if((isset($_SESSION["resetPassword"]["resetCode"]))&&(isset($_SESSION["resetPassword"]["email"]))&&(isset($_POST["passwordUser"]))&&(isset($_POST["emailCode"])))
{
    if((strlen($_SESSION["resetPassword"]["resetCode"])>0)&&(strlen($_SESSION["resetPassword"]["email"])>0)&&(strlen($_POST["emailCode"])>0)&&(strlen($_POST["passwordUser"])>0))
    {
        if(($_SESSION["resetPassword"]["resetCode"] == $_POST["emailCode"]) && (count(validatePassword($_POST["passwordUser"])) == 0))
        {
            resetPassword($_SESSION["resetPassword"]["email"],$_POST["passwordUser"]);
            header("Location: ./login.php");
        }
        else
        {
            $_SESSION["issues"]["password"] = validatePassword($_POST["passwordUser"]);
            header("Location: ./forgot_confirm.php");
        }
    }
    else
    {
        header("Location: ./forgot_password.php");
    }
}
else
{
    header("Location: ./forgot_password.php");
}
?>