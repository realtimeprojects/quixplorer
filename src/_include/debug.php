<?php

function _syslog($level, $message)
{
    openlog("quixplorer", LOG_PID | LOG_PERROR | LOG_LOCAL0, LOG_USER);
    syslog($level, $message);
    closelog();
}

function testprint($what)
{
    echo "<h2>$what</h2>";
}

function _debug ($data)
{
    _syslog(LOG_NOTICE, $data);
}

// prints out an error message, but keeps your program running
function _error ($data)
{
    _syslog(LOG_ERR, $data);
}
?>
