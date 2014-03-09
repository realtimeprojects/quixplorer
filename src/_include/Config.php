<?php

class Config
{
    public static function read($file)
    {
        log_debug("reading configuration from $file");
        if (! is_readable($file))
        {
            log_error("No configuration file found, using default configuration");
            return false;
        }

        self::$config = parse_ini_file($file, true);
        return true;
    }

    public static function get($entry, $default_value = NULL, $section = "global")
    {
        if (array_key_exists($entry, self::$config[$section]))
        {
            $value = self::$config[$section][$entry];
            log_debug("returning '$value' for entry '$entry'");
            return $value;
        }

        if ($default_value == NULL)
        {
            show_error("no configuration entry found for '$entry'", "check configuration");
        }

        log_debug("returning '$default_value' for entry '$entry' in $section (default value)");
        return $default_value;
    }

    private static $config = Array();
}

?>
