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

    $parts = split( "\.", $what );
    _debug("count(".count($parts));
    switch (count($parts))
    {
        case 0: return $what;
        case 1: $msg = $qx_msgs[$what]; break;
        case 2: $msg = $qx_msgs[$parts[0]][$parts[1]]; break;
        default: return $what;
    }
    $msg = isset($msg) ? $msg : $what;
    _debug("returning message '$msg' for item '$what'");
    return $msg;
}

?>
