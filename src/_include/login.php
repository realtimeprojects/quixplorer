<?php

require_once "./_include/user.php";
require_once "qx_var.php";
require_once "_include/debug.php";

user_load();

session_start();

_debug("checking login..");

_check_login();

function _check_login()
{
    global $require_login;

    // if no login is required, there is nothing to do
    _debug("login: $require_login");
    if (!$require_login)
    {
        _debug("no login required");
        return;
    }

    // if the user is already authenticated, we're done
	if (isset($_SESSION["s_user"]))
    {
        _debug("user already authenticated");
        return;
    }

    // login the user
    _debug("displaying login page");
    login();
}

//FIXME update home_dir variable if user is logged in
function login ()
{
			// Ask for Login
            global $page;
            $page = "login.php";
            _debug("opening .. " . qx_var_template_dir() . "/page.php");
            require_once qx_var_template_dir() . "/page.php";
            exit;
}

function logout ()
{
	$GLOBALS['__SESSION']=array();
	session_destroy();
	header("location: ".$GLOBALS["script_name"]);
}

?>
