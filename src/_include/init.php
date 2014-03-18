<?php

require_once "qx.php";
require_once "qx_link.php";
require_once "qx_version.php";
require_once "html.php";
Qx::useModule("TypeHints");
Qx::useModule("log");
Qx::useModule("debug");
Qx::useModule("error");
Qx::useModule("login");
Qx::useModule("Config");
Qx::useModule("Setting");

if (Config::read("_config/quixplorer.ini") == false)
{
    show_error("Config file _config/quixplorer.ini not found", "See installation manual for details");
}

session_start();
QxLog::debug("initializing qx");

// Necessary files
date_default_timezone_set ( "UTC" );

require "./_config/configs.php";
QxLog::debug("boot strapped");
QxMsg::load(Setting::get("language"));
require "./_config/mimes.php";
require "./_include/fun_extra.php";

_check_config();
_init_smarty();

login_check();

function _check_config()
{
    $temp_dir = Config::get('temp_directory');
    if (!is_writable($temp_dir))
        show_error("Temp directory '$temp_dir' is not writable!");
}

function _init_smarty()
{
	global $smarty;

	// Set up smarty
	$smarty = new Smarty;

    $template_dir = Config::get('template_directory');
    QxLog::debug("setting template dir to " . $template_dir);

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
	$smarty->assign('themedir', $template_dir);
    $themeplugin_dir = "$template_dir/plugins";
    if (is_dir($themeplugin_dir))
    {
        QxLog::debug("adding $themeplugin_dir to smarty plugins dir");
        $smarty->addPluginsDir($themeplugin_dir);
    }
    $qx_plugin_dir = "_templates/plugins";
    if (is_dir($qx_plugin_dir))
    {
        QxLog::debug("adding $qx_plugin_dir to smarty plugins dir");
        $smarty->addPluginsDir($qx_plugin_dir);
    }
	$smarty->assign('logon_user', qx_user_s());
}
?>
