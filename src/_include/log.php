<?php

function log_syslog($level, $message)
{
    openlog("quixplorer", LOG_PID | LOG_PERROR | LOG_LOCAL0, LOG_USER);
    syslog($level, $message);
    closelog();
}

function log_error($msg, $extra)
{
    if (isset($extra))
        $msg .= ", " . $extra;

    log_syslog(LOG_ERR, $msg);
    error_log($msg);
}

function log_debug($msg)
{
    log_syslog(LOG_NOTICE, $msg);
}
?>
