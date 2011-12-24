<?php

function testprint($what)
{
	echo "<h2>$what</h2>";
}

function _debug ($data)
{
	$debug = 1;

	if ($debug == 0)
		return;

	$fp = fopen("debug.log", "a");
	fputs($fp, "quixplorer: " . date("Y-m-d H:i:s.u") . ": $data\n");
	fclose($fp);
}

?>
