<?php
/**
 * qx_cfg
 * @return void
 * @author John Doe
 **/
function qx_cfg($name, $defualt_value)
{
    global $qx_configuration;

    if (!isset($qx_configuration))
    {
        $qx_configuration = parse_ini_file("_config/quixplorer.cfg");
    }

    if (isset($qx_configuration[$name]))
    {
        return $qx_configuration[$name];
    }

    return $defualt_value;
}
?>
