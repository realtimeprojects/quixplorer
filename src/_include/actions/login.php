<?php

Qx::useModule("user");
Qx::useModule("QxSmarty");

class LoginAction
{
    public function run(Action $action)
    {
        QxSmarty::display("login");
    }
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
