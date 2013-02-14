<?php

require_once "qx_var.php";
require_once "qx.php";
require_once "qx_msg.php";
require_once "qx_link.php";
require_once "qx_version.php";
require_once "html.php";
require_once "_include/debug.php";
require_once "_include/error.php";
require_once "_include/login.php";
require_once "_include/log.php";
require_once "_lib/smarty/Smarty.class.php";

session_start();

log_debug("initializing qx");

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
// Get Sort
if(isset($GLOBALS['__GET']["order"])) $GLOBALS["order"]=stripslashes($GLOBALS['__GET']["order"]);
else $GLOBALS["order"]="name";
if($GLOBALS["order"]=="") $GLOBALS["order"]=="name";
// Get Sortorder (yes==up)
if(isset($GLOBALS['__GET']["srt"])) $GLOBALS["srt"]=stripslashes($GLOBALS['__GET']["srt"]);
else $GLOBALS["srt"]="yes";
if($GLOBALS["srt"]=="") $GLOBALS["srt"]=="yes";
// Get Language
if(isset($GLOBALS['__GET']["lang"])) $GLOBALS["lang"]=$GLOBALS['__GET']["lang"];
elseif(isset($GLOBALS['__POST']["lang"])) $GLOBALS["lang"]=$GLOBALS['__POST']["lang"];

if (!is_readable("./_config/conf.php"))
    show_error("./_config/conf.php not found.. please see installation instructions");

require "./_config/conf.php";
require "./_config/configs.php";
if(isset($GLOBALS["lang"])) $GLOBALS["language"]=$GLOBALS["lang"];
require "./_lang/".$GLOBALS["language"].".php";
require "./_lang/".$GLOBALS["language"]."_mimes.php";
require "./_config/mimes.php";
require "./_include/fun_extra.php";

_init_smarty();

login_check();

function _init_smarty()
{
	global $smarty;

	// Set up smarty
	$smarty = new Smarty;

    log_debug("setting template dir to " . qx_var('template_dir'));

	// Smarty directories
	$smarty->template_dir = qx_var('template_dir');
    $smarty->compile_dir = qx_cfg('compile_dir', "tmp/smarty/compile");
	$smarty->cache_dir = qx_cfg('cache_dir', "tmp/smarty/cache_dir");
	$smarty->config_dir = qx_cfg('config_dir', "_config");

	// Assign the version number to smarty
	$smarty->assign('version', qx_cfg('version'));

	// Assign the homepage to smarty
	$smarty->assign('homepage', qx_cfg('homepage'));
	$smarty->assign('sitename', qx_cfg('sitename'));
	global $lang;
	$smarty->assign('lang', $lang);
	$smarty->assign('messages', $GLOBALS['messages']);
	$smarty->assign('themedir', $smarty->template_dir);
	$smarty->assign('error_msg', $GLOBALS['error_msg']);
	$smarty->assign('languages', $GLOBALS['langs']);
	$smarty->assign('logon_user', qx_user());

}
?>
