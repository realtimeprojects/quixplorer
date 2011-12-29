<?php

require_once("./_include/permissions.php");

/**
    activates the browser download of the file $file.
 */
function download_action ($file)
{
    if (!isset($file))
        show_error(qx_msg_s("error.qxlink"), qx_msg_s("error.filenotset"));
    $file_f = path_f($file);

	if (!permissions_grant($dir, $item, "read"))
		show_error(qx_msg_s("error.access"));

    $file_f = path_f($file);

	if (!permissions_grant(NULL, $file_f, "read"))
		show_error(qx_msg_s("error.access"));
	
	if (!file_exists($file_f))
        show_error(qx_msg_s("error.filenotexists", $file_f));
	
	header('Content-Type: application/octet-stream');
	header('Expires: '. gmdate('D, d M Y H:i:s') . ' GMT');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($file_f));
    header('Content-Disposition: attachment; filename="' . basename($file_f) . '"');
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');
	
	@readfile($file_f);
	exit;
}

?>
