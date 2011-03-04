<?php
/**
	This function allows access to session variables
*/
function session_get ($name)
{
	$user = $GLOBALS['__SESSION']["s_user"];
	if (!isset($GLOBALS['__SESSION']))
		return;

	if (!isset($GLOBALS['__SESSION'][$name]))
		return;
	
	return $GLOBALS['__SESSION'][$name];
}

?>
