<?php

class QxFile
{
    public function __construct ($qxpath, $filename)
    {
        $fullfile = Path::append($qxpath->absolute(), $filename);
        $this->fullpath = $fullfile;
        $this->extension = pathinfo($fullfile, PATHINFO_EXTENSION);
        $this->type = @filetype($fullfile);
        $this->name = $filename;
        $this->size = filesize($fullfile);
        $this->modified = @filemtime($fullfile);
        // FIXME make object from permissions
        $this->permissions = array();
        $this->permissions["text"] = decoct(@fileperms($fullfile));
        $this->permissions["link"] = NULL;
        $this->download_link = new QxLink("download", null, array("selitems[]" => Path::append($qxpath->get(), $filename)));
        $this->link = "";
        $this->edit_link = "http://tobeimplemented";
        /** FIXME
        if (!permissions_grant($dir, NULL, "change"))
            $fattributes["permissions_l"] = html_link(
                    qx_link("chmod", "&file=$$fullfile"),
                    $fattributes["permissions_l"],
                    qx_msg_s("permlink"));
        */
        if (is_dir($fullfile))
        {
            // NOT NICE: type and extension management
            $this->extension = "dir";
            $this->link = new QxLink("list", Path::append($qxpath->get(), $filename));
        }
    }
}

?>
