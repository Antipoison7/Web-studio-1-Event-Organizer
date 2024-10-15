<?php
    function cleanTextHTML($textIn)
    {
        $textOut = str_replace("<","&lt;",$textIn);
        $textOut = str_replace(">","&gt;",$textOut);
        return $textOut;
    }
?>