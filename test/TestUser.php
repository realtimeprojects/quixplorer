<?php
require_once('test/simpletest/autorun.php');
require_once('src/_include/user.php');

class TestUser extends UnitTestCase
{
	function setUp ()
	{
		user_load('test/config/htuser1.php');
		$GLOBALS['__SESSION'] = NULL;
	}

    function testCaseUserGet()
    {
		$this->assertTrue(user_get_index("admin") == 0);
		$this->assertTrue(user_get_index("adminnonexistent") < 0);
    }

    function testCaseUserFind()
    {
		$this->assertNotNull(user_find("admin"));
		$this->assertNull(user_find("admin", "wrongpassword"));
		$this->assertNotNull(user_find("admin", md5("pwd_admin")));
		$this->assertNull(user_find("adminnonexistent", md5("pwd_admin")));
		$this->assertNull(user_find("adminnonexistent"));
		$this->assertNotNull(user_find("guest"));
		$this->assertNotNull(user_find("guest", md5("helloworld")));
    }
	
	function testCaseUserActivateAdmin()
	{
		$this->assertFalse(isset($GLOBALS['__SESSION']));
		$this->assertFalse(user_activate("admin", "wrongpassword"));
		$this->assertFalse(user_activate("adminnonexistent", "wrongpassword"));
		$this->assertTrue(user_activate("admin", md5("pwd_admin")));
		$this->assertNotNull($GLOBALS['__SESSION']);
		$this->assertEqual($GLOBALS['__SESSION']['s_user'], "admin");
		$this->assertEqual($GLOBALS['__SESSION']['s_pass'], md5("pwd_admin"));
		$this->assertEqual($GLOBALS['home_dir'], ".");
		$this->assertEqual($GLOBALS['home_url'], "http://localhost");
		$this->assertTrue($GLOBALS['show_hidden']);
	}

	function testCaseUserActivateGuest()
	{
		$this->assertFalse(isset($GLOBALS['__SESSION']));
		$this->assertFalse(user_activate("guest", "wrongpassword"));
		$this->assertTrue(user_activate("guest", md5("helloworld")));
		$this->assertNotNull($GLOBALS['__SESSION']);
		$this->assertEqual($GLOBALS['__SESSION']['s_user'], "guest");
		$this->assertEqual($GLOBALS['__SESSION']['s_pass'], md5("helloworld"));
		$this->assertEqual($GLOBALS['home_dir'], "./data");
		$this->assertEqual($GLOBALS['home_url'], "http://localhost");
		$this->assertFalse($GLOBALS['show_hidden']);
	}

}
?>
