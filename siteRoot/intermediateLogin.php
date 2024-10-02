<!DOCTYPE html>
<?php
    session_start();
    $type = $_POST["hiddenType"]; //Gets the type from the post requrest

    if(($type == "Login")||($type == "Register"))
    $username = $_POST["username"];
    $password = $_POST["password"];

    //For the register stuff
    if($type == "Register")
    {
        $email = $_POST["email"];
        $realname = $_POST["realname"];
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