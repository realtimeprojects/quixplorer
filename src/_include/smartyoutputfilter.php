<?php

require_once "_include/QxMsg.php";

function smarty_outputfilter_lang($output, &$smarty)
{
    return QxMsg::translate($output);
}

/* vim: set expandtab: */

?>
