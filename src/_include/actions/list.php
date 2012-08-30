<?php

require_once("./_include/permissions.php");

function do_list_action($dir)
{
    _debug("do_list_action($dir)");

    $dir_f = path_f($dir);
    if (!down_home($dir_f))
        show_error(qx_msg_s("errors.opendir") . ": $dir_f [not under home]");

	$handle = @opendir($dir_f);
    _debug("listing directory '$dir_f");

	if ($handle === false)
        show_error(qx_msg_s("errors.opendir") . ": $dir_f [error opening directory]");

    global $qx_files;
    global $qx_totals;
    $qx_totals["files.disk_usage"] = 0;
    $qx_totals["files.count"] = 0;
    $qx_totals["directories.count"] = 0;
    $qx_totals["all.count"] = 0;

	// Read directory
	while (($cfile = readdir($handle)) !== false)
    {
        if ($cfile === ".")
            continue;

        $qx_totals["all.count"]++;

		$cfile_f = get_abs_item($dir, $cfile);
        $fattributes = array();
        $fattributes["type"] = "file";
		$fattributes["type"] = get_mime_type($dir, $cfile, "type");
        $fattributes["name"] = $cfile;
        $fattributes["size"] = filesize($cfile_f);
	    $fattributes["modified"] = @filemtime($cfile_f);
	    $fattributes["modified_s"] = parse_file_date(@filemtime($cfile_f));
        $fattributes["permissions_s"] = parse_file_perms(get_file_perms($dir, $cfile));
        $fattributes["permissions_l"] = $fattributes["permissions_s"];
        $fattributes["download_l"] = qx_link("download", "&file=" . path_r($cfile_f));
		if (!permissions_grant($dir, NULL, "change"))
            $fattributes["permissions_l"] = html_link(
                qx_link("chmod", "&file=$cfile_f"),
                $fattributes["permissions_l"],
                qx_msg_s("permlink"));
        if (get_is_dir($dir, $cfile))
        {
            $fattributes["type"] = "directory";
            $fattributes["link"] = qx_link("list", "&dir=" . path_r("$dir_f/$cfile"));
            $qx_totals["directories.count"]++;
        }
        else
        {
            $qx_totals["files.disk_usage"] += filesize($cfile_f);
            $qx_totals["files.count"]++;
        }
        $qx_files[$cfile] = $fattributes;
	}
	closedir($handle);
    qx_page("list");
}

?>

