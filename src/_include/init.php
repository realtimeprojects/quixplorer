<?php

require_once "_include/log.php";
require_once "qx.php";
require_once "qx_msg.php";
require_once "qx_link.php";
require_once "qx_version.php";
require_once "html.php";
require_once "_include/debug.php";
require_once "_include/error.php";
require_once "_include/login.php";
require_once "_lib/smarty/Smarty.class.php";
require_once "_include/Config.php";
require_once "_include/Setting.php";

if (Config::read("_config/config.ini") == false)
{
    show_error("Config file _config/config.ini not found", "See installation manual for details");
}

session_start();


log_debug("initializing qx");

// Get Sort
if(isset($GLOBALS['__GET']["order"])) $GLOBALS["order"]=stripslashes($GLOBALS['__GET']["order"]);
else $GLOBALS["order"]="name";
if($GLOBALS["order"]=="") $GLOBALS["order"]=="name";
// Get Sortorder (yes==up)
if(isset($GLOBALS['__GET']["srt"])) $GLOBALS["srt"]=stripslashes($GLOBALS['__GET']["srt"]);
else $GLOBALS["srt"]="yes";
if($GLOBALS["srt"]=="") $GLOBALS["srt"]=="yes";

// Necessary files
date_default_timezone_set ( "UTC" );

require "./_config/configs.php";
log_debug("boot strapped");
require "./_lang/".Setting::get("language").".php";
require "./_lang/".Setting::get("language")."_mimes.php";
require "./_config/mimes.php";
require "./_include/fun_extra.php";

_init_smarty();

login_check();
function _init_smarty()
{
	global $smarty;

	// Set up smarty
	$smarty = new Smarty;

    $template_dir = Config::get('template_directory');
    log_debug("setting template dir to " . $template_dir);

	// Smarty directories
	$smarty->template_dir = $template_dir;
    $smarty->compile_dir  = Config::get('compile_dir', Config::get('temp_directory')."/smarty/compile",   "smarty");
	$smarty->cache_dir    = Config::get('cache_dir',   Config::get('temp_directory')."/smarty/cache_dir", "smarty");
	$smarty->config_dir   = Config::get('config_dir', "_config",                                          "smarty");

	// Assign the version number to smarty
	$smarty->assign('version', array( "id" => "3.0 PRE", "revision" => "0000" ));

	// Assign the homepage to smarty
	$smarty->assign('homepage', Config::get('homepage', "Quixplorer", "site"));
	$smarty->assign('site_name', Config::get('site_name', "Quixplorer Home", "site"));
	global $lang;
	$smarty->assign('lang', $lang);
	$smarty->assign('messages', $GLOBALS['messages']);
	$smarty->assign('themedir', $template_dir);
    $themeplugin_dir = "$template_dir/plugins";
    if (is_dir($themeplugin_dir))
    {
        log_debug("adding $themeplugin_dir to smarty plugins dir");
        $smarty->addPluginsDir($themeplugin_dir);
    }
    $qx_plugin_dir = "_templates/plugins";
    if (is_dir($qx_plugin_dir))
    {
        log_debug("adding $qx_plugin_dir to smarty plugins dir");
        $smarty->addPluginsDir($qx_plugin_dir);
    }
	$smarty->assign('error_msg', $GLOBALS['error_msg']);
	$smarty->assign('languages', $GLOBALS['langs']);
	$smarty->assign('logon_user', qx_user_s());
}
?>
