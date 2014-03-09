<?php

require_once "_include/QxFile.php";

class Path
{
    public static function append($p1, $p2)
    {
        return $p1.DIRECTORY_SEPARATOR.$p2;
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
        return realpath(Path::append($basedir, $this->path));
    }

    public function get ()
    {
        return $this->path;
    }


    public function __toString ()
    {
        return $this->path;
    }

    private $path;
}


class QxDirectory
{
    public function __construct ($relative_path)
    {
        Log::debug("QxDirectory($relative_path)");
        $path = new QxPath($relative_path);
        if (!Security::isPathOk($path))
            show_error(qx_msg_s("errors.opendir") . ": dir='$path' [not under home]");
        $this->path = $path;
    }

    public function read()
    {
        $fullpath = $this->path->absolute();
        Log::debug("listing directory '$fullpath'");
        $handle = @opendir($this->path->absolute());

        if ($handle === false)
            show_error(qx_msg_s("errors.opendir") . ": $dir_f [error opening directory]");

        $files = Array();

        // read directory
        while (($cfile = readdir($handle)) !== false)
        {
            // skip local directory
            if ($cfile === ".")
                continue;

            $file = new QxFile($this->path, $cfile);
            $files[$cfile] = $file;
        }

        closedir($handle);
        return $files;
    }

    private $path;

}

?>
