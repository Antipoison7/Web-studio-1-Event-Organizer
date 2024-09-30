<?php
        // These functions only return boolean values
    function validateText($text)
    {

    }

    function isOnlyText($text)
    {
        $exp = "/[^a-z0-9]/gi";

        if(preg_match($exp, $text) == 0)
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

        if(preg_match($exp, $text) == 0)
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
        $exp = "/[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@\w.\w/g";

        if(preg_match($exp, $email) == 1)
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
        
    }

    
?>