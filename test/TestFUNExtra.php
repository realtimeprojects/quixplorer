<?php
require_once('test/simpletest/autorun.php');
require_once('src/_include/fun_extra.php');
require_once('src/_include/user.php');
require_once('src/_lang/en_mimes.php');
require_once('src/_config/mimes.php');

class TestFUNExtra extends UnitTestCase
{
	function setUp()
	{
		user_load("test/config/htuser1.php");
		$this->assertTrue(user_activate("guest", md5("helloworld")));
	}

    function testCaseIsImage()
    {
		$this->assertFalse(get_is_image("config", "notexistentfile.gif"));
		$this->assertTrue(get_is_image("config", "testimage.gif"));
		$this->assertTrue(get_is_image("config", "testimage.jpg"));
		$this->assertFalse(get_is_image("config", "htuser1.php"));
    }


}
?>
