<?php

function qx_link($what, $flags = "")
{
    // check for valid commands
    $ret = preg_replace("/^(login|list|authenticate|chmod|download)$/", "?action=$1" . $flags, $what);

    // check if a replacement took place, if not, we do not know the link and return unknown
    $ret = (($ret == NULL || $ret == $what)) ? "?action=unknown" : $ret;
    _debug("qx_link(): made link to $ret");
    return $ret;
}

?>
