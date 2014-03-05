<?php

class Summary
{
    function __construct ()
    {
        $this->file_space = 0;
        $this->file_count = 0;
        $this->directory_count = 0;
    }

    function add ($path)
    {
        if (! file_exists($path))
            return false;

        if (is_dir($path))
        {
            $this->directory_count++;
            return true;
        }

        $this->file_space += filesize($path);
        $this->file_count++;
        return true;
    }
}

?>

