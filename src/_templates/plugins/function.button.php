<?php
function smarty_function_button($params)
{
    if ($params['enabled'])
        echo sprintf('<a href="%s">', $params['link']); 
    echo sprintf('<img class="button" id="%s" border="0" src="%s" alt="%s" title="%s">',
            $params['enabled'] ? "enabled" : "disabled",
            $params['img'],
            $params['title'],
            $params['title']);
    if ($params['enabled'])
        echo "</a>";
}
/* vim: set expandtab: */

?>

