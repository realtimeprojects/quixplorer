<?php
/**
	This function allows access to session variables
*/
function session_get ($name)
{
	if (!isset($__SESSION))
		return;

	if (!isset($__SESSION[$name]))
		return;

	return $__SESSION[$name];
}

?>
