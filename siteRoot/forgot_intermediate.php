<?php
session_start();

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

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
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

            $ip = getUserIP();
            $resetCode = substr(uniqid(bin2hex(random_bytes(10/2)), true),0,6);
            $_SESSION["resetPassword"]["resetCode"] = $resetCode;
            $_SESSION["resetPassword"]["email"] = $email;
            $_SESSION["resetPassword"]["toggle"] = true;

            $msg = "Someone has requested a password reset for the account linked to this email\nIt was requested from " . $ip . ", however this may be inaccurate due to the person using a vpn.\nThe password reset code is : " . $resetCode;

            $msg = wordwrap($msg,70);

            mail($email,"Event Organiser - Forgot Password",$msg);
            header("Location: ./forgot_confirm.php");
        }
        else
        {
            $_SESSION["error"]["resetIssue"] = "User Not Found";
            header("Location: ./forgot_password.php");
        }
    }
    else
    {
        $_SESSION["error"]["resetIssue"] = "Input is Blank";
        header("Location: ./forgot_password.php");
    }
}
else
{
    $_SESSION["error"]["resetIssue"] = "No Username / Email Entered";
    header("Location: ./forgot_password.php");
}
?>