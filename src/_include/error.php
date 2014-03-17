<?php

require_once "_include/smartyoutputfilter.php";

function show_error($error, $extra = "")
{
    $error = QxMsg::translate($error);
    QxLog::error($error, $extra);
    $page = " 
	<center>
        <h2>@@errors.error@@</h2>
        <p>$error</p>
        <p>$extra</p> 
        <h3> <a href=\"javascript:window.history.back()\">@@back@@</a></h3>
    </center>";
    echo QxMsg::translate($page);
    exit;
}

?>
