<?php
    function cleanTextHTML($textIn)
    {
        $textOut = str_replace($textIn, "&lt;", "<");
        $textOut = str_replace($textOut, "&gt;", ">");
        return $textOut;
    }
?>