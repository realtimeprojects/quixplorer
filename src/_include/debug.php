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
	fputs($fp, "quixplorer: " . date("Y-m-d H:i:s") . ": $data\n");
	fclose($fp);
}

// prints out an error message, but keeps your program running
function _error ($data)
{
    // we also print out the error message to the debug log, if activated
    _debug("ERROR: " . $data);

	$activated = true; // place false here if you want to deactivate the error log

	if ($activated == 0)
		return;

	$fp = fopen("error.log", "a");
	fputs($fp, "quixplorer: " . date("Y-m-d H:i:s") . ": ERROR: $data\n");
	fclose($fp);
}
?>
