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

    if ($_REQUEST['loginname']) 
    {
      login_post();
      return;
    }

    // login the user
    _debug("displaying login page");
    login_form();
}

//FIXME update home_dir variable if user is logged in
function login_form ()
{
    // Ask for Login
    qx_page("login");
}

function login_post ()
{
    $loginname = $_POST["loginname"];
    $password  = stripslashes($_POST["password"]);
    _debug("checking authentication [$loginname]");

    if (!isset($loginname) || !isset($password))
    {
        _debug("authentication failed, no username or password set");
        logout();
        login_form();
    }

    if (!user_activate($loginname, md5($password)))
    {
        _debug("authentication failed, password invalid");
        logout();
        login_form();
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
