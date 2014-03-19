<?php

require_once "_include/user.php";
require_once "_include/debug.php";

// checks if user login is required and displays login
// form if required
function login_check()
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

    if (isset($_REQUEST['loginname']))
    {
      login_post();
      return;
    }

    // login the user
    _debug("displaying login page");
    login_form();
    exit();
}

//FIXME update home_dir variable if user is logged in
function login_form ()
{
	global $smarty;
	$smarty->display('login.tpl');
    exit(0);
}

function login_post ()
{
    $loginname = qx_request("loginname", Null);
    $password  = stripslashes(qx_request("password", Null));
    _debug("checking authentication [$loginname]");

    if ($loginname == Null || $password == Null)
    {
        _debug("authentication failed, no username or password set");
        show_error("@@errors.authenticate@@", "@@errors.wrong_user@@");
    }

    if (!user_activate($loginname, md5($password)))
    {
        _debug("authentication failed, password invalid");
        show_error("@@error.authenticate@@", "@@errors.wrong_user@@");
    }

    _debug("user successfully authenticated");
    $_SESSION["s_user"] = $_POST["loginname"];
}

function logout ()
{
	$_SESSION = array();
	session_destroy();
}

?>
