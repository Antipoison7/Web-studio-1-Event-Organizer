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

    function encryptPassword($password) //Worthless Class btw
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function isValidLogin($username, $password, $type)
    {
        try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($type == "username")
            {
                $stmt = $db->prepare("SELECT pass_hash FROM accounts WHERE login_name = :name");
            }
            else if($type == "email")
            {
                $stmt = $db->prepare("SELECT pass_hash FROM accounts WHERE email = :name");
            }

            $stmt->bindParam(':name', $username, PDO::PARAM_STR);

            $stmt->execute();

            echo(var_dump($stmt->fetchColumn()));

            $passVal = $stmt->fetchColumn();

            if($passVal != false)
            {
                return password_verify($password, $passVal);
            }
            else
            {
                return false;
            }

            

        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }

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

    function registerUser($email, $username, $realName, $password)
    {
        try
        {
            $passwordEnc = encryptPassword($password);

            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("INSERT INTO accounts (login_name, email, pass_hash) VALUES (:login, :email, :password);
                                  INSERT INTO users (username, display_name, real_name) VALUES (:login, :login, :realName);");

            $stmt->bindParam(':login', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordEnc, PDO::PARAM_STR);
            $stmt->bindParam(':realName', $realName, PDO::PARAM_STR);

            $stmt->execute();
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
    }
?>