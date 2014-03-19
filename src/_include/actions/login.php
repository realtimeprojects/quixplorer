<?php

Qx::useModule("user");
Qx::useModule("QxSmarty");
Qx::useModule("Security");
Qx::useModule("ActionLoader");

class LoginAction
{
    public function run(Action $action)
    {
        switch ($action->activity)
        {
            case "default":
            case "login":
                QxSmarty::display("login");
                break;
            case "logout":
                $this->_logout();
                break;
            case "authenticate":
                $this->_authenticate($action);
                break;
            default:
                show_error("login: Unknown activity $activity");
        }
    }

    private function _authenticate(Action $action)
    {
        $loginname = $action->getParameter("loginname", null);
        $password = $action->getParameter("password", null);
        QxLog::debug("authenticating user $loginname");

        if ($loginname == null)
        {
            $this->_handleError("@@login.missing_username@@");
        }

        if ($password == null)
        {
            $this->_handleError("@@login.missing_password@@");
        }

        if (!user_activate($loginname, md5($password)))
        {
            QxLog::error("authentication failed for user $loginname, password invalid");
            $this->_handleError("@@login.authentication_failed@@");
        }

        Qx::loadPage();
    }

    private function _handleError($message)
    {
        QxSmarty::assign("message", $message);
        QxSmarty::display("login");
    }

    function _logout ()
    {
        $_SESSION = array();
        session_destroy();
        Qx::loadPage();
    }
}

?>
