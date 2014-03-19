<?php

umask(002); // Added to make created files/dirs group writable

require "_include/init.php";	// Init
require "_include/Action.php";

function load_action ($action_to_load)
{
    $action_script_name = "_include/actions/$action_to_load.php";
    if (!file_exists($action_script_name))
        show_error("@@errors.action_not_found@@", $action_script_name);
    require_once $action_script_name;
}

function run_action($action)
{
    load_action($action->action);
    $aclass = $action->action."Action";
    $ac = new $aclass;
    $ac->run($action);
}

$action = Action::getCurrentAction();

switch ($action->action)
{
    case "login":           login_form(); break;
    case "authenticate":    login_post(); // nobreak
    case "download":
    case "list":
    default:                run_action($action);
                            break;
// EDIT FILE
case "edit":
	require "./_include/fun_edit_editarea.php";
	edit_file($GLOBALS["dir"], $GLOBALS["item"]);
break;
// DELETE FILE(S)/DIR(S)
case "delete":
	require "./_include/fun_del.php";
	del_items($GLOBALS["dir"]);
break;
// COPY/MOVE FILE(S)/DIR(S)
case "copy":	case "move":
	require "./_include/fun_copy_move.php";
	copy_move_items($GLOBALS["dir"]);
break;
// DOWNLOAD FILE
break;
// UPLOAD FILE(S)
case "upload":
	$use_uploadify = isset($GLOBALS["use_uploadify"]) ? $GLOBALS["use_uploadify"] : false;
	$upload_script = $use_uploadify ? "fun_up_uploadify.php" : "fun_up.php";
	require "./_include/$upload_script";
	upload_items($GLOBALS["dir"]);
break;
// UNZIP ZIP FILE added by laurenceHR
case "unzip":
	require "./_include/fun_unzip.php";
	unzip_item($GLOBALS["dir"]);
break;
// CREATE DIR/FILE
case "mkitem":
	require "./_include/fun_mkitem.php";
	make_item($GLOBALS["dir"]);
break;
// CHMOD FILE/DIR
case "chmod":
	require "./_include/fun_chmod.php";
	chmod_item($GLOBALS["dir"], $GLOBALS["item"]);
break;
// SEARCH FOR FILE(S)/DIR(S)
case "search":
	require "./_include/fun_search.php";
	search_items($GLOBALS["dir"]);
break;
// CREATE ARCHIVE
case "arch":
	require "./_include/fun_archive.php";
	archive_items($GLOBALS["dir"]);
break;
// USER-ADMINISTRATION
case "admin":
	require "./_include/fun_admin.php";
	show_admin($GLOBALS["dir"]);
break;
}				// end switch-statement

?>
