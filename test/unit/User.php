<?php

require_once "qx.php";
Qx::useModule("TypeHints");
require_once "_include/QxUser.php";

class user_test extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $admin = "admin:9628d0d187029e6337baa86780b2abb6:.:read|create|change|delete|admin|access_hidden_files";
        $user = new QxUser($admin);
        $this->assertEquals("admin", $user->id);
        $this->assertEquals("9628d0d187029e6337baa86780b2abb6", $user->password);
        $this->assertEquals(".", $user->home);
        $this->assertTrue($user->permissions != null);
        $this->assertTrue($user->authenticate("pwd_admin"));
    }
}

?>

