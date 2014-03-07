<?php

class Path
{
    public static function append($p1, $p2)
    {
        return realpath($p1.DIRECTORY_SEPARATOR.$p2);
    }
}

class QxPath
{
    public function __construct ($relative_path)
    {
        $this->path = $relative_path;
    }

    public function absolute ()
    {
        $basedir = Config::get('base_directory');
        return Path::append($basedir, $this->path);
    }

    public function get()
    {
        return $this->path;
    }


    public function __toString()
    {
        return $this->path;
    }

    private $path;
}

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
        log_debug("checking if path '".$path->get()."' is under home '$basedir'");
        return substr($abspath, 0, strlen($basedir)) == $basedir;
    }
}

class QxDirectory
{
    public function __construct ($relative_path)
    {
        log_debug("QxDirectory($relative_path)");
        $path = new QxPath($relative_path);
        if (!Security::isPathOk($path))
            show_error(qx_msg_s("errors.opendir") . ": dir='$path' [not under home]");
        $this->path = $relative_path;
    }

    private $path;
}

?>
