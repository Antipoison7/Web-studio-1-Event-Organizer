<?php
    include_once('./Resources/Helper/validation.php');
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
            echo("register set");
        }
        else
        {
            echo("register not set");
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

        <p><a href="index.php">Damn, if you see this and it doesn't load, click this. Do not refresh the page.</a></p>
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