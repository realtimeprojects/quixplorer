<?php

require_once "./_include/permissions.php";
Qx::useModule("log");
Qx::useModule("QxDirectory");

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
            QxLog::debug("checking permissions for: $file");
            if (!permissions_grant($dir, $file, "read"))
            {
                QxLog::debug("no permissions for reading: $file");
                return false;
            }

            if (!self::isItemVisible($dir, $file))
                return false;

            $qxpath = new QxPath(Path::append($dir, $file));
            if (!file_exists($qxpath->absolute()))
            {
                QxLog::debug("not found: full path: ".$qxpath->absolute());
                return false;
            }
        }

        return true;
    }

    // show this file?
    public static function isItemVisible($dir, $item)
    {
        if ($item == "." || $item == "..")
            return false;

        $show_hidden = Config::get("show_hidden", false);
        if(! $show_hidden)
        {
            if (substr($item, 0, 1) == ".")
                return false;

            $dirs = explode("/",$dir);
            foreach ($dirs as $ii)
            {
               if (substr($ii, 0, 1) == ".")
                   return false;
            }
        }
        if (Config::get("no_access", "") == "" && @eregi($GLOBALS["no_access"], $item))
            return false;

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
