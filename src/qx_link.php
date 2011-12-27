<?php
function qx_link($what, $flags)
{
    if ($ret = preg_replace("/^(login|list|authenticate)$/", "?action=$1" . $flags, $what))
        return $ret;

    return "?action=unknown";
}
?> 
