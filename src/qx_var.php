<?php

require_once("qx_cfg.php");
require_once("_include/session.php");

/**
    @returns true, if a valid user has been authenticated
*/
function qx_var_authenticated ()
{
    $user = session_get("s_user");
    return isset($user);
}

function qx_var_template_dir ()
{
    return qx_cfg("template_dir", "_templates/default");
}

?>
