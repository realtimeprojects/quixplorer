<?php

global $msgs;
$qx_msgs = parse_ini_file("_lang/en.lang", true);

function qx_msg($what)
{
    echo qx_msg_s($what);
}

function qx_msg_s($what)
{
    global $qx_msgs;

    $matches = array();
    if (preg_match("#^(\w+)\.(\w+)$#", $what, $matches))
        {
            _debug("making msg of $what with $matches[1], $matches[2]");
        $msg = $qx_msgs[$matches[1]][$matches[2]];
        }
    else
        $msg = $qx_msgs[$what];

    return isset($msg) ? $msg : $what;
}

?>
