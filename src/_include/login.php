<?php

require "./_include/user.php";
user_load();
//------------------------------------------------------------------------------
session_start();
if(isset($_SESSION)) 			$GLOBALS['__SESSION']=&$_SESSION;
elseif(isset($HTTP_SESSION_VARS))	$GLOBALS['__SESSION']=&$HTTP_SESSION_VARS;
else logout();
//------------------------------------------------------------------------------
function login() {
	//print_r($GLOBALS['__SESSION']);	
	if(isset($GLOBALS['__SESSION']["s_user"])) {
		if(!user_activate($GLOBALS['__SESSION']["s_user"],$GLOBALS['__SESSION']["s_pass"])) {
			logout();
		}
	} else {
		if(isset($GLOBALS['__POST']["p_pass"])) $p_pass=$GLOBALS['__POST']["p_pass"];
		else $p_pass="";
		
		if(isset($GLOBALS['__POST']["p_user"])) {
			// Check Login
			if(!user_activate(stripslashes($GLOBALS['__POST']["p_user"]), md5(stripslashes($p_pass)))) {
				logout();
			}
			// authentication sucessfull
			return;
		} else {
			// Ask for Login
			show_header($GLOBALS["messages"]["actlogin"]);
			echo "<BR><TABLE width=\"300\"><TR><TD colspan=\"2\" class=\"header\" nowrap><B>";
			echo $GLOBALS["messages"]["actloginheader"]."</B></TD></TR>\n<FORM name=\"login\" action=\"";
			echo make_link("login",NULL,NULL)."\" method=\"post\">\n";
			echo "<TR><TD>".$GLOBALS["messages"]["miscusername"].":</TD><TD align=\"right\">";
			echo "<INPUT name=\"p_user\" type=\"text\" size=\"25\"></TD></TR>\n";
			echo "<TR><TD>".$GLOBALS["messages"]["miscpassword"].":</TD><TD align=\"right\">";
			echo "<INPUT name=\"p_pass\" type=\"password\" size=\"25\"></TD></TR>\n";
			echo "<TR><TD>".$GLOBALS["messages"]["misclang"].":</TD><TD align=\"right\">";
			echo "<SELECT name=\"lang\">\n";
			@include "./_lang/_info.php";
			echo "</SELECT></TD></TR>\n";
			echo "<TR><TD colspan=\"2\" align=\"right\"><INPUT type=\"submit\" value=\"";
			echo $GLOBALS["messages"]["btnlogin"]."\"></TD></TR>\n</FORM></TABLE><BR>\n";
?><script language="JavaScript1.2" type="text/javascript">
<!--
	if(document.login) document.login.p_user.focus();
// -->
</script><?php
			show_footer();
			exit;
		}
	}
}

//------------------------------------------------------------------------------
function logout() {
	$GLOBALS['__SESSION']=array();
	session_destroy();
	header("location: ".$GLOBALS["script_name"]);
}
//------------------------------------------------------------------------------
/**
  This function determines if a user has been authenticated or not.
  */
function login_ok ()
{
	if(!isset($GLOBALS['__SESSION']["s_user"]))
		return false;

	return user_activate($GLOBALS['__SESSION']["s_user"],$GLOBALS['__SESSION']["s_pass"]);
}
?>
