<?php

require_once "_include/smartyoutputfilter.php";

class Qx
{
    public static function useModule($module)
    {
        require_once("_include/$module.php");
    }
}

function qx_language()
{
    global $language;
    print $language;
}

function qx_title()
{
    global $site_name;
    print $site_name;
}

function qx_img($image, $msg)
{
    ?><img class="button" src="_img/$image" alt="$msg" title="$msg" /><?php
}

function qx_user() { echo qx_user_s(); }

function qx_user_s()
{
    if (!isset($_SESSION["s_user"]))
        return "anonymous";
    return $_SESSION["s_user"];
}

// @returns the relative path $rel to the current directory displayed.
function qx_directory($rel = NULL)
{
    global $dir;
    return $dir . "/" . $rel;
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
