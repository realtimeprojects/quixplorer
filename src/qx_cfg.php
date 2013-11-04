<?php

/**
 * qx_cfg
 * @return void
 * @author John Doe
 **/
function qx_cfg($name, $default_value = NULL)
{
    global $qx_configuration;
    if (!isset($qx_configuration))
    {
        if (is_readable("_config/quixplorer.cfg"))
            $qx_configuration = parse_ini_file("_config/quixplorer.cfg");
        else
        {
            log_debug("No configuration file found, using default configuration");
            $qx_configuration = [];
        }
    }

    if (isset($qx_configuration[$name]))
    {
        _debug("returning '$qx_configuration[$name]' for entry '$name'");
        return $qx_configuration[$name];
    }

    _debug("returning '$qx_configuration[$name]' for entry '$name' (default value)");
    return $default_value;
}
?>
