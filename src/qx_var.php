<?php
/**
  Access to runtime variables.

  This module offers access to runtime variables like the root directory
  for qx or where to find the template directory.
 */

require_once "_include/log.php";
require_once "qx_cfg.php";
require_once "_include/session.php";

function qx_var($variable)
{
    switch ($variable)
    {
        // @returns true, if a valid user has been authenticated
        case 'is_authenticated':
            $active = session_get("s_user");
            return $active;

        // the path to the template directory
        case 'template_dir':     return qx_cfg("template_dir", "_templates/default");
    }

    log_fatal("request for unknown session variable '$variable'");
    return NULL;
}

?>
