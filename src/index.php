<?php
/**
	@Authors: Claudio Klingeler, The QuiX project

	Main File
	
*/

// Added to make created files/dirs group writable
umask(002); 

require_once "./_include/debug.php";
require "./_include/init.php";

// TODO
// make a method "call-action" that takes a parameter "action" and sources
// a files _include/$action" automatically and runs the modules-"do" command
//
// function do_action($action)
// {
//	require ./_include/$action.php
//	do_action()
// } 
switch($action)
{
	case "edit":
		require "./_include/fun_edit.php";
		edit_file($GLOBALS["dir"], $GLOBALS["item"]);
	break;
	
	// delete files or directories 
	case "delete":
		require "./_include/delete.php";
		del_items($GLOBALS["dir"]);
	break;
	
	// copy or move files and directories
	case "copy":
	case "move":
		require "./_include/fun_copy_move.php";
		copy_move_items($GLOBALS["dir"]);
	break;
	
	// download a file
	case "download":
	 	// prevent unwanted output			
		ob_start();
		require "./_include/fun_down.php";
		// get rid of cached unwanted output
		ob_end_clean(); 
		download_item($GLOBALS["dir"], $GLOBALS["item"]);
		ob_start(false); // prevent unwanted output
		exit;
	break;

	// upload file(s)
	case "upload":
		require "./_include/fun_up.php";
		upload_items($GLOBALS["dir"]);
	break;
	
	// create a file or directory
	case "mkitem":
		require "./_include/fun_mkitem.php";
		make_item($GLOBALS["dir"]);
	break;
	
	// change file permissions
	case "chmod":
		require "./_include/fun_chmod.php";
		chmod_item($GLOBALS["dir"], $GLOBALS["item"]);
	break;
	
	// create an archive of the file
	case "arch":
		require "./_include/fun_archive.php";
		archive_items($GLOBALS["dir"]);
	break;
	

	// user admin dialog
	case "admin":
		require "./_include/admin.php";
		admin_show($GLOBALS["dir"]);
	break;

	// search for files or directories
	case "search":
	// DEFAULT: LIST FILES & DIRS
	case "list":
	default:
		debug("loading list.php");
		require "./_include/list.php";
		list_dir($GLOBALS["dir"]);
}

/*------------------------------------------------------------------------------
     The contents of this file are subject to the Mozilla Public License
     Version 1.1 (the "License"); you may not use this file except in
     compliance with the License. You may obtain a copy of the License at
     http://www.mozilla.org/MPL/

     Software distributed under the License is distributed on an "AS IS"
     basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
     License for the specific language governing rights and limitations
     under the License.

     The Original Code is index.php, released on 2003-04-02.

     The Initial Developer of the Original Code is The QuiX project.

     Alternatively, the contents of this file may be used under the terms
     of the GNU General Public License Version 2 or later (the "GPL"), in
     which case the provisions of the GPL are applicable instead of
     those above. If you wish to allow use of your version of this file only
     under the terms of the GPL and not to allow others to use
     your version of this file under the MPL, indicate your decision by
     deleting  the provisions above and replace  them with the notice and
     other provisions required by the GPL.  If you do not delete
     the provisions above, a recipient may use your version of this file
     under either the MPL or the GPL."
------------------------------------------------------------------------------*/
?>
<?php
/**
	@Authors: Claudio Klingeler, The QuiX project

	Main File
	
*/

// Added to make created files/dirs group writable
umask(002); 

require_once "./_include/debug.php";
require "./_include/init.php";


switch($action)
{
	case "edit":
		require "./_include/fun_edit.php";
		edit_file($GLOBALS["dir"], $GLOBALS["item"]);
	break;

	// delete files or directories 
	case "delete":
		require "./_include/delete.php";
		del_items($GLOBALS["dir"]);
	break;
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
		require "./_include/fun_up.php";
		upload_items($GLOBALS["dir"]);
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
	// CREATE ARCHIVE
	case "arch":
		require "./_include/fun_archive.php";
		archive_items($GLOBALS["dir"]);
	break;
	//------------------------------------------------------------------------------
	// USER-ADMINISTRATION
	case "admin":
		require "./_include/admin.php";
		admin_show($GLOBALS["dir"]);
	break;
	//------------------------------------------------------------------------------
	// SEARCH FOR FILE(S)/DIR(S)
	case "search":
	// DEFAULT: LIST FILES & DIRS
	case "list":
	default:
		debug("loading list.php");
		require "./_include/list.php";
		list_dir($GLOBALS["dir"]);
}

/*------------------------------------------------------------------------------
     The contents of this file are subject to the Mozilla Public License
     Version 1.1 (the "License"); you may not use this file except in
     compliance with the License. You may obtain a copy of the License at
     http://www.mozilla.org/MPL/

     Software distributed under the License is distributed on an "AS IS"
     basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
     License for the specific language governing rights and limitations
     under the License.

     The Original Code is index.php, released on 2003-04-02.

     The Initial Developer of the Original Code is The QuiX project.

     Alternatively, the contents of this file may be used under the terms
     of the GNU General Public License Version 2 or later (the "GPL"), in
     which case the provisions of the GPL are applicable instead of
     those above. If you wish to allow use of your version of this file only
     under the terms of the GPL and not to allow others to use
     your version of this file under the MPL, indicate your decision by
     deleting  the provisions above and replace  them with the notice and
     other provisions required by the GPL.  If you do not delete
     the provisions above, a recipient may use your version of this file
     under either the MPL or the GPL."
------------------------------------------------------------------------------*/
?>
