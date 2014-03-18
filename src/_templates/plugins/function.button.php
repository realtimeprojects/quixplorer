<?php
function smarty_function_button($params)
{
    if ($params['enabled'])
        echo sprintf('<a title="%s" href="%s">', $params['title'], $params['link']);
    else
        echo sprintf('<span title="%s" style="opacity:0.3">', $params['title']);

    echo sprintf('%s', $params['content']);
    if ($params['enabled'])
        echo "</a>";
    else
        echo '</span>';
}
/* vim: set expandtab: */

?>

