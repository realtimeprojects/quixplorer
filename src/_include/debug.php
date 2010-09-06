<?php

function testprint($what)
{
	echo "<h2>$what</h2>";
}

function debug ($data)
{
	$debug = 1;

	if ($debug == 0)
		return;

	$fp = fopen("debug.log", "a");
	fputs($fp, "DEBUG: $data\n");
	fclose($fp);
}

?>
