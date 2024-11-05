<?php
    include_once('./Resources/Helper/userDetailsHelper.php');
    include_once('./Resources/Helper/pdoScript.php');

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

    function isValidLogin($username, $password)
    {
        try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $type = "username";

            if(strpos($username, '@') !== false)
            {
                $type = "email";
            }

            if($type == "username")
            {
                $stmt = $db->prepare("SELECT accounts.pass_hash FROM accounts JOIN users ON accounts.login_name = users.username WHERE login_name = :name AND archived = 0;");
            }
            else if($type == "email")
            {
                $stmt = $db->prepare("SELECT accounts.pass_hash FROM accounts JOIN users ON accounts.login_name = users.username WHERE email = :name AND archived = 0;");
            }

            $stmt->bindParam(':name', $username, PDO::PARAM_STR);

            $stmt->execute();

            // echo(var_dump($stmt->fetchColumn()));

            $passVal = $stmt->fetchColumn();

            $db = null;
            $stmt = null;

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

    function isValidAdminLogin($username, $password)
    {
        try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $type = "username";

            if(strpos($username, '@') !== false)
            {
                $type = "email";
            }

            if($type == "username")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.pass_hash FROM accounts LEFT JOIN users ON accounts.login_name = users.username LEFT JOIN achievementLink ON achievementLink.login_username = accounts.login_name WHERE login_name = :name AND archived = 0 AND achievementLink.achieved_id <=3;");
            }
            else if($type == "email")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.pass_hash FROM accounts LEFT JOIN users ON accounts.login_name = users.username LEFT JOIN achievementLink ON achievementLink.login_username = accounts.login_name WHERE email = :name AND archived = 0 AND achievementLink.achieved_id <=3;");
            }

            $stmt->bindParam(':name', $username, PDO::PARAM_STR);

            $stmt->execute();

            // echo(var_dump($stmt->fetchColumn()));

            $passVal = $stmt->fetchColumn();

            $db = null;
            $stmt = null;

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

            $db = null;
            $stmt = null;
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

            $db = null;
            $stmt = null;
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
    }

    function updateUser($username, $displayName, $realName, $description, $theme)
    {
        try
        {
            $userName = $username;

            if(strpos($username, '@') !== false)
            {
                $userName = getUsername($username);
            }

            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("UPDATE users
                                  SET
                                  display_name = :displayName,
                                  real_name = :real_name,
                                  profile_description = :descriptions,
                                  theme_name = :themeName
                                  WHERE username = :usersname;");

            $stmt->bindParam(':displayName', $displayName, PDO::PARAM_STR);
            $stmt->bindParam(':real_name', $realName, PDO::PARAM_STR);
            $stmt->bindParam(':descriptions', $description, PDO::PARAM_STR);
            $stmt->bindParam(':themeName', $theme, PDO::PARAM_STR);
            $stmt->bindParam(':usersname', $userName, PDO::PARAM_STR);

            $stmt->execute();

            $db = null;
            $stmt = null;
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
    }

    function failedLogin()
    {
        echo("<div class=\"failedLogin\">
      <h1>You need to be logged in to use this page</h2>
      <h2><a href=\"./login.php\">Please log in here and try again</a></h2>
    </div>");
    }

    function isUserReal($username)
    {
        try
        {
            $db = createDB();

            $type = "username";

            if(strpos($username, '@') !== false)
            {
                $type = "email";
            }

            if($type == "username")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.login_name FROM accounts JOIN users ON accounts.login_name = users.username WHERE login_name = :name AND archived = 0;");
            }
            else if($type == "email")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.login_name FROM accounts JOIN users ON accounts.login_name = users.username WHERE email = :name AND archived = 0;");
            }

            $stmt->bindParam(':name', $username, PDO::PARAM_STR);

            $stmt->execute();

            // echo(var_dump($stmt->fetchColumn()));

            $passVal = $stmt->fetchColumn();

            $db = null;
            $stmt = null;
            
            return $passVal;
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
    }

    function updateCooldown($username)
    {
        try
        {
            $db = createDB();

            $type = "username";

            if(strpos($username, '@') !== false)
            {
                $type = "email";
            }

            if($type == "username")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.cooldown FROM accounts JOIN users ON accounts.login_name = users.username WHERE login_name = :name AND archived = 0;");
            }
            else if($type == "email")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.cooldown FROM accounts JOIN users ON accounts.login_name = users.username WHERE email = :name AND archived = 0;");
            }

            $stmt->bindParam(':name', $username, PDO::PARAM_STR);

            $stmt->execute();

            // echo(var_dump($stmt->fetchColumn()));

            $passVal = $stmt->fetchColumn();

            if($passVal != false)
            {
                $arrayOne = json_decode($passVal);

                $tempArray = json_encode([time(), $arrayOne[0], $arrayOne[1]]);

                if($type == "username")
                {
                    $stmt = $db->prepare("UPDATE accounts SET cooldown = :cooldownJson WHERE login_name = :name;");
                }
                else if($type == "email")
                {
                    $stmt = $db->prepare("UPDATE accounts SET cooldown = :cooldownJson WHERE email = :name;");
                }

                $stmt->bindParam(':name', $username, PDO::PARAM_STR);
                $stmt->bindParam(':cooldownJson', $tempArray, PDO::PARAM_STR);

                $stmt->execute();
            }



            $db = null;
            $stmt = null;

            
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
    }

    function cooldownApplied($username)
    {
        try
        {
            $success = false;

            $db = createDB();

            $type = "username";

            if(strpos($username, '@') !== false)
            {
                $type = "email";
            }

            if($type == "username")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.cooldown FROM accounts JOIN users ON accounts.login_name = users.username WHERE login_name = :name AND archived = 0;");
            }
            else if($type == "email")
            {
                $stmt = $db->prepare("SELECT DISTINCT accounts.cooldown FROM accounts JOIN users ON accounts.login_name = users.username WHERE email = :name AND archived = 0;");
            }

            $stmt->bindParam(':name', $username, PDO::PARAM_STR);

            $stmt->execute();

            
            $passVal = $stmt->fetchColumn();
            // echo(var_dump($stmt->fetchColumn()));

            if($passVal != false)
            {
                $cooldowns = json_decode($passVal);

                $checkerTable = [false, false, false];

                $i = 0;
                foreach($cooldowns as $x)
                {
                    if(($x + 3600) > time())
                    {
                        $checkerTable[$i] = false;
                    }
                    else if(($x + 3600) < time())
                    {
                        $checkerTable[$i] = true;
                    }

                    $i = $i + 1;
                }

                if(($checkerTable[0] == false)&&($checkerTable[1] == false)&&($checkerTable[2] == false))
                {
                    $success = false;
                }
                else
                {
                    $success = true;
                }
            }



            $db = null;
            $stmt = null;

            return $success;
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
    }

    function resetPassword($emailVal, $passwordVal)
    {
        try
        {
            $db = createDB();

            $passHashValue = password_hash($passwordVal, PASSWORD_BCRYPT);

            $stmt = $db->prepare("UPDATE accounts SET pass_hash = :passHashName WHERE email = :emailName;");

            $stmt->bindParam(':passHashName', $passHashValue, PDO::PARAM_STR);
            $stmt->bindParam(':emailName', $emailVal, PDO::PARAM_STR);

            $stmt->execute();

            $db = null;
            $stmt = null;            
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
    }
?>