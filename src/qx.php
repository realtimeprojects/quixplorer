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

function qx_user()
{
    //FIXME return real user
    $user = $_SESSION["s_user"];
    return (isset($user) ? $user : "anonymous");
}
?>
