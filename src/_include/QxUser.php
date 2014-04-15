<?php

Qx::useModule("QxPermissions");

class QxUser
{
    public function __construct (string $userdata)
    {
        $fields = explode(":", $userdata);
        if (count($fields) < 4)
            throw new Exception("invalid user line: $userdata");
        $this->id = $fields[0];
        $this->password = $fields[1];
        $this->home = $fields[2];
        $this->permissions = new QxPermissions($fields[3]);
    }

    public function authenticate (string $password)
    {
        // check if the password matches
        return md5($password) == $this->password;
    }
}

class QxUsers
{
    public static function read(string $filename)
    {
        self::$_users = array();
        $users = file($filename);
        if ($users == null)
            throw new Exception("could not open user file: $filename");

        foreach ($users as $user)
        {
            if (trim($user) == "")
                continue;

            array_push(self::$_users, new QxUser($user));
        }
    }

    public static function count ()
    {
        return count(self::$_users);
    }


    private static $_users;
}

?>



