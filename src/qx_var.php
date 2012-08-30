<?php

require_once("qx_cfg.php");

/**
    @returns true, if a valid user has been authenticated
*/
function qx_var_authenticated ()
{
    return isset($_SESSION["s_user"]);
}

function qx_var_template_dir ()
{
    return qx_cfg("template_dir", "_templates/default");
}

?>
