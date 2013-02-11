<?php
/**
	This function allows access to session variables
*/
function session_get ($name)
{
	$user = $_SESSION["s_user"];
	if ( ! isset ( $_SESSION ) )
		return;

	if ( ! isset( $_SESSION[$name] ) )
		return;
	
	return $_SESSION[$name];
}

?>
