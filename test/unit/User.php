<?php

require_once "qx.php";
Qx::useModule("TypeHints");
require_once "_include/QxUser.php";

class User_test extends PHPUnit_Framework_TestCase
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

    public function testRead()
    {
        QxUsers::read("src/_config/users.template");
        $this->assertEquals(1, QxUsers::count());

    }

    public function testReadNonExistent()
    {
        $filename = "src/_config/nonexistent.template";
        try
        {
            QxUsers::read($filename);
        } catch (Exception $e)
        {
            $this->assertEquals("could not open user file: $filename", $e->getMessage());
        }
    }
}

?>

