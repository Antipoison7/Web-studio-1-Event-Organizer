<?php
    include_once('./Resources/Helper/validation.php');
    include_once('./Resources/Helper/loginHelper.php');
?>
<!DOCTYPE html>
<?php
    session_start();
    $type = $_POST["hiddenType"]; //Gets the type from the post requrest

    $redirect = "./index.php";

    if($type == "Login") //Login Checking
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(isBlank([$username,$password]))
        {
            echo("username and password set");
            // echo(var_dump(isValidLogin($username, $password, "username")));

            if(isValidLogin($username, $password))
            {
                $_SESSION["loginDetails"]["username"] = $username;
                $_SESSION["loginDetails"]["password"] = $password;
                $redirect = "./HomePage.php";
                
            }
            else
            {
                echo("invalid login / password");
                $redirect = "./login.php";
            }
        }
        else
        {
            echo("username and password not set");
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
?>

<html lang="en">
        <head>
               <title>Please Dont Break</title>


        <!-- <meta http-equiv='refresh' content='5'; url ='index.php'/> -->
        </head>

        <!-- redirectScript() -->
    <body onload=''>

        <p><a href="<?php echo($redirect); ?>">Damn, if you see this and it doesn't load, click this. Do not refresh the page.</a></p>
            <script>
                // function redirectScript()
                // {
                //     sleep(1000);
                //     window.location.replace("index.php");
                // }
                // function sleep(ms) {
                //     return new Promise(resolve => setTimeout(resolve, ms));
                // }
            </script>

    </body>
</html>