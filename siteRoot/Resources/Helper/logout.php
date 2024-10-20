<?php
session_start();

if(isset($_SESSION["loginDetails"]))
{
    unset($_SESSION["loginDetails"]);
}

header("Location: ../../index.php");
?>