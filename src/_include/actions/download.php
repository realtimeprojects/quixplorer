<?php

require_once("./_include/permissions.php");

/**
    activates the browser download of the file $file.
 */
function do_download_action ($file)
{
    if (!isset($file))
        show_error(qx_msg_s("error.qxlink"), qx_msg_s("error.filenotset"));
    $file_f = path_f($file);
    _debug("downloading $file // $file_f");

	if (!permissions_grant(NULL, $file_f, "read"))
		show_error(qx_msg_s("error.access"));
	
	if (!file_exists($file_f))
        show_error(qx_msg_s("error.filenotexists", $file_f));

    if (is_dir($file_f))
        _download_directory($file_f);

    _download_file($file_f);
}	

function _download_file ($file_f, $targetname = NULL)
{
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
function _download_directory ($file_f)
{
    $archive_zip = new ZipArchive;
    $tmp_f = tempnam("", "download-archive-$file_f.zip");
    _debug("creating tmp zip archive of directory $file_f into $tmp_f");
    if ($archive_zip->open($tmp_f) !== true)
        show_error(qx_msg_s("error.zip_creation_failed"), $tmp_f);
    _add_directory($archive_zip, $file_f);
    if ($archive_zip->close() !== true)
        show_error(qx_msg_s("error.zip_close_failed"), $tmp_f);
    
    _download_file($tmp_f, basename($file_f) . ".zip");
}

function _add_directory ($archive, $dir_f)
{
    _debug("adding directory $dir_f to archive");
    $files = scandir($dir_f);
    foreach ($files as $filename)
    {
        // ignore . and .. directories
        if (preg_match("#^[\.]{1,2}$#", $filename))
            continue;
        $filename_f = "$dir_f/$filename";
        if (!is_dir($filename_f))
            $archive->addFile($filename_f, path_r($filename_f));
        else
            _add_directory($archive, $filename_f);
    }
}
?>
