<?php

require_once "./_include/permissions.php";
Qx::useModule("log");

class Security
{
    public static function isPathOk($path)
    {
        $basedir = realpath(Config::get('base_directory'));

        // double security
        if ($basedir == NULL)
            return false;
        if ($basedir == "")
            return false;
        if ($basedir == "/")
            return false;

        // check if path is below basedir
        $abspath = $path->absolute();
        QxLog::debug("checking if path '".$path->get()."' is under home '$basedir'");
        return substr($abspath, 0, strlen($basedir)) == $basedir;
    }

    /** Checks if the download of the list of files in $items is allowed
        in the current situation.

        We check the permission settings, the show_item and do a path
        check.
     */
    public static function isDownloadAllowed($dir, $items)
    {
        foreach ($items as $file)
        {
            if (!permissions_grant($dir, $file, "read"))
                return false;

            if (!get_show_item($dir, $file))
                return false;

            $full_path = get_abs_item($dir, $file);
            if (!file_exists($full_path))
                return false;
        }

        return true;
    }

    public static function request($var, $default)
    {
        $ret = isset($_REQUEST[$var]) ? $_REQUEST[$var] : $default;
        if (is_array($ret))
            QxLog::debug("qx_request: returning '".implode(",", $ret)."' for $var");
        else
            QxLog::debug("qx_request: returning '$ret' for $var");
        return $ret;
    }
}


?>
