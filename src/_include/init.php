<?php

require_once "qx.php";
require_once "html.php";
Qx::useModule("TypeHints");
Qx::useModule("log");
Qx::useModule("debug");
Qx::useModule("error");

Qx::useModule("Authentication");
Qx::useModule("Config");
Qx::useModule("Settings");
Qx::useModule("Security");
Qx::useModule("QxSmarty");
Qx::useModule("QxLink");

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
QxMsg::load(Settings::get("language"));
require "./_config/mimes.php";
require "./_include/fun_extra.php";

_check_config();

if (Authentication::isLoginRequired())
{
    Securty::overrideRequest("action", "login");
}

QxSmarty::init();

function _check_config()
{
    $temp_dir = Config::get('temp_directory');
    if (!is_writable($temp_dir))
        show_error("Temp directory '$temp_dir' is not writable!");
}

?>
