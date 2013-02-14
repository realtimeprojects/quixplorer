<?php

function smarty_function_qxt_icon_image($params)
{
    $filename = $params['themedir']."/images/".$params['type'].".gif";
    if (! is_readable($filename))
        return $params['themedir']."/images/file.gif";
    return $filename;
}

/* vim: set expandtab: */

?>
