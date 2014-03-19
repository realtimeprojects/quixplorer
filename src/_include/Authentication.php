<?php

define("ANONYMOUS_USER", "Anonymous");

class Authentication
{
    // checks if user login is required and displays login
    // form if required
    public static function isRequired()
    {
        // if no login is required, there is nothing to do
        QxLog::debug("login: $require_login");
        if (!Config::get("login_required", true))
        {
            QxLog::debug("no login required");
            return false;
        }
    }

    public static function isLoginRequired()
    {
        // check if the user has already been authenticated
        // by an existing session
        $user = Authentication::getCurrentUser();
        if ($user != ANONYMOUS_USER)
        {
            QxLog::debug("user $user authenticated");
            return  false;
        }


        // if not, check if we need to login accoring
        // to the configuration
        return Config::get("login_required", true);
    }


    public static function getCurrentUser ()
    {
        if (!isset($_SESSION["s_user"]))
            return ANONYMOUS_USER;

        return $_SESSION["s_user"];
    }
}
