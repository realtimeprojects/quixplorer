<?php
function smarty_function_button($params)
{
    if ($params['enabled'])
        echo sprintf('<a href="%s">', $params['link']);
    else
        echo '<span style="opacity:0.3">';

    echo sprintf('%s', $params['content']);
    if ($params['enabled'])
        echo "</a>";
    else
        echo '</span>';
}
/* vim: set expandtab: */

?>

