<?php

Qx::useModule("QxPermissions");

class QxUser
{
    public function __construct (string $userdata)
    {
        $fields = explode(":", $userdata);
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

?>



