<?php
    include_once('./Resources/Helper/validation.php');
    include_once('./Resources/Helper/loginHelper.php');
?>
<!DOCTYPE html>
<?php
    session_start();
    $type = $_POST["hiddenType"]; //Gets the type from the post requrest

    $redirect = "./index.php";

    if($type == "Login")
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(isBlank([$username,$password]))
        {
            echo("username and password set");
        }
        else
        {
            echo("username and password not set");
            $redirect = "./login.php";
        }
    }
    else if($type == "Register")
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $realname = $_POST["realname"];


        if(isBlank([$username,$password,$email,$realname]))
        {
            if(isset($_SESSION["issues"]))
            {
                unset($_SESSION["issues"]);
            }

            if(validateRegister(["username"=>$username,"password"=>$password,"email"=>$email,"realName"=>$realname]) == false)
            {
                $redirect = "./register.php";
            }
            else
            {
                // registerUser($email, $username, $realname, $password);
                $redirect = "./index.php";
            }
            echo("register set");
        }
        else
        {
            $_SESSION["issues"] = registerIsBlank([$username,$password,$email,$realname]);
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
        <?php
            echo(var_dump($_POST));
        ?>
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