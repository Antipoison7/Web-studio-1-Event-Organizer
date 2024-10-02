<?php
        // These functions only return boolean values
    function validateText($text)
    {

    }

    function isOnlyText($text)
    {
        $exp = "/[^a-z0-9]/gi";

        if(preg_match($exp, $text) === false)
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
        $exp = "/[^a-z0-9 ]/gi";

        if(preg_match($exp, $text) === false)
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
        $exp = "/[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@\w*.\w*/";

        if(strlen($email) > 1)
        {
            if(preg_match_all($exp, $email) === true)
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
            $problems[] = "At least 8 characters in length";
        }

        if(preg_match_all($isUppercase, $password) < 1)
        {
            $problems[] = "Contains at least one uppercase Letter";
        }

        if(preg_match_all($isLowercase, $password) < 1)
        {
            $problems[] = "Contains at least one lowercase Letter";
        }

        if(preg_match_all($containsSpecialCharacter, $password) < 1)
        {
            $problems[] = "Contains at least one symbol";
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

    
?>