<?php

/**
    show error-message and terminate
 */
function FATAL($error,$extra=NULL)
{
    log_error($error, $extra);
    ?>
	<center>
        <h2><?php echo $error ?></h2>
        <p><?php if ($extra != NULL) echo $extra; ?></p> 
    </center>
    <?php
    exit;
}

// FIXME use smarty template engine
function show_error($error,$extra=NULL)
{
    // we do not know whether the language module was already loaded
    $errmsg = isset($GLOBALS["error_msg"]) ? $GLOBALS["error_msg"]["error"] : "ERROR";
    $backmsg = isset($GLOBALS["error_msg"]) ? $GLOBALS["error_msg"]["back"] : "BACK";

//    require_once qx_var_template_dir() . "/header.php";
    ?>
	<center>
        <h2><?php echo $errmsg ?></h2>
        <p><?php echo $error ?></p>
        <p><?php if ($extra != NULL) echo $extra; ?></p> 
        <h3> <a href="javascript:window.history.back()"><?php echo $backmsg ?></a></h3>
    </center>
    <?php
    require_once qx_var_template_dir() . "/footer.php";
    exit;
}

?>
