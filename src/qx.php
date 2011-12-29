<?php
function qx_language()
{
    global $language;
    print $language;
}

function qx_title()
{
    global $title;
    print $title;
}

function qx_img($image, $msg)
{
    ?><img class="button" src="_img/$image" alt="$msg" title="$msg" /><?php
}

function qx_user()
{
    //FIXME return real user
    $user = $_SESSION["s_user"];
    return (isset($user) ? $user : "anonymous");
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

    if (preg_match("/?action=upload/", $link)) return permissions_grant($dir, NULL, "create") && get_cfg_var("file_uploads");
    if (preg_match("/\?action=list/", $link)) return true;

    return false;
}

function qx_page($pagename)
{
    $pagefile = qx_var_template_dir() . "/$pagename.php";
    if (!file_exists($pagefile))
        show_error(qx_msg_s("error.qxmissingpage"), $pagefile);
    require_once qx_var_template_dir() . "/header.php";
    require_once qx_var_template_dir() . "/$pagefile";
    require_once qx_var_template_dir() . "/footer.php";
    exit;
}
?>
