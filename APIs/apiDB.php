<?php
function isAdmin($username, $password) 
{
    $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(strpos($username, '@') !== false)
    {
        $stmt = $db->prepare("SELECT DISTINCT accounts.pass_hash FROM accounts LEFT JOIN users ON accounts.login_name = users.username LEFT JOIN achievementLink ON achievementLink.login_username = accounts.login_name WHERE accounts.email = :name AND archived = 0 AND achieved_id <= 3;");
    }
    else
    {
        $stmt = $db->prepare("SELECT DISTINCT accounts.pass_hash FROM accounts LEFT JOIN users ON accounts.login_name = users.username LEFT JOIN achievementLink ON achievementLink.login_username = accounts.login_name WHERE login_name = :name AND archived = 0 AND achieved_id <= 3;");
    }

    $stmt->bindParam(':name', $username, PDO::PARAM_STR);

    $stmt->execute();

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

function dumpUserData()
{
    try
    {
        $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM users;");

        $stmt->execute();

        $returnVal = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usersList = [];

        foreach($returnVal as $x)
        {
            $usersList[$x["username"]] = ['username' => $x["username"], 'display_name' => $x["display_name"], 'real_name' => $x["real_name"], 'archived' => $x["archived"], 'profile_picture' => $x["profile_picture"], 'profile_description' => $x["profile_picture"], 'theme_name' => $x["theme_name"]];
        }

        $db = null;
        $stmt = null;

        return $usersList;
    }
    catch (PDOException $e)
    {
        return ['error' => 'Internal Error ' . $e->getMessage()];
    }
}

function getProfilePicture($username)
{
    try
    {
        $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(strpos($username, '@') !== false)
        {//entered email
            $stmt = $db->prepare("SELECT profile_picture FROM users JOIN accounts ON accounts.login_name = users.username WHERE email = :name;");
        }
        else
        {//entered password
            $stmt = $db->prepare("SELECT profile_picture FROM users WHERE username = :name;");
        }

        $stmt->bindParam(':name', $username, PDO::PARAM_STR);
        $stmt->execute();

        $returnVal = $stmt->fetchColumn();

        $db = null;
        $stmt = null;

        if($returnVal != false)
        {
            return ['profile_picture' => $returnVal];
        }
        else
        {
            return ['error' => 'No profile picture found for username: ' . $username];
        }
    }
    catch (PDOException $e)
    {
        return ['error' => 'Internal Error ' . $e->getMessage()];
    }
}

function archiveEvent($EventID)
{
    try
    {
        $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $db->prepare("SELECT '1' FROM EventList WHERE EventID = :inputID");    

        $stmt->bindParam(':inputID', $EventID, PDO::PARAM_STR);
        $stmt->execute();

        $returnVal = $stmt->fetchColumn();

        if($returnVal != false)
        {
            $stmt = $db->prepare("UPDATE EventList SET archived = 1 WHERE EventID = :inputID;");

            $stmt->bindParam(':inputID', $EventID, PDO::PARAM_STR);
            $returnVal = $stmt->execute();
        }

        $db = null;
        $stmt = null;

        if($returnVal)
        {
            return json_encode(['status' => "Successfully archived post"]);
        }
        else
        {
            return json_encode(['error' => 'No Event found at ID: ' . $EventID]);
        }
    }
    catch (PDOException $e)
    {
        return ['error' => 'Internal Error ' . $e->getMessage()];
    }
}

?>
