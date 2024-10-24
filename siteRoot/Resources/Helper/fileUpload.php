<?php
include_once('./Resources/Helper/userDetailsHelper.php');
function uploadFile()
{
    if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"])&&strlen($_FILES["pfp"]["name"])>0)
    {
    try{
    if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"])&&strlen($_FILES["pfp"]["name"])>0)
    {
        if(strpos($_SESSION["loginDetails"]["username"], '@') === false)
        {
            $containsAt = false;
        }
        else
        {
            $containsAt = true;
        }

        if($containsAt)
        {
            $parsedUsername = getUsername($_SESSION["loginDetails"]["username"]);
        }
        else
        {
            $parsedUsername = $_SESSION["loginDetails"]["username"];
        }
    }

    $countVal = getImageCount($_SESSION["loginDetails"]["username"])+1;
    //Destination directory
    $target_dir = "./Resources/Images/userPfp/";
    //Original file for calculations
    $orig_file = $target_dir . basename($_FILES["pfp"]["name"]);
    //Checking variable
    $validUpload = true;
    //File type
    $imageFileType = strtolower(pathinfo($orig_file,PATHINFO_EXTENSION));
    //Destination + generated name + file extension
    $target_file = $target_dir . $parsedUsername . "_" . $countVal . "." . $imageFileType;

    echo($target_file);

    // echo($target_file);

    //Is it an image
    if(isset($_POST["submit"])) 
    {
        $check = getimagesize($_FILES["pfp"]["tmp_name"]);
        if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $validUpload = true;
        //   echo(var_dump($check));
        } else {
            echo "File is not an image.";
            $validUpload = false;
            // echo(var_dump($check));
        }
    }
    //File name checking
    if (file_exists($target_file)) 
    {
        echo "Duplicate File";
        $validUpload = false;
    } 

    //File size checking
    if ($_FILES["pfp"]["size"] > 500000) 
    {
        echo "Sorry, your file is too large.";
        $validUpload = false;
    } 
    //Allow only jpg, jpeg, png, gif and webp
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp" && $imageFileType != "gif" ) 
    {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $validUpload = false;
    }

    //Check checking variable
    if ($validUpload == false) 
    {
        echo "Sorry, your file was not uploaded.";
    } else 
    {
        //If file move succeeds
        if (move_uploaded_file($_FILES["pfp"]["tmp_name"], $target_file)) 
        {
        echo "The file ". htmlspecialchars( basename( $_FILES["pfp"]["name"])). " has been uploaded.";
        addToRecord(($parsedUsername . "_" . $countVal . "." . $imageFileType), $countVal, $_SESSION["loginDetails"]["username"]);
        } 
        else //if file move fails
        {
        echo "Sorry, there was an error uploading your file.";
        }
    }
    echo(var_dump($validUpload));
    }
    catch (Exception $e)
    {
        echo($e);
    }
    }
}

function addToRecord($fileName, $count, $username)
{
    if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"]))
    {
        if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
        {
            try
            {
                $lookupName = "pfp_" . $username . "_" . $count;
                $fullName = "/Resources/Images/userPfp/" . $fileName;

                $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $db->prepare("INSERT INTO fileNameKey (lookup_name, actual_name) 
                                      VALUES (:lookupName, :actualName);");

                $stmt->bindParam(':lookupName', $lookupName, PDO::PARAM_STR);
                $stmt->bindParam(':actualName', $fileName, PDO::PARAM_STR);
                $stmt->execute();
                $stmt = null;
                
                $stmt = $db->prepare("INSERT INTO resources (category, name_of_file)
                                      VALUES ('user_profilePicture', :lookupName);");
                $stmt->bindParam(':lookupName', $lookupName, PDO::PARAM_STR);
                $stmt->execute();
                $stmt = null;

                $stmt = $db->prepare("UPDATE users SET
                                      profile_picture = :pathName,
                                      profile_picture_count = :countName
                                      WHERE username = :accName;");

                $stmt->bindParam(':pathName', $fullName, PDO::PARAM_STR);
                $stmt->bindParam(':countName', $count, PDO::PARAM_STR);
                $stmt->bindParam(':accName', $username, PDO::PARAM_STR);
                $stmt->execute();
                
                $db = null;
                $stmt = null;
            }
            catch (PDOException $e)
            {
                echo("oh great heavens: " . $e->getMessage());
            }
        }
    }
}
?>