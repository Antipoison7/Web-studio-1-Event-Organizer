<?php
    include_once('./Resources/Helper/validation.php');
    include_once('./Resources/Helper/loginHelper.php');

    session_start();
    $type = "fail";
    
    if(isset($_POST["hiddenType"]))
    {
        $type = $_POST["hiddenType"]; //Gets the type from the post requrest
    }

    $redirect = "./index.php";

    try
    {
    if($type == "Login") //Login Checking
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(isBlank([$username,$password]))
        {
            echo("username and password set");
            // echo(var_dump(isValidLogin($username, $password, "username")));

            if(isValidLogin($username, $password) && cooldownApplied($username))
            {
                $_SESSION["loginDetails"]["username"] = $username;
                $_SESSION["loginDetails"]["password"] = $password;
                unset($_SESSION["issues"]["accountValidation"]);
                $redirect = "./HomePage.php";
                
            }
            else
            {
                echo("invalid login / password");
                $_SESSION["loginDetails"]["username"] = $username;
                if(!cooldownApplied($username))
                {
                    $_SESSION["issues"]["accountValidation"] = "Login on cooldown, wait 1 hour or contact an admin";
                }
                else
                {
                    $_SESSION["issues"]["accountValidation"] = "Incorrect login / password";
                }
                $redirect = "./login.php";

                if(isUserReal($username) != false)
                {
                    updateCooldown($username);
                }
            }
        }
        else
        {
            echo("username and password not set");
            $_SESSION["loginDetails"]["username"] = $username;
            $_SESSION["issues"]["accountValidation"] = "Invalid login / password";
            $redirect = "./login.php";
        }
    }
    else if($type == "Register") //Registry Checking
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $realname = $_POST["realname"];

        $_SESSION["registryDetails"]["username"] = $username;
        $_SESSION["registryDetails"]["password"] = $password;
        $_SESSION["registryDetails"]["email"] = $email;
        $_SESSION["registryDetails"]["realname"] = $realname;


        if(isBlank([$username,$password,$email,$realname]))
        {
            if(isset($_SESSION["issues"]))
            {
                unset($_SESSION["issues"]); // If issues have not been cleared in register, clear them
            }

            if(validateRegister(["username"=>$username,"password"=>$password,"email"=>$email,"realName"=>$realname]) == false)
            {
                $redirect = "./register.php";
            }
            else
            {
                registerUser($email, $username, $realname, $password);
                unset($_SESSION["registryDetails"]);
                $_SESSION["loginDetails"]["username"] = $username;
                $_SESSION["loginDetails"]["password"] = $password;

                $redirect = "./HomePage.php";
            }
            // echo("register set");
        }
        else
        {
            $_SESSION["issues"] = registerIsBlank([$username,$password,$email,$realname]);
            validateRegister(["username"=>$username,"password"=>$password,"email"=>$email,"realName"=>$realname]);
            if($_SESSION["issues"]["password"] == "set")
            {
                $_SESSION["issues"]["password"] = validatePassword($password);
            }
            $redirect = "./register.php";
            // echo("register not set");
        }
    }
}
catch(Exception $e)
{
    $redirect = "./index.php";
}

header("Location: " . $redirect);
?>