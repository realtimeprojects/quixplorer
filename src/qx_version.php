<?php

$qx_id = "quixplorer3";
$qx_version = "3.0 PREVIEW";

function qx_version_info ()
{
    echo qx_version_info_s();
}

function qx_version_info_s ()
{
    global $qx_id;
    global $qx_version;

    return "$qx_id v$qx_version";
}

?>
