<?php

require_once "_include/smartyoutputfilter.php";

class QxInfo { };

class Qx
{
    public static function useModule($module)
    {
        require_once("_include/$module.php");
    }

    public static function getInfo()
    {
        $qxinfo = new QxInfo;
        $qxinfo->version = "3.0 PREALPHA";
        $qxinfo->URL = "https://github.com/realtimeprojects/quixplorer";
        return $qxinfo;
    }

    public static function loadPage(QxLink $link = null)
    {
        $location = "index.php";
        if ($link != null)
            $location .= $link->string;
        header("Location: $location");
        exit;
    }
}

function qx_img($image, $msg)
{
    ?><img class="button" src="_img/$image" alt="$msg" title="$msg" /><?php
}

function qx_grant($link)
{
    global $dir;

    switch ($link)
    {
        case "javascript:Move();": return permissions_grant($dir, NULL, "change");
        case "javascript:Copy();": return permissions_grant_all($dir, NULL, array("create", "read"));
        case "javascript:Delete();": return permissions_grant($dir, NULL, "delete");
        case "javascript:Archive();": return true;
        case "javascript:location.reload();": return true;
    }

    if (preg_match("/\?action=upload/", $link)) return permissions_grant($dir, NULL, "create") && get_cfg_var("file_uploads");
    if (preg_match("/\?action=list/", $link)) return true;

    return false;
}

?>
