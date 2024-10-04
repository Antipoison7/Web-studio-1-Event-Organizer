<?php
    function registerIsBlank($inputArray)
    {
        $errors = array();

        if($inputArray[0] == "")
        {
            $errors["username"] = "unset";
        }
        else
        {
            $errors["username"] = "set";
        }

        if($inputArray[1] == "")
        {
            $errors["password"] = "unset";
        }
        else
        {
            $errors["password"] = "set";
        }

        if($inputArray[2] == "")
        {
            $errors["email"] = "unset";
        }
        else
        {
            $errors["email"] = "set";
        }

        if($inputArray[3] == "")
        {
            $errors["realName"] = "unset";
        }
        else
        {
            $errors["realName"] = "set";
        }

        return $errors;
    }

    function dumpDB()
    {
        try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM groupMembers";

            $stmt = $db->prepare($query);
            $stmt->execute();

            foreach($stmt as $row)
            {
                echo($row['FirstName'] . " " . $row['LastName'] . " ");
            }
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }


    }
?>