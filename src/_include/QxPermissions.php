<?php

class QxPermissions
{
    public function __construct (string $permissiondata)
    {
        $this->permissions = explode("|", $permissiondata);
    }

    public function serialize ()
    {
        return implode("|", $this->permissions);
    }

    public function isAllowed(string $what)
    {
        foreach ($this->permissions as $perm)
        {
            if ($what == $perm)
                return true;
        }

        return false;
    }
}
?>
