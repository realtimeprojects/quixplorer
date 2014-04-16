<?php

require_once "qx.php";
Qx::useModule("TypeHints");
Qx::useModule("QxUser");
Qx::useModule("QxPermissions");

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
        $this->assertEquals(2, QxUsers::count());
        $this->assertEquals(null, QxUsers::get("admin2"));

        $admin = QxUsers::get("admin");
        $this->assertEquals("admin", $admin->id);
        $this->assertEquals(".", $admin->home);
        $this->assertTrue($admin->authenticate("pwd_admin"));
        $this->assertFalse($admin->authenticate("pwd_admin2"));

        $guest= QxUsers::get("guest");
        $this->assertEquals("guest", $guest->id);
        $this->assertEquals(".", $guest->home);
        $this->assertFalse($guest->authenticate(""));
    }

    public function testSave()
    {
        QxUsers::read("src/_config/users.template");
        $this->assertEquals(2, QxUsers::count());
        QxUsers::save("users.saved");
        QxUsers::read("users.saved");
        $this->assertEquals(2, QxUsers::count());
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

    public function testPermissions()
    {
        $pe = new QxPermissions("");
        $this->assertFalse($pe->isAllowed("read"));
        $this->assertFalse($pe->isAllowed("write"));
        $this->assertFalse($pe->isAllowed("create"));
        $this->assertFalse($pe->isAllowed("delete"));
        $this->assertFalse($pe->isAllowed("admin"));
        $this->assertFalse($pe->isAllowed("access_hidden_files"));

        $pe = new QxPermissions("read|create|change|delete|admin|access_hidden_files");
        $this->assertTrue($pe->isAllowed("read"));
        $this->assertTrue($pe->isAllowed("create"));
        $this->assertTrue($pe->isAllowed("change"));
        $this->assertTrue($pe->isAllowed("delete"));
        $this->assertTrue($pe->isAllowed("admin"));
        $this->assertTrue($pe->isAllowed("access_hidden_files")); }
}

?>

