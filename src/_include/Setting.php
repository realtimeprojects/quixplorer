<?php

class Setting
{
    public static function get($entry, $default_value = NULL)
    {
        if (isset($_REQUEST[$entry]))
            return $_REQUEST[$entry];

        $value = Config::get($entry, $default_value);
        if ($value == NULL)
        {
            log_error("No setting found for '$entry'");
            return NULL;
        }

        return $value;
    }
}

?>
