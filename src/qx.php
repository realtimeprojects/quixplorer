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
?>
