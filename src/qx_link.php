<?php
function qx_link($what)
{
    switch ($what)
    {
        case "login":        return "?action=login";
        case "authenticate": return "?action=authenticate";
    }
    return "?action=unknown";
}
?> 
