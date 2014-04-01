<?php

class QxPermissions
{
    public function __construct (string $permissiondata)
    {
        $this->permissions = explode("|", $permissiondata);
    }
}
?>
