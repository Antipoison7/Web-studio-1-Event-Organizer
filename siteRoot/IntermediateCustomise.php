<?php
    include_once('./Resources/Helper/validation.php');
    include_once('./Resources/Helper/loginHelper.php');
?>
<!DOCTYPE html>
<?php
    session_start();

    $redirect = "./index.php";

    try
    {
        if(isset($_POST["pfp"])&&isset($_POST["displayName"])&&isset($_POST["realName"])&&isset($_POST["description"])&&isset($_POST["theme"]))
        {
            $pfp = $_POST["pfp"];
            $displayName = $_POST["displayName"];
            $realName = $_POST["realName"];
            $description = $_POST["description"];
            $theme = $_POST["theme"];

            $_SESSION["customiseDetails"]["pfp"] = $pfp;
            $_SESSION["customiseDetails"]["displayName"] = $displayName;
            $_SESSION["customiseDetails"]["realName"] = $realName;
            $_SESSION["customiseDetails"]["description"] = $description;
            $_SESSION["customiseDetails"]["theme"] = $theme;


            if(validateCustomise(["profilePicture" => $pfp, "displayName" => $displayName,"realName" => $realName,"description" => $description,"theme" => $theme]))
            {
                $redirect = "./index.php";
                updateUser($_SESSION["loginDetails"]["username"], $pfp, $displayName, $realName, $description, $theme);
            }
            else
            {
                $redirect = "./profileCustomise.php";
            }
        }


    }
    catch(Exception $e)
    {
        $redirect = "./index.php";
    }
    
?>

<html lang="en">
        <head>
               <title>Please Dont Break</title>


        <!-- <meta http-equiv='refresh' content='5'; url ='<?php echo($redirect)?>'/> -->
        </head>

        redirectScript()
    <body onload=''>

        <p><a href="<?php echo($redirect); ?>">Damn, if you see this and it doesn't load, click this. Do not refresh the page.</a></p>
        <br>
        <?php echo(var_dump($_POST)); ?>
            <script>
                // function redirectScript()
                // {
                //     sleep(1000);
                //     window.location.replace("<?php echo($redirect)?>");
                // }
                // function sleep(ms) {
                //     return new Promise(resolve => setTimeout(resolve, ms));
                // }
            </script>

    </body>
</html>

<?php
    if(isset($_SESSION["issues"]))
    {
        unset($_SESSION["issues"]);
    }
?>