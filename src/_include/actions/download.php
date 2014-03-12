<?php

require_once "./_include/Security.php";

function _download_items($dir, $items)
{
    // check if user has permissions to download
    // this file
    if ( ! Security::isDownloadAllowed($dir, $items) )
		show_error( qx_msg_s( "error.access" ), implode(",", $items));

    QxLog::debug("starting download for: ".implode(",", $items)."/".count($items));
    // if we have exactly one file and this is a real
    // file we directly download it
    if ( count($items) == 1 )
    {
        $pt = new QxPath($dir, $items[0]);
        if (is_file( $pt->absolute() ))
        {
            _download_file($pt->absolute(), $items[0]);
        }
    }

    // otherwise we do the zip download
    _download_files( $dir, $items );
}


/**
    activates the browser download of the file $file.
 */
function do_download_action (Action $action)
{
    $files = $action->getParameter("selitems", []);
    if (is_array($files))
        QxLog::debug("selitems[]: ".implode(",", $files));
    else
        QxLog::debug("selitems: $files");

    if (count($files) == 0)
        show_error(qx_msg_s("error.qxlink"), qx_msg_s("error.filenotset"));
    _download_items($action->directory, $files);
}

function _download_file ($file_f, $targetname = NULL)
{
    QxLog::debug("downloading file: $file_f to target name $targetname");
    if (!isset($targetname))
        $targetname = basename($file_f);

	header('Content-Type: application/octet-stream');
	header('Expires: '. gmdate('D, d M Y H:i:s') . ' GMT');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($file_f));
    header("Content-Disposition: attachment; filename=\"$targetname\"");
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');

	@readfile($file_f);
	exit;
}

/**
    downloads a directory content by an archive, if possible.

    - asserts that the $file is an existing directory
 */
function _download_files ($dir, $files)
{
    QxLog::debug("downloading files: ".implode(",", $files));
    $archive_zip = new ZipArchive;
    $tmp_f = tempnam("", "download-archive-$file_f.zip");

    _debug("creating tmp zip archive of directory $file_f into $tmp_f");
    if ($archive_zip->open($tmp_f) !== true)
        show_error(qx_msg_s("error.zip_creation_failed"), $tmp_f);

    foreach ($files as $file)
    {
        _debug("dir: $dir");
        $pt = new QxPath($dir, $file);
        _add_directory($archive_zip, $pt->absolute());
    }

    $name = count($files) == 1 ? basename($files[0]) : "downloads";
    if ($archive_zip->close() !== true)
        show_error(qx_msg_s("error.zip_close_failed"), $tmp_f);

    _download_file($tmp_f, $name . ".zip");
}

function _add_directory ($archive, $dir_f)
{
    _debug("adding $dir_f to archive");
    if (is_file($dir_f))
    {
        $archive->addFile($dir_f, path_r($dir_f));
        return;
    }

    $files = scandir($dir_f);
    foreach ($files as $filename)
    {
        // ignore . and .. directories
        if (preg_match("#^[\.]{1,2}$#", $filename))
            continue;
        $filename_f = $dir_f.DIRECTORY_SEPARATOR.$filename;
        _add_directory($archive, $filename_f);
    }
}

?>
