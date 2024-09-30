<!DOCTYPE html>
<?php
    session_start();
    $email = $_POST["email"];
    $username = $_POST["username"];
    $realname = $_POST["realname"];
    $password = $_POST["password"];
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