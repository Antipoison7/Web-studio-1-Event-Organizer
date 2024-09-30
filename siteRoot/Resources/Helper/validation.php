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
        $exp = "/[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@\w.\w/";

        if(preg_match_all($exp, $email) === true)
        {
            return true;
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
        $containsSpecialCharacter = "/[~`!@#$%^&*()_+={[}\]|\\:;\"'<,>.?\/-]/"; //TODO: Fix this

        $testPassword = "Passa\aa";

        if(strlen($testPassword)<8)
        {
            $problems[] = "At least 8 characters in length";
        }

        if(preg_match_all($isUppercase, $testPassword) != 1)
        {
            $problems[] = "Contains at least one uppercase Letter";
        }

        if(preg_match_all($isLowercase, $testPassword) != 1)
        {
            $problems[] = "Contains at least one lowercase Letter";
        }

        if(preg_match_all($containsSpecialCharacter, $testPassword) != 1)
        {
            $problems[] = "Contains at least one symbol";
        }
        return $problems;
    }

    
?>