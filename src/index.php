<?php
umask(002); // Added to make created files/dirs group writable
require "./_include/init.php";	// Init
//------------------------------------------------------------------------------
switch($GLOBALS["action"]) {		// Execute action
//------------------------------------------------------------------------------
// EDIT FILE
case "edit":
	require "./_include/fun_edit_editarea.php";
	edit_file($GLOBALS["dir"], $GLOBALS["item"]);
break;
//------------------------------------------------------------------------------
// DELETE FILE(S)/DIR(S)
case "delete":
	require "./_include/fun_del.php";
	del_items($GLOBALS["dir"]);
break;
//------------------------------------------------------------------------------
// COPY/MOVE FILE(S)/DIR(S)
case "copy":	case "move":
	require "./_include/fun_copy_move.php";
	copy_move_items($GLOBALS["dir"]);
break;
//------------------------------------------------------------------------------
// DOWNLOAD FILE
case "download":
	ob_start(); // prevent unwanted output
	require "./_include/fun_down.php";
	ob_end_clean(); // get rid of cached unwanted output
	download_item($GLOBALS["dir"], $GLOBALS["item"]);
	ob_start(false); // prevent unwanted output
	exit;
break;
//------------------------------------------------------------------------------
// UPLOAD FILE(S)
case "upload":
	$use_uploadify = isset($GLOBALS["use_uploadify"]) ? $GLOBALS["use_uploadify"] : false;
	$upload_script = $use_uploadify ? "fun_up_uploadify.php" : "fun_up.php";
	require "./_include/$upload_script";
	upload_items($GLOBALS["dir"]);
break;
//------------------------------------------------------------------------------
// UNZIP ZIP FILE added by laurenceHR
case "unzip":
	require "./_include/fun_unzip.php";
	unzip_item($GLOBALS["dir"]);
break;
//------------------------------------------------------------------------------
// CREATE DIR/FILE
case "mkitem":
	require "./_include/fun_mkitem.php";
	make_item($GLOBALS["dir"]);
break;
//------------------------------------------------------------------------------
// CHMOD FILE/DIR
case "chmod":
	require "./_include/fun_chmod.php";
	chmod_item($GLOBALS["dir"], $GLOBALS["item"]);
break;
//------------------------------------------------------------------------------
// SEARCH FOR FILE(S)/DIR(S)
case "search":
	require "./_include/fun_search.php";
	search_items($GLOBALS["dir"]);
break;
//------------------------------------------------------------------------------
// CREATE ARCHIVE
case "arch":
	require "./_include/fun_archive.php";
	archive_items($GLOBALS["dir"]);
break;
//------------------------------------------------------------------------------
// USER-ADMINISTRATION
case "admin":
	require "./_include/fun_admin.php";
	show_admin($GLOBALS["dir"]);
break;
//------------------------------------------------------------------------------
// DEFAULT: LIST FILES & DIRS
case "list":
default:
	require "./_include/fun_list.php";
	list_dir($GLOBALS["dir"]);
//------------------------------------------------------------------------------
}				// end switch-statement
//------------------------------------------------------------------------------
show_footer();
//------------------------------------------------------------------------------
?>
