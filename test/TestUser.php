<?php
require_once('test/simpletest/autorun.php');
require_once('src/_include/user.php');

class TestUser extends UnitTestCase
{
	function setUp ()
	{
		user_load('test/config/htuser1.php');
	}

    function testCaseAdminExists()
    {
		$this->assertTrue(user_get_index("admin") == 0);
    }

    function testCaseNonExistentUser()
    {
		$this->assertTrue(user_get_index("adminnonexistent") < 0);
    }


}
?>
