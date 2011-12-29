<?php
require_once("./_include/permissions.php");

function download_action()
{
    $file = $_GET["file"];
    if (!isset($file))
        show_error(qx_msg_s("error.qxlink"), qx_msg_s("error.filenotset"));
    $file_f = path_f($file);
    qx_page("download");
}
//------------------------------------------------------------------------------
// download file
function download_item($dir, $item)
{
	// Security Fix:
	$item=basename($item);

	if (!permissions_grant($dir, $item, "read"))
		show_error(qx_msg("error.access"));
	
	if (!get_is_file($dir,$item)) show_error($item.": ".$GLOBALS["error_msg"]["fileexist"]);
	if(!get_show_item($dir, $item)) show_error($item.": ".$GLOBALS["error_msg"]["accessfile"]);
	
	$abs_item = get_abs_item($dir,$item);
	$browser=id_browser();
	header('Content-Type: '.(($browser=='IE' || $browser=='OPERA')?
		'application/octetstream':'application/octet-stream'));
	header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: '.filesize($abs_item));
	if($browser=='IE') {
		header('Content-Disposition: attachment; filename="'.$item.'"');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
	} else {
		header('Content-Disposition: attachment; filename="'.$item.'"');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
	}
	
	@readfile($abs_item);
	exit;
}
//------------------------------------------------------------------------------
?>
