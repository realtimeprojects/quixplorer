<?php
/*------------------------------------------------------------------------------
     The contents of this file are subject to the Mozilla Public License
     Version 1.1 (the "License"); you may not use this file except in
     compliance with the License. You may obtain a copy of the License at
     http://www.mozilla.org/MPL/

     Software distributed under the License is distributed on an "AS IS"
     basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
     License for the specific language governing rights and limitations
     under the License.

     The Original Code is init.php, released on 2003-03-31.

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
/*------------------------------------------------------------------------------
Author: The QuiX project
	quix@free.fr
	http://www.quix.tk
	http://quixplorer.sourceforge.net

Comment:
	QuiXplorer Version 2.3
	Main File
	
	Have Fun...
------)------------------------------------------------------------------------*/
require_once "./_include/users.php";
require_once "./_include/debug.php";

//------------------------------------------------------------------------------
// Vars
if(isset($_SERVER)) {
	$GLOBALS['__GET']	=&$_GET;
	$GLOBALS['__POST']	=&$_POST;
	$GLOBALS['__SERVER']	=&$_SERVER;
	$GLOBALS['__FILES']	=&$_FILES;
} elseif(isset($HTTP_SERVER_VARS)) {
	$GLOBALS['__GET']	=&$HTTP_GET_VARS;
	$GLOBALS['__POST']	=&$HTTP_POST_VARS;
	$GLOBALS['__SERVER']	=&$HTTP_SERVER_VARS;
	$GLOBALS['__FILES']	=&$HTTP_POST_FILES;
} else {
	die("<B>ERROR: Your PHP version is too old</B><BR>".
	"You need at least PHP 4.0.0 to run QuiXplorer; preferably PHP 4.3.1 or higher.");
}
//------------------------------------------------------------------------------
// Get Action
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "list";

// Get Item
if(isset($GLOBALS['__GET']["item"])) $GLOBALS["item"]=stripslashes($GLOBALS['__GET']["item"]);
else $GLOBALS["item"]="";
// Get Sort
if(isset($GLOBALS['__GET']["order"])) $GLOBALS["order"]=stripslashes($GLOBALS['__GET']["order"]);
else $GLOBALS["order"]="name";
if($GLOBALS["order"]=="") $GLOBALS["order"]=="name";
// Get Sortorder (yes==up)
if(isset($GLOBALS['__GET']["srt"])) $GLOBALS["srt"]=stripslashes($GLOBALS['__GET']["srt"]);
else $GLOBALS["srt"]="yes";
if($GLOBALS["srt"]=="") $GLOBALS["srt"]=="yes";
// Get Language
//------------------------------------------------------------------------------
// Necessary files
ob_start(); // prevent unwanted output
require "./_config/conf.php";
require('_include/lang.php');
require "./_config/mimes.php";
require "./_include/fun_extra.php";
require "./_include/error.php";
require "smarty/Smarty.class.php";
require_once "./_include/login.php";

_init_smarty();

$tmp_msg = $GLOBALS["login_prompt"][$GLOBALS["language"]];
if (isset($tmp_msg))
	$GLOBALS["messages"]["actloginheader"] = $tmp_msg;

ob_end_clean(); // get rid of cached unwanted output
//------------------------------------------------------------------------------
do_login();

$user = user_get_current();
// Default Dir
if (isset($_REQUEST["dir"]))
	$GLOBALS["dir"] = stripslashes($_REQUEST["dir"]);
else
	$GLOBALS["dir"] = $user->home;
debug("user home: $user->name, $user->home, " . $GLOBALS['dir']);


//------------------------------------------------------------------------------
$abs_dir=get_abs_dir($GLOBALS["dir"]);

debug("absolute directory: $abs_dir");
if (!@is_dir($abs_dir))
{
	show_error($GLOBALS["error_msg"]["home"],$user->home);
}

if(!down_home($abs_dir)) show_error($GLOBALS["dir"]." : ".$GLOBALS["error_msg"]["abovehome"]);
if(!is_dir($abs_dir)) show_error($GLOBALS["dir"]." : ".$GLOBALS["error_msg"]["direxist"]);
//------------------------------------------------------------------------------
function _init_smarty ()
{
	global $smarty;
	$smartycfg = $GLOBALS['config']['smarty'];


		// Set up smarty
	include($phpTodo_smarty_dir . 'Smarty.class.php');
	$smarty = new Smarty;

	// Smarty directories
	$smarty->template_dir = $smartycfg['template_dir'] . "/" . $GLOBALS['config']['settings']['theme'];
	$smarty->compile_dir = $smartycfg['compile_dir'];
	$smarty->cache_dir = $smartycfg['cache_dir'];
	$smarty->config_dir = $smartycfg['config_dir'];

	// Assign the version number to smarty
	$smarty->assign('version', $GLOBALS['config']['version']);

	// Assign the homepage to smarty
	$smarty->assign('homepage', $GLOBALS['config']['site']['homepage']);
	$smarty->assign('sitename', $GLOBALS['config']['site']['name']);
	global $lang;
	$smarty->assign('lang', $lang);
	$smarty->assign('messages', $GLOBALS['messages']);
	$smarty->assign('themedir', $smarty->template_dir);
	$smarty->assign('error_msg', $GLOBALS['error_msg']);
	$smarty->assign('languages', $GLOBALS['languages']);
	$smarty->assign('directory', $GLOBALS['dir']);
	$smarty->assign('logon_user', user_get_current_username());

}
	
/**
  Do the login, if required
*/
function do_login ()
{
	if ($GLOBALS['action'] == "logout")
	{
		debug("logging out");
		logout();
		return;
	} 

	login();
}
?>
