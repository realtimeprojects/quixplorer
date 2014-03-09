<?php

class Log
{
    public static function debug2($msg)
    {
        self::_syslog(LOG_DEBUG, $msg);
    }
    public static function debug($msg)
    {
        self::_syslog(LOG_NOTICE, $msg);
    }

    private static function _syslog($level, $message)
    {
        openlog("quixplorer", LOG_PID | LOG_PERROR | LOG_LOCAL0, LOG_USER);
        syslog($level, $message);
        closelog();
    }

    public static function error($msg, $extra)
    {
        if (isset($extra))
            $msg .= ", " . $extra;

        self::_syslog(LOG_ERR, $msg);
        error_log("Quixplorer, fatal error: " . $msg);
    }
}
?>
