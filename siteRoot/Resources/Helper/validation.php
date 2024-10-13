<?php
        // These functions only return boolean values
    function validateText($text)
    {

    }

    function isOnlyText($text)
    {
        $exp = "/[^a-z0-9]/";

        if(preg_match_all($exp, $text) === false)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function isOnlyTextOrSpace($text)
    {
        $exp = "/[^a-z0-9 ]/";

        if(preg_match_all($exp, $text) === false)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function isEmail($email)
    {
        

        if(strlen($email) > 1)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
        
    }

    function containsAt($username)
    {
        if(strpos($username, '@') === false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function containsAmp($username)
    {
        if(strpos($username, '&') === false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function containsSpace($username)
    {
        if(strpos($username, ' ') === false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //This function returns an array with issues
    function validatePassword($password)
    {
        $problems = array();

        $isUppercase = "/[A-Z]/";
        $isLowercase = "/[a-z]/";
        // If you see this, no you don't, yes I am aware this sucks, no I do not want to put more time into this
        $containsSpecialCharacter = "/[\~\`\!\@\#\$\%\^\&\*\(\)\_\+\=\{\[\}\]\|\\\:\;\"\'\<\,\>\.\?\/\-]/"; //TODO: Fix this

        if(strlen($password)<8)
        {
            $problems["length"] = "At least 8 characters in length";
        }

        if(preg_match_all($isUppercase, $password) < 1)
        {
            $problems["upper"] = "Contains at least one uppercase Letter";
        }

        if(preg_match_all($isLowercase, $password) < 1)
        {
            $problems["lower"] = "Contains at least one lowercase Letter";
        }

        if(preg_match_all($containsSpecialCharacter, $password) < 1)
        {
            $problems["symbol"] = "Contains at least one symbol";
        }
        return $problems;
    }

    function isBlank($inputArray)
    {
        $hasStuff = true;

        foreach($inputArray as $x)
        {
            if(strlen($x) <= 0)
            {
                $hasStuff = false;
            }
        }

        return $hasStuff;
    }

    function isValidTheme($inputString)
    {
        $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT theme_url FROM themes;");
        $stmt->execute();
    }

    function validateRegister($inputArray)
    {
        $isValid = true;

        if(containsAt($inputArray["username"]))
        {
            $isValid = false;
            $_SESSION["issues"]["username"] = "Contains At";
        }

        if(containsAmp($inputArray["username"]))
        {
            $isValid = false;
            $_SESSION["issues"]["username"] = "Contains Amp";
        }

        if(containsSpace($inputArray["username"]))
        {
            $isValid = false;
            $_SESSION["issues"]["username"] = "Contains Amp";
        }

        if(!isEmail($inputArray["email"]))
        {
            $isValid = false;
            $_SESSION["issues"]["email"] = "Invalid Email";
        }

        if(count(validatePassword($inputArray["password"])) != 0)
        {
            $isValid = false;
            $_SESSION["issues"]["password"] = validatePassword($inputArray["password"]);
        }

        if(isDuplicateEmail($inputArray["email"]))
        {
            $isValid = false;
            $_SESSION["issues"]["email"] = "Email Already In Use";
        }

        return $isValid;
    }

    function validateCustomise($inputArray)
    {
        $isValid = true;

        if($inputArray["displayName"])
        {
            $isValid = false;
            $_SESSION["issues"]["displayName"] = "Display name cannot be blank";
        }

        if($inputArray["realName"])
        {
            $isValid = false;
            $_SESSION["issues"]["realName"] = "Name cannot be blank";
        }

        if(isValidTheme($inputArray["theme"]))
        {

        }
    }

    function isDuplicateEmail($email)
    {
        try
        {
            $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("SELECT login_name,email 
                                  FROM accounts 
                                  JOIN users ON accounts.login_name = users.username 
                                  WHERE email = :lookupName;");
            $stmt->bindParam(':lookupName',$email, PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() != 0)
            {
                $db = null;
                $stmt = null;
                return true;
            }
            else
            {
                $db = null;
                $stmt = null;
                return false;
            }
        }
        catch (PDOException $e)
        {
            echo("oh great heavens: " . $e->getMessage());
        }
    }

    
?>