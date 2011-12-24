<?php

function qx_link($what)
{
    switch ($what)
    {
        case "login": return "_include/login.php";
    }
    return "_include/unknown.php";
}

?> 
