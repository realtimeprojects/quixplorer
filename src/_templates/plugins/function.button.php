<?php
function smarty_function_button($params)
{
    if ($params['enabled'])
        echo sprintf('<a href="%s">', $params['link']);

    echo sprintf('%s', $params['content']);
    if ($params['enabled'])
        echo "</a>";
}
/* vim: set expandtab: */

?>

